<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hardware Store Nuts and Bolts</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
        <link rel="stylesheet" href="/static/css/style-Producto.css">
        <link rel="stylesheet" href="/static/css/style.css"/> 
    </head>
    <?php 
        session_start();
        require('../includes/metodos.php');
        $metodos_Compartidos = new metodos();
        echo $metodos_Compartidos->mheader();
        $producto_Presente = (unserialize(urldecode($_GET['value'])) != null) ? unserialize(urldecode($_GET['value'])): json_decode(urldecode($_GET['value']), true);

        if (isset($_POST['buscar'])){
            include('../database/database.php');
            $producto_Buscado =(new database())->buscar_Producto($_POST['busqueda']);
            $metodos_Compartidos->ver_Producto(null,null,$producto_Buscado);
        }
    ?>
    <body>
        <section class="Producto">
            <img src="../imgs/producto.jpg" alt="Imagen-Generica-Producto" class="img_producto">
            <div class="Informacion">
                <?php  
                    echo '
                        <div>
                            <h1>'.htmlspecialchars($producto_Presente['proveedor']).'</h1>
                            <h2 id ="nombre">'.htmlspecialchars($producto_Presente['nombre']).'</h2>
                            <h2 id ="descuento">$'.(htmlspecialchars($producto_Presente['descuento'])).'</h2>
                            <del id ="precio">$'.htmlspecialchars($producto_Presente['precio']).'</del>
                        </div>';
                ?>
                <div class="botones">
                    <button class="añadir_producto" id="add_product">Añadir al Carrito</button>
                    <input class="cantidad_Productos" id="cantidad" type="number" name="cantidad_Productos" value="1" min=1>
                </div>
                <script src="/static/js/app.js"></script>
            </div>
        </section>
        
    </body>
    <?php $metodos_Compartidos->mfooter()?>
</html>
