<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hardware Store Nuts and Bolts</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="/static/css/style-division-productos.css"/>
        <link rel="stylesheet" href="/static/css/style.css"/>
    </head>
    <body>
        <?php 
            session_start();
            $seccion_Productos = $_GET['texto'];
            include('../database/database.php');
            $db = new database();
            require('../includes/metodos.php');
            $metodos_Compartidos = new metodos();
            $productos_Seccion = (new database())->productos_sec($seccion_Productos);
            $modifique_h = str_replace('<a href="/templates/division-productos.php?texto='.$seccion_Productos.'">'.$seccion_Productos.'</a>',"",$metodos_Compartidos->mheader());
            echo $modifique_h;
            if (isset($_POST['buscar'])){
                $producto_Buscado =$db->buscar_Producto($_POST['busqueda']);
                $metodos_Compartidos->ver_Producto(null,null,$producto_Buscado);
            }
        ?>
        <main>
            <aside>
                <?php 
                    $opciones_Marcas = "";
                    $marcas = array_column($productos_Seccion, 'marca');
                    foreach(array_count_values($marcas) as $marca=>$count){
                        $opciones_Marcas .='<div class="marca-Producto">
                                                <input type="checkbox" name="marca" value="'.$marca.'"> <p>'.$marca.'('.$count.')</p>
                                            </div>';
                    }

                    $nombres = array_column($productos_Seccion, 'nombre');
                    $nombres = array_map(function($nombre){return explode(" ", $nombre)[0];},$nombres);
                    $opciones_Tipo = "";
                    foreach(array_count_values($nombres) as $nombres=>$count){
                        $opciones_Tipo .= '
                                <div class="marca-Producto">
                                    <input type="checkbox" name="Tipo_Producto" value="'.$nombres.'"> <p>'. $nombres.'('.$count.')</p>
                                </div>';
                    };

                    $opciones_Precios = "";
                    $lista_Precios = array_column($productos_Seccion,'precio');
                    sort($lista_Precios);
                    for ($cont =0; $cont < count($lista_Precios); $cont+=2){
                        $cantidad = count(array_filter($lista_Precios, fn($precio) => $precio <= $lista_Precios[$cont + 1] & $precio >= $lista_Precios[$cont]));
                        if ((count($lista_Precios) % 2) & $cont == count($lista_Precios) - 3){
                            $rango = $lista_Precios[$cont].' - $'.$lista_Precios[$cont +2 ];
                            $opciones_Precios .= '<div><input type="checkbox" name="rangos[]" value="'.implode(",",[$cont, $cont +1]).'"> <p>$'.$rango.' ('.$cantidad.')</p></div>';
                            break;
                        }else{
                            $rango = $lista_Precios[$cont].' - $'.$lista_Precios[$cont + 1];
                            $opciones_Precios .= '<div><input type="checkbox" name="rangos[]" value="'.implode(",",[$cont, $cont +1]).'"> <p>$'.$rango.' ('.$cantidad.')</p></div>';
                        }
                    }

                    echo '<form method="POST" action="">
                            <h2>Fitrar por:</h2>
                            <section class="filtro-Marca">
                                <div class="submenu-Marca">
                                    <h3>Marca</h3>
                                </div>
                                <div class="busqueda-producto">
                                    <input class="checkboxInput" type="text" placeholder="Buscar por Marca">
                                </div>
                                '.$opciones_Marcas.'
                            </section>
                            <section class="filtro-Tipo"> 
                                <div class="submenu-Tipo">
                                    <h3>Tipo</h3>
                                </div>
                                <div class="busqueda-producto">
                                    <input type="text" placeholder="Buscar por Tipo">
                                </div>
                                '.$opciones_Tipo.'
                            </section>
                            <section class="filtro-Precio">
                                <div class="submenu-Precio">
                                    <h3>Precio</h3>
                                </div>
                                <ul>
                                    <div class="Precios">
                                        '.$opciones_Precios.'
                                    </div>
                                    <div class="rango-Precio">
                                            <input type="text" name="min_Price" id = "min" placeholder="Min.">
                                            <p>-</p>
                                            <input type="text" name="max_Price" placeholder="Max.">
                                    </div>
                                </ul>
                            </section>
                            <section class="Filtrar">
                                <button type="submit" class="btn_Filtrar">Filtrar</button>
                            </section>
                        </form>';

                    if (isset($_POST['marca'])){
                        $productos_Seccion = array_filter($productos_Seccion, function($producto){
                            return $producto['marca'] == $_POST['marca'];
                        });
                    }elseif(isset($_POST['Tipo_Producto'])){
                        $productos_Seccion = array_filter($productos_Seccion, function($producto) {
                            return strpos($producto['nombre'], $_POST['Tipo_Producto']) !== false;
                        });
                    }elseif(isset($_POST['rangos'])){
                        $id_Valores = array_merge(...array_map(fn($rango) => explode(",", $rango), $_POST['rangos']));
                        $productos_Seccion = array_filter($productos_Seccion, function($producto) use ($lista_Precios, $id_Valores){
                            return $producto['precio'] >= $lista_Precios[$id_Valores[0]] && $producto['precio'] <= $lista_Precios[end($id_Valores)];
                        });
                    }elseif(isset($_POST['min_Price']) or isset($_POST['max_Price'])){
                        $min_Price = (empty($_POST['min_Price'])) ? number_format(0,2) : number_format($_POST['min_Price'],2);
                        $max_Price = (empty($_POST['max_Price'])) ? end($lista_Precios) : number_format($_POST['max_Price'],2);
                        $productos_Seccion = array_filter($productos_Seccion, function($producto) use ($min_Price, $max_Price){
                            return $producto['precio'] >= $min_Price && $producto['precio'] <= $max_Price;
                        });
                    }
                    $productos_Seccion = array_values($productos_Seccion);
                ?>
            </aside>
            <div class="productos-Seccion">
                <?php 
                    $metodos_Compartidos = new metodos();
                    echo  '<h1>'.htmlspecialchars($seccion_Productos).'</h1>';
                    echo '<section class="productos">';
                        $metodos_Compartidos->imprimir_Productos($productos_Seccion, $añadir_a_Carrito = "submit_compra", $ver_producto = "producto");
                    echo '</section>';
                ?>
                <script src="/static/js/app.js"></script>
            </div>
        </main>
        <?php $metodos_Compartidos->mfooter(); ?> 
    </body>
</html>