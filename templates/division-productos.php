<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hardware Store Nuts and Bolts</title>
        <link rel="stylesheet" href="/static/style-division-productos.css">
        <link rel="stylesheet" href="/static/style.css"/> 
    </head>
    <body>
        <?php 
            session_start();
            $seccion_Productos = $_GET['texto'];
            include('../database/database.php');
            $db = new database();
            require('metodos.php');
            $metodos_Compartidos = new metodos();
            $productos_Seccion = $db->productos_sec($seccion_Productos);
            $modifique_h = str_replace('<a href="/templates/division-productos.php?texto='.$seccion_Productos.'">'.$seccion_Productos.'</a>',"",$metodos_Compartidos->mheader());
            echo $modifique_h;
            if (isset($_POST['buscar'])){
                $producto_Buscado =$db->buscar_Producto($_POST['busqueda']);
                $metodos_Compartidos->ver_Producto(null,null,$producto_Buscado);
            }
        ?>
        <main>
            <section class="divisiones-pag-productos">
                <aside>
                    <h2>Fitrar por:</h2>
                    <section class="filtro-Marca">  
                        <div class="submenu-Marca">
                            <h3>Marca</h3>
                            <button>
                                <svg viewBox="0 -960 960 960" ><path d="M480-360 280-560h400L480-360Z"/></svg>
                            </button>
                        </div>
                        <div class="busqueda-producto">
                            <input class="checkboxInput" type="text" placeholder="Buscar por Marca">
                        </div>
                        <?php
                            $marcas = array_column($productos_Seccion, 'marca');
                            foreach(array_count_values($marcas) as $marca=>$count){
                                echo '
                                <div class="marca-Producto">
                                    <input type="checkbox"> <p>'.$marca.'('.$count.')</p>
                                </div>';
                            }
                        ?>
                    </section>
                    <section class="filtro-Tipo">  
                        <div class="submenu-Tipo">
                            <h3>Tipo</h3>
                            <button>
                                <svg viewBox="0 -960 960 960" ><path d="M480-360 280-560h400L480-360Z"/></svg>
                            </button>
                        </div>
                        <div class="busqueda-producto">
                            <input type="text" placeholder="Buscar por Tipo">
                        </div>
                        <?php 
                            $nombres = array_column($productos_Seccion, 'nombre');
                            $nombres = array_map(function($nombre){return explode(" ", $nombre)[0];},$nombres);
                            foreach(array_count_values($nombres) as $nombres=>$count){
                                echo '
                                <div class="marca-Producto">
                                    <input type="checkbox"> <p>'. $nombres.'('.$count.')</p>
                                </div>';
                            }
                        ?>
                    </section>
                    <section class="filtro-Precio">
                        <div class="submenu-Precio">
                            <h3>Precio</h3>
                            <button>
                                <svg viewBox="0 -960 960 960"><path d="M480-360 280-560h400L480-360Z"/></svg>
                            </button>
                        </div>
                        <ul>
                            <?php 
                                $precios = array_column($productos_Seccion,'precio');
                                sort($precios);
                                $lista_Precios = $precios;
                                for ($cont =0; $cont < count($lista_Precios); $cont+=2){
                                    $cantidad = count(array_filter($lista_Precios, fn($precio) => $precio <= $lista_Precios[$cont + 1] & $precio >= $lista_Precios[$cont]));
                                    if ((count($lista_Precios) % 2) & $cont == count($lista_Precios) - 3){
                                        echo '<p>$'.$lista_Precios[$cont].' - $'.$lista_Precios[$cont +2 ].' ('.$cantidad.')</p>';
                                        break;
                                    }else{
                                        echo '<p>$'.$lista_Precios[$cont].' - $'.$lista_Precios[$cont + 1].' ('.$cantidad.')</p>';
                                    }
                                }
                            ?>
                        </ul>
                        <div class="rango-Precio">
                            <input type="text" placeholder="Min.">
                            <p>-</p>
                            <input type="text" placeholder="Max.">
                            <button>
                                <svg viewBox="0 -960 960 960"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                            </button>
                        </div>
                    </section>
                </aside>
                <div class="productos-Seccion">
                    <?php 
                        $metodos_Compartidos = new metodos();
                        echo  '<h1>'.htmlspecialchars($seccion_Productos).'</h1>';
                        echo '<section class="productos">';
                            $metodos_Compartidos->imprimir_Productos($productos_Seccion, $añadir_a_Carrito = "submit_compra", $ver_producto = "producto");
                        echo '</section>';
                        if (isset($_POST['submit_compra'])){
                            $metodos_Compartidos->añadir_a_Carrito($productos_Seccion, $_POST['p_id_Seccion']);
                        }elseif(isset($_POST['producto'])){
                            $metodos_Compartidos->ver_Producto($productos_Seccion, $_POST['p_id_Seccion']);
                        }
                    ?>
                </div>
            </section>
        </main>
        <?php $metodos_Compartidos->mfooter(); ?> 
    </body>
</html>