<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hardware Store Nuts and Bolts</title>
    <link rel="stylesheet" href="/static/style.css"/> 
    <link rel="stylesheet" href="/static/style-carrito.css">
</head>
<body>
    <?php 
        include('base.php');
        echo mheader();
    ?>
    <main>
        <section class="info-Pedido">
            <div class="producto">
                <h2>Producto</h2>
                <div class="metodos-envio">
                    <h3>Metodos de Envio</h3>
                    <div class="metodo-envio">
                        <input type="checkbox">
                        <svg viewBox="0 -960 960 960" width="24px"><path d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z"/></svg>
                        <p>Envio Gratis</p>
                    </div>
                    <div class="metodo-envio">
                        <input type="checkbox">
                        <svg viewBox="0 -960 960 960" width="24px" ><path d="M841-518v318q0 33-23.5 56.5T761-120H201q-33 0-56.5-23.5T121-200v-318q-23-21-35.5-54t-.5-72l42-136q8-26 28.5-43t47.5-17h556q27 0 47 16.5t29 43.5l42 136q12 39-.5 71T841-518Zm-272-42q27 0 41-18.5t11-41.5l-22-140h-78v148q0 21 14 36.5t34 15.5Zm-180 0q23 0 37.5-15.5T441-612v-148h-78l-22 140q-4 24 10.5 42t37.5 18Zm-178 0q18 0 31.5-13t16.5-33l22-154h-78l-40 134q-6 20 6.5 43t41.5 23Zm540 0q29 0 42-23t6-43l-42-134h-76l22 154q3 20 16.5 33t31.5 13ZM201-200h560v-282q-5 2-6.5 2H751q-27 0-47.5-9T663-518q-18 18-41 28t-49 10q-27 0-50.5-10T481-518q-17 18-39.5 28T393-480q-29 0-52.5-10T299-518q-21 21-41.5 29.5T211-480h-4.5q-2.5 0-5.5-2v282Zm560 0H201h560Z"/></svg>
                        <p>Recoger en Tienda</p>
                    </div>
                </div>
                <div class="precios">
                    <p><del>$0.00 Antes</del></p>
                    <p>$0.00 Hoy</p>
                </div>
                <div class="cantidad-productos">
                    <h4>Cantidad:</h4>
                    <input type="number">
                </div>
            </div>
            <div class="producto">
                <h2>Producto</h2>
                <div class="metodos-envio">
                    <h3>Metodos de Envio</h3>
                    <div class="metodo-envio">
                        <input type="checkbox">
                        <svg viewBox="0 -960 960 960" width="24px"><path d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z"/></svg>
                        <p>Envio Gratis</p>
                    </div>
                    <div class="metodo-envio">
                        <input type="checkbox">
                        <svg viewBox="0 -960 960 960" width="24px" ><path d="M841-518v318q0 33-23.5 56.5T761-120H201q-33 0-56.5-23.5T121-200v-318q-23-21-35.5-54t-.5-72l42-136q8-26 28.5-43t47.5-17h556q27 0 47 16.5t29 43.5l42 136q12 39-.5 71T841-518Zm-272-42q27 0 41-18.5t11-41.5l-22-140h-78v148q0 21 14 36.5t34 15.5Zm-180 0q23 0 37.5-15.5T441-612v-148h-78l-22 140q-4 24 10.5 42t37.5 18Zm-178 0q18 0 31.5-13t16.5-33l22-154h-78l-40 134q-6 20 6.5 43t41.5 23Zm540 0q29 0 42-23t6-43l-42-134h-76l22 154q3 20 16.5 33t31.5 13ZM201-200h560v-282q-5 2-6.5 2H751q-27 0-47.5-9T663-518q-18 18-41 28t-49 10q-27 0-50.5-10T481-518q-17 18-39.5 28T393-480q-29 0-52.5-10T299-518q-21 21-41.5 29.5T211-480h-4.5q-2.5 0-5.5-2v282Zm560 0H201h560Z"/></svg>
                        <p>Recoger en Tienda</p>
                    </div>
                </div>
                <div class="precios">
                    <p><del>$0.00 Antes</del></p>
                    <p>$0.00 Hoy</p>
                </div>
                <div class="cantidad-productos">
                    <h4>Cantidad:</h4>
                    <input type="number">
                </div>
            </div>
            <div class="ultimo-producto">
                <h2>Producto</h2>
                <div class="metodos-envio">
                    <h3>Metodos de Envio</h3>
                    <div class="metodo-envio">
                        <input type="checkbox">
                        <svg viewBox="0 -960 960 960" width="24px"><path d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z"/></svg>
                        <p>Envio Gratis</p>
                    </div>
                    <div class="metodo-envio">
                        <input type="checkbox">
                        <svg viewBox="0 -960 960 960" width="24px" ><path d="M841-518v318q0 33-23.5 56.5T761-120H201q-33 0-56.5-23.5T121-200v-318q-23-21-35.5-54t-.5-72l42-136q8-26 28.5-43t47.5-17h556q27 0 47 16.5t29 43.5l42 136q12 39-.5 71T841-518Zm-272-42q27 0 41-18.5t11-41.5l-22-140h-78v148q0 21 14 36.5t34 15.5Zm-180 0q23 0 37.5-15.5T441-612v-148h-78l-22 140q-4 24 10.5 42t37.5 18Zm-178 0q18 0 31.5-13t16.5-33l22-154h-78l-40 134q-6 20 6.5 43t41.5 23Zm540 0q29 0 42-23t6-43l-42-134h-76l22 154q3 20 16.5 33t31.5 13ZM201-200h560v-282q-5 2-6.5 2H751q-27 0-47.5-9T663-518q-18 18-41 28t-49 10q-27 0-50.5-10T481-518q-17 18-39.5 28T393-480q-29 0-52.5-10T299-518q-21 21-41.5 29.5T211-480h-4.5q-2.5 0-5.5-2v282Zm560 0H201h560Z"/></svg>
                        <p>Recoger en Tienda</p>
                    </div>
                </div>
                <div class="precios">
                    <p><del>$0.00 Antes</del></p>
                    <p>$0.00 Hoy</p>
                </div>
                <div class="cantidad-productos">
                    <h4>Cantidad:</h4>
                    <input type="number">
                </div>
            </div>
        </section>
        <section class="resumen-Pedido">
            <h1>Mi Carrito</h1>
            <div class="apartado-resumen">
                <div class="precio">
                    <p>Subtotal</p> <p>$0.00</p>
                </div>
                <div class="precio">
                    <p>Envio Gratis</p><p>$0.00</p>
                </div>
            </div>
            <h2>Descuentos</h2>
            <div class="apartado-resumen">
                <div class="producto">
                    <p>Producto</p> <p>$0.00</p>
                </div>
                <div class="producto">
                    <p>Producto</p><p>$0.00</p>
                </div>
                <div class="total-descuento">
                    <p><strong>Total Descuento:</strong></p><p><strong>$0.00</strong></p>
                </div>
            </div>
            <div class="total">
                <div>
                    <p><strong>Total:</strong></p><p><strong>$0.00</strong></p>
                </div>
                <button>Pagar</button>
            </div>
        </section>
    </main>
    <?php 
        mfooter();
    ?> 
</body>
</html>
