<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hardware Store Nuts and Bolts</title>
        <link rel="stylesheet" href="/static/style-Producto.css">
        <link rel="stylesheet" href="/static/style.css"/> 
    </head>
    <?php 
        session_start();
        require('metodos.php');
        $metodos_Compartidos = new metodos();
        echo $metodos_Compartidos->mheader();
        $producto_Presente = unserialize(urldecode($_GET['value']));
        if (isset($_POST['buscar'])){
            include('../database/database.php');
            $db = new database();
            $producto_Buscado =$db->buscar_Producto($_POST['busqueda']);
            $metodos_Compartidos->ver_Producto(null,null,$producto_Buscado);
        }
    ?>
    <body>
        <section class="Producto">
            <div class="Imagen">
                <img src="../imgs/producto.jpg" alt="Imagen-Generica-Producto" class="img_producto">
            </div>
            <div class="Informacion">
                <?php  
                    echo '
                        <h1>'.htmlspecialchars($producto_Presente['proveedor']).'</h1>
                        <h2>'.htmlspecialchars($producto_Presente['nombre']).'</h2>
                        <h2>$'.(htmlspecialchars($producto_Presente['precio']) - htmlspecialchars($producto_Presente['descuento'])).'</h2>
                        <del>$'.htmlspecialchars($producto_Presente['precio']).'</del>
                    ';
                ?>
                <form action="" method="POST">
                    <div class="botones">
                        <button class="añadir_producto">Añadir al Carrito</button>
                        <input class="cantidad_Productos" type="number" name="cantidad_Productos" value="1" min=1>
                    </div>
                </form>
            </div>
        </section>
        <?php 
            if(isset($_POST['cantidad_Productos'])){
                $metodos_Compartidos = new metodos();
                $producto_Presente["cantidad"] = $_POST['cantidad_Productos'];
                $metodos_Compartidos->añadir_a_Carrito(null,null,$producto_Presente);
            }
        ?>
    </body>
    <?php $metodos_Compartidos->mfooter()?>
</html>
