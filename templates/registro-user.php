<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Hardware Store Nuts and Bolts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/static/style.css"/> 
        <link rel="stylesheet" href="/static/style-Logeo.css">
    </head>
    <body>
        <?php 
            require('metodos.php');
            $metodos_Compartidos = new metodos();
            echo $metodos_Compartidos->mheader();
            if (isset($_POST['buscar'])){
                include('../database/database.php');
                $db = new database();
                $producto_Buscado =$db->buscar_Producto($_POST['busqueda']);
                $metodos_Compartidos->ver_Producto(null,null,$producto_Buscado);
            }
        ?>
        <main>
            <form method="POST" action="">
                <section class="nombre">
                    <h1>Nombre</h1>
                    <input type="text" placeholder="Eje:Juan Esteban Garcia" require = "" name = "nombre">
                </section>
                <section>
                    <h1>Email</h1>
                    <input type="email" placeholder="Eje:ejemplo@mail.com" require= "" name = "email">
                </section>
                <section>
                    <h1>Contraseña</h1>
                    <input type="password" placeholder="Eje:iScRnMx$uR^xGC63" require = "" name = "password">
                </section>
                <button class="recibir-codigo" type="submit" name="sumit">Crear Cuenta</button>
            </form>
            <?php 
                if (isset($_POST['sumit'])){
                    $nombre = $_POST['nombre'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    require_once('../database/database.php');
                    $db = new database();
                    $corroboracion_Cuenta = ($db->registro($nombre, $email, $password)) ? : '';
                    if ($corroboracion_Cuenta == "Ya existe una cuenta con ese correo"){
                        echo $corroboracion_Cuenta;
                    }else{
                        echo "<meta http-equiv='refresh' content='0;url=inicio.php'>";
                    }
                }
            ?>
        </main>
        <?php $metodos_Compartidos->mfooter(); ?>
    </body>
</html>