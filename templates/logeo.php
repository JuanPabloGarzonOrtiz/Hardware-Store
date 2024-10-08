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
        include('base.php');
        echo mheader();
    ?>
    <main>
        <form method="POST" action="">
            <section class="correo-Usuario">
            <h1>Correo Electronico</h1>
                <input type="text" placeholder="Eje:ejemplo@mail.com" name="correo">
            </section>
            <section class="contraseña-Usuario">
                <h1>Contraseña</h1>
                <input type="text" placeholder="Ingrese su contraseña" name="contraseña">
                <button type="submit" name="sumit">Entrar</button>
            </section>
        </form>
        <?php
            if (isset($_POST['sumit'])){
                $correo = $_POST['correo'];
                $contraseña = $_POST['contraseña'];
                require('../database/database.php');
                $db = new database();
                $corroboracion_Cuenta = $db->logeo($correo,$contraseña);
                if ($correo != "" && $contraseña != ""){
                    echo htmlspecialchars($corroboracion_Cuenta[0] ['tipo_Cliente']);
                }
            }
        ?>
        <p><hr></p>
        <a href="registro-user.php"  class="creacion-cuenta"><strong>¿No tienes una cuenta? Regístrate</strong></a>
    </main>
    <?php mfooter(); ?> 
</body>
</html>