<?php 
    class metodos{
        public function añadir_a_Carrito($lista_Productos_Seccion = "", $id_Producto = "", $producto_Enviado = ""){
            $jsonList = '../static/lista.json';
            $lista = file_get_contents($jsonList);
            $productos = json_decode($lista, true);
            $producto_Existente = false;
            $producto = ($producto_Enviado == "") ? $lista_Productos_Seccion[$id_Producto] : $producto_Enviado;
            $nuevoProducto = array(
                "nombre" => htmlspecialchars($producto['nombre']),
                "precio" => htmlspecialchars($producto['precio']),
                "precio_descuento" => htmlspecialchars($producto['descuento']),
                "cantidad" => (htmlspecialchars($producto['cantidad'])  == NULL) ? 1 : htmlspecialchars($producto['cantidad'])
            );
            foreach($productos[$_SESSION['email_user']]['productos'] as &$producto){
                if ($producto['nombre'] === $nuevoProducto['nombre']){
                    $producto['cantidad'] += 1;
                    $producto_Existente = true;
                    break;
                }
            }
            if (!$producto_Existente){
                $productos[$_SESSION['email_user']]['productos'][] = $nuevoProducto;
            }
            file_put_contents($jsonList, json_encode($productos, JSON_PRETTY_PRINT));
        }
        public function imprimir_Productos($lista_Productos_Seccion,$añadir_a_Carrito, $ver_producto){
            match ($añadir_a_Carrito){
                "submit_compra_Ofertas" => $id = "p_id_Oferta",
                "submit_Mas_Vendidos" => $id = "p_id_Mas_Vendidos",
                "submit_compra_ultimos" => $id = "p_id_Visto",
                "submit_compra" => $id = "p_id_Seccion"
            };
            for ($cont = 0; $cont < count($lista_Productos_Seccion); $cont ++){
                echo '
                    <div class="producto">
                        <figure>
                            <img src="../imgs/producto.jpg" alt="Imagen-Generica-Producto"  class="img_producto">
                        </figure>
                        <div class="info-producto">
                            <h2>'. htmlspecialchars($lista_Productos_Seccion[$cont]['nombre']).'</h2>'.
                            '<p>'. htmlspecialchars($lista_Productos_Seccion[$cont]['marca']).'</p>'.
                            '<del>$'. htmlspecialchars($lista_Productos_Seccion[$cont]['precio']).'</del>'.
                            '<h2>$'. (htmlspecialchars($lista_Productos_Seccion[$cont]['precio']) - htmlspecialchars($lista_Productos_Seccion[$cont]['descuento'])).'</h2>'.
                        '</div>
                        <form method="POST" action="">
                            <input type="hidden" name='.$id.' value="' . $cont . '">
                            <div class="btns-producto">
                                <button class="ver_producto" type="submit" name='.$ver_producto.'>Ver Producto</button>
                                <button class="añadir_producto" type="submit" name='.$añadir_a_Carrito.'>Añadir al Carrito</button>
                            </div>
                        </form>
                    </div>';
            }
        }
        public function ver_Producto($lista_Productos_Seccion, $cont,$informacion_Producto = ""){
            $producto = ($informacion_Producto != "") ? $informacion_Producto : $lista_Productos_Seccion;
            $cont = ($producto == $informacion_Producto) ? 0 : $cont;
            $producto_Array = array(
                "nombre" => htmlspecialchars($producto[$cont]['nombre']),
                "precio" => htmlspecialchars($producto[$cont]['precio']),
                "descuento" => htmlspecialchars($producto[$cont]['descuento']),
                "proveedor" => htmlspecialchars($producto[$cont]['marca']),
                "cantidad" => 1
            );
            if(!is_numeric($_SESSION['email_user'])){
                require_once('../database/database.php');
                (new database())->nuevo_Visto($_SESSION['email_user'],htmlspecialchars($producto[$cont]['id_Producto']));
            }
            echo "<meta http-equiv='refresh' content='0;url=producto.php?value=" . urlencode(serialize($producto_Array)) . "'>";
        }
        function mheader(){
            return '
                <header>
                    <img src="/imgs/Logo_Pagina.png" alt="Logo_Pagina" width="100" class="Logo_Pagina">
                    <nav>
                        <section class="barra">
                            <form method="POST" action="">
                                <input type="text" placeholder="Buscar..." class="barra_Busqueda" name="busqueda">
                                <button class="button_Buscar" name="buscar">
                                    <svg height="24px" viewBox="0 -960 960 960">
                                        <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/>
                                    </svg>
                                </button>
                            </form>
                        </section>
                        <div class="menu-container">
                            <svg  tabindex="0" viewBox="0 -960 960 960" class="menu_Desplegable">
                                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
                            </svg>
                            <section class = "ln">
                                <strong>
                                <a href="/templates/inicio.php">Home</a>
                                <a href="/templates/division-productos.php?texto=Construcción">Construcción</a>
                                <a href="/templates/division-productos.php?texto=Ornamentación">Ornamentación</a>
                                <a href="/templates/division-productos.php?texto=Latoneria">Latoneria</a>
                                <a href="/templates/division-productos.php?texto=Pintura">Pintura</a>
                                </strong>
                            </section>
                        </div>
                    </nav>
                    <section class="Panel_Usario">
                        <a href="/templates/logeo.php" class="enlace_Cuenta">
                            <svg viewBox="0 -960 960 960"  class="icono_Cuenta"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                        </a>
                        <a href="/templates/carrito.php" class="enlace_Carrito">
                            <svg viewBox="0 -960 960 960"  class="icono_Carrito"><path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>
                        </a>
                        </section>
                </header>';
        }
        function mfooter(){
            echo '    
                <footer>
                    <section class="datos_Contacto">
                        <h2 class="q">¿Necesitas Ayuda?</h2>
                        <div class="telefono">
                            <svg height="24px" viewBox="0 -960 960 960"><path d="M798-120q-125 0-247-54.5T329-329Q229-429 174.5-551T120-798q0-18 12-30t30-12h162q14 0 25 9.5t13 22.5l26 140q2 16-1 27t-11 19l-97 98q20 37 47.5 71.5T387-386q31 31 65 57.5t72 48.5l94-94q9-9 23.5-13.5T670-390l138 28q14 4 23 14.5t9 23.5v162q0 18-12 30t-30 12ZM241-600l66-66-17-94h-89q5 41 14 81t26 79Zm358 358q39 17 79.5 27t81.5 13v-88l-94-19-67 67ZM241-600Zm358 358Z"/></svg>
                            <p>#########</p>
                        </div>
                        <div class="ubicacion">
                            <svg height="24px" viewBox="0 -960 960 960"><path d="M480-480q33 0 56.5-23.5T560-560q0-33-23.5-56.5T480-640q-33 0-56.5 23.5T400-560q0 33 23.5 56.5T480-480Zm0 294q122-112 181-203.5T720-552q0-109-69.5-178.5T480-800q-101 0-170.5 69.5T240-552q0 71 59 162.5T480-186Zm0 106Q319-217 239.5-334.5T160-552q0-150 96.5-239T480-880q127 0 223.5 89T800-552q0 100-79.5 217.5T480-80Zm0-480Z"/></svg>
                            <p>Dirección Ciudad, País</p>
                        </div>
                        <div class="whatsapp">
                            <svg height="24px" viewBox="0 0 50 50"><path d="M25,2C12.318,2,2,12.318,2,25c0,3.96,1.023,7.854,2.963,11.29L2.037,46.73c-0.096,0.343-0.003,0.711,0.245,0.966 C2.473,47.893,2.733,48,3,48c0.08,0,0.161-0.01,0.24-0.029l10.896-2.699C17.463,47.058,21.21,48,25,48c12.682,0,23-10.318,23-23 S37.682,2,25,2z M36.57,33.116c-0.492,1.362-2.852,2.605-3.986,2.772c-1.018,0.149-2.306,0.213-3.72-0.231 c-0.857-0.27-1.957-0.628-3.366-1.229c-5.923-2.526-9.791-8.415-10.087-8.804C15.116,25.235,13,22.463,13,19.594 s1.525-4.28,2.067-4.864c0.542-0.584,1.181-0.73,1.575-0.73s0.787,0.005,1.132,0.021c0.363,0.018,0.85-0.137,1.329,1.001 c0.492,1.168,1.673,4.037,1.819,4.33c0.148,0.292,0.246,0.633,0.05,1.022c-0.196,0.389-0.294,0.632-0.59,0.973 s-0.62,0.76-0.886,1.022c-0.296,0.291-0.603,0.606-0.259,1.19c0.344,0.584,1.529,2.493,3.285,4.039 c2.255,1.986,4.158,2.602,4.748,2.894c0.59,0.292,0.935,0.243,1.279-0.146c0.344-0.39,1.476-1.703,1.869-2.286 s0.787-0.487,1.329-0.292c0.542,0.194,3.445,1.604,4.035,1.896c0.59,0.292,0.984,0.438,1.132,0.681 C37.062,30.587,37.062,31.755,36.57,33.116z"/></svg>
                            <p>#########</p>
                        </div>
                        <div class="correo">
                            <svg height="24px" viewBox="0 -960 960 960"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/></svg>
                            <p>user@dominio.com</p>
                        </div>    
                    </section>
                    <section class="dudas">
                        <h2 class="asw">¿Tienes dudas?</h2>
                        <div class="enlaces_Dudas">
                            <a href="">Envío</a>
                            <a href="">Pago Seguro</a>
                            <a href="">Terminos y Condiciones</a>
                            <a href="">Tratamiento de Datos</a>
                        </div>
                    </section>
                    <section class="cotizacion">
                        <h2 class="titulo_Cotizacion">Cotizaciones<br>Personalizadas</h2>
                        <p class="indicaciones_Cotizacion">Para cotizaciones personalizadas, por favor ingrese su correo y lo mas pronto nos comunicaremos con usted.</p>
                        <div class="ingreso_Correo">
                            <input type="text" placeholder="Ingresa tu Correo Electronico" class="barra_Correo">
                            <button class="envio_Correo">Enviar</button>
                        </div>
                    </section>
                </footer>';
        }
    }
?>
