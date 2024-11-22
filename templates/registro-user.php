<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hardware Store Nuts and Bolts</title>
        <link rel="stylesheet" href="/static/style.css"/> 
        <link rel="stylesheet" href="/static/style-Logeo.css">
    </head>
    <body>
        <div class="contenedor">
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
                    <section class="registro-usuario">
                        <h1>Nombre</h1>
                        <input type="text" placeholder="Eje:Juan Esteban Garcia" require = "" name = "nombre">
                        <h1>Email</h1>
                        <input type="email" placeholder="Eje:ejemplo@mail.com" require= "" name = "email">
                        <h1>Contraseña</h1>
                        <input type="password" placeholder="Eje:iScRnMx$uR^xGC63" require = "" name = "password">
                        <button class="recibir-codigo" type="submit" name="sumit">Recibir Codigo de Acceso</button>
                    </section>
                </form>
                <?php 
                    if (isset($_POST['sumit'])){
                        $nombre = $_POST['nombre'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        require_once('../database/database.php');
                        $db = new database();
                        $corroboracion_Cuenta = ($db->registro($nombre, $email, $password)) ? : '';
                        if ($corroboracion_Cuenta = "Ya existe una cuenta con ese correo"){
                            echo $corroboracion_Cuenta;
                        }else{
                            header('Location: ../index.php');
                        }
                    }
                ?>
            </main>
            <?php $metodos_Compartidos->mfooter(); ?>
        </div>
    </body>
</html>