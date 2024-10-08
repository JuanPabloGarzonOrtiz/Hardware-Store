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
            include('base.php');
            echo mheader();
        ?>
        <main>
            <section class="registro-usuario">
                <h1>Correo Electronico</h1>
                <input type="text" placeholder="Eje:ejemplo@mail.com" >
                <button class="recibir-codigo">Recibir Codigo de Acceso</button>
            </section>
        </main>
        <?php 
        mfooter();
        ?>
    </div>

</body>
</html>