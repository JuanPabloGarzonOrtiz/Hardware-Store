<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware Store Nuts and Bolts</title>
    <link rel="stylesheet" href="/static/style.css"/> 
    <link rel="stylesheet" href="/static/style-Home.css">

</head>
<body>
    <?php 
        include('base.php');
        $modifique_h = str_replace('<a href="/index.php">Home</a>',"",mheader());
        echo $modifique_h;
    ?>
    <main>
        <section >
            <h1 class="titulo_Ofertas">Ofertases</h1>
            <section class="productos">
                <?php
                    for ($cont = 0; $cont < count($productos_Oferta); $cont ++){
                        echo '
                            <div class="producto">
                                <figure>
                                    <img src="imgs/producto.jpg" alt="Imagen-Generica-Producto"  class="img_producto">
                                </figure>
                                <div class="info-producto">
                                    <h2>'. htmlspecialchars($productos_Oferta[$cont]['nombre']).'</h2>'.
                                    '<p>'. htmlspecialchars($productos_Oferta[$cont]['Marca']).'</p>'.
                                    '<del>$'. htmlspecialchars($productos_Oferta[$cont]['precio']).'</del>'.
                                    '<h2>$'. htmlspecialchars($productos_Oferta[$cont]['precio_Descuento']).'</h2>'.
                                '</div>
                            </div>';
                    }
                ?>
                <button class="flecha"><img src="imgs/flecha.png" alt="flecha_Desplazamiento" class="img-flecha"></button>
            </section>
        </section>
        <section>
            <h1 class="titulo_Ofertas">Mas Vendidos</h1>
            <section class="productos">
            <?php
                    for ($cont = 0; $cont < count($productos_mas_vendidos); $cont ++){
                        echo '
                            <div class="producto">
                                <figure>
                                    <img src="imgs/producto.jpg" alt="Imagen-Generica-Producto"  class="img_producto">
                                </figure>
                                <div class="info-producto">
                                    <h2>'. htmlspecialchars($productos_mas_vendidos[$cont]['nombre']).'</h2>'.
                                    '<p>'. htmlspecialchars($productos_mas_vendidos[$cont]['Marca']).'</p>'.
                                    '<h2>$ '. htmlspecialchars($productos_mas_vendidos[$cont]['precio']).'</h2>'.
                                '</div>
                            </div>';
                    }
                ?>
                <button class="flecha"><img src="imgs/flecha.png" alt="flecha_Desplazamiento" class="img-flecha"></button>
            </section>

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
    <?php 
        mfooter();
    ?>    
</body>