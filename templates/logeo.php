<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
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
            <?php 
                require_once('../database/database.php');
                $db = new database();
                if(isset($_SESSION['email_user']) & !is_int($_SESSION['email_user'])){
                    echo '<form method="POST" action="">
                            <section class="close_session">
                                <button type="submit" name="submit_Cerrar">Cerrar Secion</button>
                                <button type="submit" name="submit_Borrar">Borrar Cuenta</button>
                            </section>
                        </form>';
                    if (isset($_POST['submit_Cerrar'])){
                        $db->cerrar_Secion();
                        header('Location: ../index.php');
                        exit();
                    }elseif(isset($_POST['submit_Borrar'])){
                        $db->borrar_Cuenta($_SESSION['email_user']);
                        $db->cerrar_Secion();
                        header('Location: ../index.php');
                        exit();
                    }
                }else{
                    echo '
                        <form method="POST" action="">
                            <section class="correo-Usuario">
                            <h1>Correo Electronico</h1>
                                <input type="text" placeholder="Eje:ejemplo@mail.com" name="correo">
                            </section>
                            <section class="contraseña-Usuario">
                                <h1>Contraseña</h1>
                                <input type="text" placeholder="Ingrese su contraseña" name="contraseña">
                            </section>
                            <button type="submit" name="submit">Entrar</button>
                        </form>
                        <p><hr></p>
                        <a href="registro-user.php"  class="creacion-cuenta"><strong>¿No tienes una cuenta? Regístrate</strong></a>
                    ';
                    if (isset($_POST['submit'])){
                        $correo = $_POST['correo'];
                        $contraseña = $_POST['contraseña'];
                        $corroboracion_Cuenta = ($db->logeo($correo, $contraseña)) ? : '';
                        if (!empty($corroboracion_Cuenta)){
                            echo "<meta http-equiv='refresh' content='0;url=inicio.php'>";
                            exit();
                        }else{
                            echo "Usuario o contraseña incorrecta";
                        }
                    }
                }
            ?>
        </main>
        <?php $metodos_Compartidos->mfooter(); ?> 
    </body>
</html>