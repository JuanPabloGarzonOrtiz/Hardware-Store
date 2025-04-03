<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hardware Store Nuts and Bolts</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="/proyect_Hardware_Store/static/style.css"/> 
        <link rel="stylesheet" href="/proyect_Hardware_Store/static/style-Home.css">
    </head>
    <body>
        <?php 
            require('../database/database.php');
            $db = new database();
            require('metodos.php');
            $metodos_Compartidos = new metodos();
            $modifique_h = str_replace('<a href="/index.php">Home</a>',"",$metodos_Compartidos->mheader());
            echo $modifique_h;
            if (isset($_POST['buscar'])){
                $producto_Buscado =$db->buscar_Producto($_POST['busqueda']);
                $metodos_Compartidos->ver_Producto(null,null,$producto_Buscado);
            }
        ?>
        <main>
            <section >
                <h1 class="titulo_Ofertas">Ofertases</h1>
                <section class="productos">
                    <?php
                        $productos_Oferta = $db->ofertas();
                        $metodos_Compartidos->imprimir_Productos($productos_Oferta, $añadir_a_Carrito = "submit_compra_Ofertas", $ver_producto = "producto_Oferta");
                        if (isset($_POST['submit_compra_Ofertas'])){
                            $metodos_Compartidos->añadir_a_Carrito($productos_Oferta, $_POST['p_id_Oferta']);
                        }elseif(isset($_POST['producto_Oferta'])){
                            $metodos_Compartidos->ver_Producto($productos_Oferta, $_POST['p_id_Oferta']);
                        }
                    ?>
                    <button class="flecha"><img src="imgs/flecha.png" alt="flecha_Desplazamiento" class="img-flecha"></button>
                </section>
            </section>
            <section>
                <h1 class="titulo_Mas_Vendidos">Mas Vendidos</h1>
                <section class="productos">
                    <?php
                        $productos_mas_vendidos = $db->mas_vendidos();
                        $metodos_Compartidos->imprimir_Productos($productos_mas_vendidos, $añadir_a_Carrito = "submit_Mas_Vendidos", $ver_producto = "producto_Mas_Vendidos");
                        if (isset($_POST['submit_Mas_Vendidos'])){
                            $metodos_Compartidos->añadir_a_Carrito($productos_mas_vendidos, $_POST['p_id_Mas_Vendidos']);
                        }elseif(isset($_POST['producto_Mas_Vendidos'])){
                            $metodos_Compartidos->ver_Producto($productos_mas_vendidos, $_POST['p_id_Mas_Vendidos']);
                        }
                    ?>
                    <button class="flecha"><img src="imgs/flecha.png" alt="flecha_Desplazamiento" class="img-flecha"></button>
                </section>
            </section>
            <section>
            <?php
                if (isset($_SESSION['email_user'])& !is_int($_SESSION['email_user'])) {
                    $ultimos_Vistos = $db->ultimos_Productos($_SESSION['email_user']);
                    $productos_Ultimos_Vistos = (empty($ultimos_Vistos)) ? 
                            "No se han visto Productos" : 
                            (function() use ($metodos_Compartidos, $ultimos_Vistos){
                                ob_start();
                                $metodos_Compartidos->imprimir_Productos($ultimos_Vistos, $añadir_a_Carrito = "submit_compra_ultimos", $ver_producto = "producto_compra_ultimos");
                                return ob_get_clean();
                            })();
                            
                    echo '<h1 class="titulo_Vistos">Últimos Vistos</h1>
                            <section class="productos">'.
                                $productos_Ultimos_Vistos
                            .'</section>';
                    if (isset($_POST['submit_compra_ultimos'])){
                        $metodos_Compartidos->añadir_a_Carrito($ultimos_Vistos, $_POST['p_id_Visto']);
                    }elseif(isset($_POST['producto_compra_ultimos'])){
                        $metodos_Compartidos->ver_Producto($ultimos_Vistos, $_POST['p_id_Visto']);
                    }
                }
            ?>
            </section>
            <section class="Marcas">
                <h1 class="marcas">Marcas</h1>
                <section class="Logos">
                    <?php 
                        $archivos = scandir('../imgs/');
                        foreach($archivos as $archivo){
                            if (str_starts_with($archivo,"Logo") & $archivo != "Logo_Pagina.png"){
                                $nombre = substr($archivo,0,strlen($archivo) - 4);
                                echo '<img src="../imgs/'.$archivo.'" alt="'.$nombre.'" class="logo">';
                            }
                        }
                    ?>
                </section>
            </section>
        </main>
        <?php $metodos_Compartidos->mfooter(); ?>    
    </body>
</html>