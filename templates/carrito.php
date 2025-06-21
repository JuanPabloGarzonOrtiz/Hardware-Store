<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hardware Store Nuts and Bolts</title>
        <link rel="stylesheet" href="/static/css/style.css"/> 
        <link rel="stylesheet" href="/static/css/style-carrito.css"/>
    </head>
    <body>
        <?php 
            require('../includes/metodos.php');
            $metodos_Compartidos = new metodos();
            echo $metodos_Compartidos->mheader();
            if (isset($_POST['buscar'])){
                include('../database/database.php');
                $producto_Buscado =(new database())->buscar_Producto($_POST['busqueda']);
                $metodos_Compartidos->ver_Producto(null,null,$producto_Buscado);
            }
        ?>
        <main>
            <?php 
                session_start();
                ob_start();
                $jsonList = '../static/json/lista.json';
                $lista = file_get_contents($jsonList);
                $productos = json_decode($lista, true);
                $total = count($productos[$_SESSION['email_user']]['productos']);
                $contador = 0;
                $mensaje_NoRegistro = "";
                $descuento_Cantidad_Productos = 0;
                echo '<section class="info-Pedido">';
                        if ($total == 0){
                            echo  '<h1>No Hay Productos en el Carrito</h1>';
                            $lista_Precios = [];
                        }else{
                            foreach ($productos[$_SESSION['email_user']]['productos'] as $producto){
                                $contador++;
                                $lista_Precios [] = htmlspecialchars($producto['precio']) * intval(htmlspecialchars($producto['cantidad'])) ;
                                echo '
                                    <div class='.($contador == $total ? "ultimo-producto" : "producto").'>
                                        <h2 class="nombre_Producto">'. htmlspecialchars($producto['nombre']) .'</h2>
                                        <div>
                                            <div class="metodos-envio">
                                                <h3>Metodos de Envio</h3>
                                                <div class="metodo-envio">
                                                    <input type="checkbox">
                                                    <svg viewBox="0 -960 960 960" width="24px"><path d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z"/></svg>
                                                    <p>Envio Gratis</p>
                                                </div>
                                                <div class="metodo-envio">
                                                    <input type="checkbox">
                                                    <svg viewBox="0 -960 960 960" width="24px" ><path d="M841-518v318q0 33-23.5 56.5T761-120H201q-33 0-56.5-23.5T121-200v-318q-23-21-35.5-54t-.5-72l42-136q8-26 28.5-43t47.5-17h556q27 0 47 16.5t29 43.5l42 136q12 39-.5 71T841-518Zm-272-42q27 0 41-18.5t11-41.5l-22-140h-78v148q0 21 14 36.5t34 15.5Zm-180 0q23 0 37.5-15.5T441-612v-148h-78l-22 140q-4 24 10.5 42t37.5 18Zm-178 0q18 0 31.5-13t16.5-33l22-154h-78l-40 134q-6 20 6.5 43t41.5 23Zm540 0q29 0 42-23t6-43l-42-134h-76l22 154q3 20 16.5 33t31.5 13ZM201-200h560v-282q-5 2-6.5 2H751q-27 0-47.5-9T663-518q-18 18-41 28t-49 10q-27 0-50.5-10T481-518q-17 18-39.5 28T393-480q-29 0-52.5-10T299-518q-21 21-41.5 29.5T211-480h-4.5q-2.5 0-5.5-2v282Zm560 0H201h560Z"/></svg>
                                                    <p>Recoger en Tienda</p>
                                                </div>
                                            </div>
                                            <div class="precios">
                                                <p><del class="precio_Original">$'. htmlspecialchars($producto['precio']) .' Antes</del></p>
                                                <p class="precio_conDescuento">$'.(htmlspecialchars($producto['precio_descuento'])).' Hoy</p>
                                            </div>
                                            <section class="form">
                                                <div class="cantidad-productos">
                                                        <h4>Cantidad:</h4>
                                                        <input class="modify_count" type="number" id="cantidadInput" name ="nueva_Cantidad" value='.htmlspecialchars($producto['cantidad']).' min=1>
                                                </div>
                                                <input class="pd_id" type="hidden" name="p_id"  value="' . $contador . '">
                                                <div>
                                                    <button class="delete_product" type="submit" name="delete"  value="">Borrar Producto</button>
                                                </div>
                                            </section>
                                        </div>
                                    </div>';                                                                      
                            }
                        }
                echo '</section>';

                echo '<section class="resumen-Pedido" id="resumen-Pedido">
                        <h1>Mi Carrito</h1>
                        <div class="apartado-resumen">
                            <div class="precio">
                                <p>Subtotal</p> <p class="subtotal">$'.array_sum($lista_Precios) .'</p>
                            </div>
                            <div class="precio">
                                <p>Envio Gratis</p><p>$0.00</p>
                            </div>
                        </div>
                        <h2>Descuentos</h2>
                        <div class="apartado-resumen">';
                            if ($total == 0){
                                '<div class="producto">
                                    <p> </p> <p>$ </p>
                                </div>';
                                $lista_Descuentos[] = 0;
                                $precio_total = 0;
                            }
                            else{
                                foreach ($productos[$_SESSION['email_user']]['productos'] as $producto){
                                    $descuento = (htmlspecialchars($producto['precio']) - htmlspecialchars($producto['precio_descuento'])) * htmlspecialchars($producto['cantidad']);
                                    $lista_Descuentos [] = $descuento * htmlspecialchars($producto['cantidad']);
                                    $precio_total += (htmlspecialchars($producto['precio_descuento']))* htmlspecialchars($producto['cantidad']);
                                    echo 
                                    '<div class="producto" id="producto">
                                        <p class="name_product">'.htmlspecialchars($producto['nombre']).'</p> <p class="descuento">$'. $descuento .'</p>
                                    </div>';
                                } 
                            }
                            echo '<div class="total-descuento">
                                    <p><strong>Total Descuento:</strong></p><p><strong id="total_Descuento">$'.array_sum($lista_Descuentos).'</strong></p>
                                </div>
                        </div>';
                        if (isset($_SESSION['email_user'])){
                            require('../database/database.php');
                            $cantidad_Compras = (new database())->descuento_Cliente($_SESSION['email_user']);
                            $cantidad = (!empty($cantidad_Compras) ? htmlspecialchars($cantidad_Compras['Cantidad_Compras']): 0);
                            match (true){
                                $cantidad == 0 => $descuento = 0,
                                $cantidad >= 1 && $cantidad <= 4 => $descuento = 2,
                                $cantidad >=5 && $cantidad <= 9 => $descuento = 5,
                                $cantidad >= 10 => $descuento = 10
                            };
                            $descuento_Cliente_Aplicado = ($descuento * $precio_total)/100;
                            echo '
                            <div class="descuento_Cliente" id="descuento_Cliente">
                                <h2>Descuento Cliente Frecuente</h2>
                                <div>
                                    <p>$'.$descuento.'%</p> <p class="descuentos_Porcentaje">$'.$descuento_Cliente_Aplicado.'</p>
                                </div>
                            </div>';
                        }
                        if ($precio_total >= 100){
                            $descuento_Cantidad_Productos = (10 * $precio_total)/100;
                            echo '
                            <div class="descuento_Cliente" id="descuento_Cantidad">
                                <h2>Descuento Cantidad de Productos</h2>
                                <div>
                                    <p>$10%</p> <p class="descuentos_Porcentaje" id="descuento_Cantidad">$'.$descuento_Cantidad_Productos.'</p>
                                </div>
                            </div>';
                        }
                        echo '<div>
                            <div class="total_Cantidad">
                                <p><strong>Total:</strong></p><p><strong id="total">$' .$precio_total - $descuento_Cliente_Aplicado - $descuento_Cantidad_Productos .'</strong></p>
                            </div>
                            <form class = "buttons" method="POST" action="">
                                <button type="submit" name="submit_pagar">Pagar</button>
                                <button type="submit" name="submit_cotizar">Cotizar</button>
                            </form>
                        </div>';
                echo '</section>';
                if (isset($_POST['submit_pagar']) || isset($_POST['submit_cotizar'])) {
                    if (isset($_SESSION['email_user'])  & !is_int($_SESSION['email_user'])){
                        $jsonList = '../static/json/lista.json';
                        $lista =file_get_contents($jsonList);
                        $productos = json_decode($lista, true);
                        for ($cont= count($productos[$_SESSION['email_user']]['productos']) - 1; $cont >= 0; $cont --){
                            unset($productos[$_SESSION['email_user']]['productos'][$cont]);
                        }
                        file_put_contents($jsonList, json_encode($productos, JSON_PRETTY_PRINT));
                        sleep(5);
                        header('Location: ../index.php');
                        exit(); 
                    }
                }
            ?>
            <script src="/static/js/app.js"></script>
        </main>
        <?php $metodos_Compartidos->mfooter();?> 
    </body>
</html>