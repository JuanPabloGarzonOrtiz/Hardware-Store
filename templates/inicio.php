<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware Store Nuts and Bolts</title>
    <link rel="stylesheet" href="/static/style.css"/> 
    <link rel="stylesheet" href="/static/style-Home.css">

</head>
<?php 
    function Imprimir($productos, $name_Sumit){
        if ($name_Sumit == "submit_compra_Ofertas"){
            $id = "p_id_Oferta";
        }elseif ($name_Sumit == "submit_Mas_Vendidos"){
            $id = "p_id_Mas_Vendidos";
        }elseif ($name_Sumit == "submit_compra_ultimos"){
            $id = "p_id_Visto";
        }
        for ($cont = 0; $cont < count($productos); $cont ++){
            echo '
                <div class="producto">
                    <figure>
                        <img src="imgs/producto.jpg" alt="Imagen-Generica-Producto"  class="img_producto">
                    </figure>
                    <div class="info-producto">
                        <h2>'. htmlspecialchars($productos[$cont]['nombre']).'</h2>'.
                        '<p>'. htmlspecialchars($productos[$cont]['marca']).'</p>'.
                        '<del>$'. htmlspecialchars($productos[$cont]['precio']).'</del>'.
                        '<h2>$'. htmlspecialchars($productos[$cont]['precio']) - htmlspecialchars($productos[$cont]['descuento']).'</h2>'.
                    '</div>
                    <form method="POST" action="">
                        <input type="hidden" name='.$id.' value="' . $cont . '">
                        <div class="btns-producto">
                            <button class="ver_producto" type="submit" name="submit_ver">Ver Producto</button>
                            <button class="añadir_producto" type="submit" name='.$name_Sumit.'>Añadir al Carrito</button>
                        </div>
                    </form>
                </div>';
        }
    }
    function añadir_a_Carrito($producto, $id){
        $jsonList = 'static/lista.json';
        $lista = file_get_contents($jsonList);
        $productos = json_decode($lista, true);
        $nuevoProducto = array(
            "nombre" => htmlspecialchars($producto[$id]['nombre']),
            "precio" => htmlspecialchars($producto[$id]['precio']),
            "precio_descuento" => htmlspecialchars($producto[$id]['descuento'])
        );
        $productos['productos'][] = $nuevoProducto; 
        file_put_contents($jsonList, json_encode($productos, JSON_PRETTY_PRINT));
    }
?>
<?php 
    include('base.php');
    $modifique_h = str_replace('<a href="/index.php">Home</a>',"",mheader());
    echo $modifique_h;
?>
<body>
    <main>
        <section >
            <h1 class="titulo_Ofertas">Ofertases</h1>
            <section class="productos">
                <?php
                    imprimir($productos_Oferta, $name_Sumit = "submit_compra_Ofertas");
                    if (isset($_POST['submit_compra_Ofertas'])){
                        añadir_a_Carrito($productos_Oferta, $_POST['p_id_Oferta']);
                    }
                ?>
                <button class="flecha"><img src="imgs/flecha.png" alt="flecha_Desplazamiento" class="img-flecha"></button>
            </section>
        </section>
        <section>
            <h1 class="titulo_Mas_Vendidos">Mas Vendidos</h1>
            <section class="productos">
                <?php
                    imprimir($productos_mas_vendidos, $name_Sumit = "submit_Mas_Vendidos");
                    if (isset($_POST['submit_Mas_Vendidos'])){
                        añadir_a_Carrito($productos_mas_vendidos, $_POST['p_id_Mas_Vendidos']);
                    }
                ?>
                <button class="flecha"><img src="imgs/flecha.png" alt="flecha_Desplazamiento" class="img-flecha"></button>
            </section>
        </section>
        <section>
        <?php
            if (isset($_SESSION['email_user'])) {
                $ultimos_Vistos = $db->ultimos_Productos($_SESSION['email_user']);
                echo '<h1 class="titulo_Vistos">Últimos Vistos</h1>
                        <section class="productos">';
                            if (empty($ultimos_Vistos)){
                                echo "No se han visto Productos";
                            }else{
                                imprimir($ultimos_Vistos, $name_Sumit = "submit_compra_ultimos");
                                if (isset($_POST['submit_compra_ultimos'])){
                                    añadir_a_Carrito($ultimos_Vistos, $_POST['p_id_Visto']);
                                }
                            }
                        echo '</section>';
            }
        ?>
        </section>
        <section class="Marcas">
            <h1>Marcas</h1>
            <section class="Logos">
                <img src="imgs/Logo_Structure.png" alt="Logo_Structure" width="200" class="Logo_Structure">
                <img src="imgs/Logo_Imperio-Mineral.png" alt="Logo_Imperio-Mineral" width="200" class="Logo_Imperio-Mineral">
                <img src="imgs/Logo_Boodywork-and-Paiting.png" alt="Logo_Boodywork-and-Paiting" width="200" class="Logo_Boodywork-and-Paiting">
                <img src="imgs/Logo_Picasso.png" alt="Logo_Picasso" width="200" class="Logo_Picasso">
            </section>
        </section>
    </main>
</body>
<?php 
    mfooter();
?>    