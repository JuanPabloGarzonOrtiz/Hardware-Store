<?php 
    function mheader(){
        return '
            <header>
                <img src="/imgs/Logo_Pagina.png" alt="Logo_Pagina" width="100" class="Logo_Pagina">
                <nav>
                    <section class="barra">
                        <input type="text" placeholder="Buscar..." class="barra_Busqueda">
                        <button class="button_Buscar"><img src="/imgs/buscar.png" alt="Icono_Buscar" width="22" ></button>
                    </section>
                    <section >
                        <strong>
                        <a href="/index.php">Home</a>
                        <a href="/templates/division-productos.php?texto=Construccion">Construcción</a>
                        <a href="/templates/division-productos.php?texto=Ornamentacion">Ornamentación</a>
                        <a href="/templates/division-productos.php?texto=Latoneria">Latoneria</a>
                        <a href="/templates/division-productos.php?texto=Pintura">Pintura</a>
                        </strong>
                    </section>
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
                        <img src="imgs/telefono.png" alt="icono_Telefono" width="20">
                        <p>#########</p>
                    </div>
                    <div class="ubicacion">
                        <img src="imgs/ubicacion.png" alt="icono_Ubicacion" width="20">
                        <p>Dirección Ciudad, País</p>
                    </div>
                    <div class="whatsapp">
                        <img src="imgs/whatsapp.png" alt="icono_WhatsApp" width="20">
                        <p>#########</p>
                    </div>
                    <div class="correo">
                        <img src="imgs/correo.png" alt="icono_Correro" width="20">
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
?>
