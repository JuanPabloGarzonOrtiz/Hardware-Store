<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware Store Nuts and Bolts</title>
    <link rel="stylesheet" href="/static/style-division-productos.css">
    <link rel="stylesheet" href="/static/style.css"/> 
</head>
<body>
    <?php 
        include('base.php');
        echo mheader();
    ?>
    <main>
        <section class="divisiones-pag-productos">
            <aside>
                <h2>Fitrar por:</h2>
                <section class="filtro-Marca">  
                    <div class="submenu-Marca">
                        <h3>Marca</h3>
                        <button>
                            <svg viewBox="0 -960 960 960" ><path d="M480-360 280-560h400L480-360Z"/></svg>
                        </button>
                    </div>
                    <div class="busqueda-producto">
                        <input class="checkboxInput" type="text" placeholder="Buscar por Marca">
                    </div>
                    <div class="marca-Producto">
                        <input type="checkbox"> <p>Producto (#)</p>
                    </div>
                    <div class="marca-Producto">
                        <input type="checkbox"> <p>Producto (#)</p>
                    </div>
                    <div class="marca-Producto">
                        <input type="checkbox"> <p>Producto (#)</p>
                    </div>
                    <div class="marca-Producto">
                        <input type="checkbox"> <p>Producto (#)</p>
                    </div>
                </section>
                <section class="filtro-Tipo">  
                    <div class="submenu-Tipo">
                        <h3>Tipo</h3>
                        <button>
                            <svg viewBox="0 -960 960 960" ><path d="M480-360 280-560h400L480-360Z"/></svg>
                        </button>
                    </div>
                    <div class="busqueda-producto">
                        <input type="text" placeholder="Buscar por Tipo">
                    </div>
                    <div class="marca-Producto">
                        <input type="checkbox"> <p>Producto (#)</p>
                    </div>
                    <div class="marca-Producto">
                        <input type="checkbox"> <p>Producto (#)</p>
                    </div>
                    <div class="marca-Producto">
                        <input type="checkbox"> <p>Producto (#)</p>
                    </div>
                    <div class="marca-Producto">
                        <input type="checkbox"> <p>Producto (#)</p>
                    </div>
                </section>
                <section class="filtro-Precio">
                    <div class="submenu-Precio">
                        <h3>Precio</h3>
                        <button>
                            <svg viewBox="0 -960 960 960"><path d="M480-360 280-560h400L480-360Z"/></svg>
                        </button>
                    </div>
                    <ul>
                        <p>$0,00 - $0,00  (#)</p>
                        <p>$0,00 - $0,00  (#)</p>
                        <p>$0,00 - $0,00  (#)</p>
                        <p>$0,00 - $0,00  (#)</p>
                    </ul>
                    <div class="rango-Precio">
                        <input type="text" placeholder="Min.">
                        <p>-</p>
                        <input type="text" placeholder="Max.">
                        <button>
                            <svg viewBox="0 -960 960 960"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                        </button>
                    </div>
                </section>
            </aside>
            <div class="productos-Seccion">
                <?php 
                    $seccion_Productos = $_GET['texto'];
                    echo  '<h1>'.htmlspecialchars($seccion_Productos).'</h1>';
                ?>
                <section class="productos">
                    <?php 
                        include('../database/database.php');
                        $db = new database();
                        $productos_Seccion = $db->productos_sec($seccion_Productos);
                        for ($cont = 0; $cont < count($productos_Seccion); $cont ++){
                            echo '
                                <div class="producto">
                                    <figure>
                                        <img src="/imgs/producto.jpg" alt="Imagen-Generica-Producto"  class="img_producto">
                                    </figure>
                                    <div class="info-producto">
                                        <h3>'. htmlspecialchars($productos_Seccion[$cont]['nombre']).'</h3>'.
                                        '<p>'. htmlspecialchars($productos_Seccion[$cont]['Proveedor']).'</p>'.
                                        '<h2>$'. htmlspecialchars($productos_Seccion[$cont]['precio']).'</h2>'.
                                    '</div>
                                </div>';
                        }
                    ?>
                </section>
            </div>
        </section>
    </main>
    <?php 
        mfooter();
    ?> 
</body>
</html>
