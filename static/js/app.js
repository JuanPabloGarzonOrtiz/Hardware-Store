function POSTTOServ(array){
    array.metodo = "workToJS";
    return fetch("/includes/metodos.php", {
        method: "POST",
        body: JSON.stringify(array),
        headers: { "Content-Type": "application/json" }
    }).then(response => response.json());
}
function ArrayProduct(htmlProduct, additionValue = ""){
    let producto = {
        nombre: htmlProduct.querySelector("#nombre").textContent,
        precio: htmlProduct.querySelector("#precio").textContent.replace("$",""),
        descuento: htmlProduct.querySelector("#descuento").textContent.replace("$","")
    };
    if (additionValue.includes("to")){
        producto.type = "add";
        if (additionValue == "toSecction"){
            producto.id = htmlProduct.closest(".producto").querySelector(".id_product").value;
        }else if(additionValue == "toProduct"){
            producto.cantidad = document.querySelector(".cantidad_Productos").value;
        }
    }else if(additionValue == "redirection"){
        producto.proveedor = htmlProduct.querySelector("#marca").textContent;
    }
    return producto;
}
function MOdifyCar(btns_Select, action){
    if (btns_Select){
        for (let f = 0; f < btns_Select.length; f++) {
            btns_Select[f].addEventListener("click", function(){
                let htmlProductCar = this.closest(".producto") || this.closest(".ultimo-producto");
                let cantidad = (action == "update_cantidad") ? btns_Select[f].value : 1;
                let descuento_L = parseFloat(htmlProductCar.querySelector(".precio_Original").textContent.replace("$","").split(" ")[0]) - parseFloat(htmlProductCar.querySelector(".precio_conDescuento").textContent.replace("$","").split(" ")[0]);
                POSTTOServ({
                    type: action,
                    id: htmlProductCar.querySelector(".pd_id").value -1,
                    cantidad: cantidad
                }).then(retorno =>{
                    let name_product = htmlProductCar.querySelector(".nombre_Producto").textContent;
                    //Eliminar Producto de Lista en GUI
                    if (retorno.status === "eliminado"){
                        (btns_Select.length == 1) ? 
                            htmlProductCar.innerHTML = "<h1>No Hay Productos en el Carrito</h1>":
                            htmlProductCar.remove();
                    }
                    //Actualizacion de Resumen de Carrito
                    let subtotales = document.getElementsByClassName("precio_Original");
                    let totales = document.getElementsByClassName("precio_conDescuento");
                    let descuentos = document.querySelectorAll("#producto");
                    let val = 0;
                    let val_D = 0;
                    for (let g = 0; g < subtotales.length; g++) {
                        val += parseFloat(subtotales[g].textContent.replace("$","").split(" ")[0]) * count_Pro[g].value;
                        val_D += parseFloat(totales[g].textContent.replace("$","").split(" ")[0]) * count_Pro[g].value;
                    } 
                    document.querySelector(".subtotal").innerHTML = "$" + val; // Actualizacion de Subtotal

                    for (let h = 0; h < descuentos.length; h++) { //Actualizar Lista de Descuentos
                        if (descuentos[h].querySelector(".name_product").textContent == name_product){
                            let descuento_R = parseFloat(descuentos[h].querySelector(".descuento").textContent.replace("$","").split(" ")[0]);
                            let total_Descuento = parseFloat(document.querySelector("#total_Descuento").textContent.replace("$",""));
                            if (action === "delete"){
                                document.querySelector("#total_Descuento").innerHTML = "$" + (total_Descuento - descuento_R);
                                descuentos[h].remove();
                            }else{
                                descuentos[h].querySelector(".descuento").innerHTML = "$" + (descuento_L * cantidad);
                                const total = [...document.querySelectorAll(".descuento")]
                                    .reduce((acc, el) => acc + parseFloat(el.textContent.replace("$", "").split(" ")[0]), 0); //Convertir el NodeList de QuerySelector en Array y convertir cada elemento en numero para sumarlo al total
                                document.querySelector("#total_Descuento").innerHTML = "$" + (total);
                            }
                        }
                    }
                    // Actualizacion del Total y Descuento por Cliente Frecuente
                    let porcentaje_Descuento = 0;
                    let count_Descuentos = 0;
                    if(val_D >= 100 || document.querySelector("#descuento_Cliente") ){ 
                        porcentaje_Descuento = (10 * val_D)/100;
                        if (val_D >= 100 && !document.querySelector("#descuento_Cantidad")){
                            document.querySelector(".descuento_Cliente").insertAdjacentHTML("afterend",
                                `<div class="descuento_Cliente" id="descuento_Cantidad">
                                    <h2>Descuento Cantidad de Productos</h2>
                                    <div>
                                        <p>$10%</p> <p class="descuentos_Porcentaje" id="descuento_Cantidad">$${porcentaje_Descuento}</p>
                                    </div>
                                </div>`);
                        }else if( val_D < 100 && document.querySelector("#descuento_Cantidad")){
                            document.querySelector("#descuento_Cantidad").remove();
                        }
                        [...document.querySelectorAll(".descuentos_Porcentaje")].forEach(el => {
                            el.innerHTML = "$ " + porcentaje_Descuento;
                            count_Descuentos +=1;
                        });
                    }
                    document.querySelector("#total").innerHTML  = "$" + (val_D - (porcentaje_Descuento * count_Descuentos));

                    if(retorno.status === "eliminado"){                      
                        //Reasignacion de Ids de Productos
                        let pd_idsHTML = document.getElementsByClassName("pd_id");
                        for (let i = 0; i < pd_idsHTML.length; i++){
                            pd_idsHTML[i].value = i + 1;
                        }
                    }
                })
            });
            
        }
    }
}


let btn_addToSec = document.getElementsByClassName("añadir_producto");
let btn_product = document.getElementsByClassName("ver_producto");
if (btn_addToSec.length > 0 && btn_product.length > 0){
    for (let j = 0; j < btn_addToSec.length; j++) {
        // Metodo de Envio de POST para añadir productos al carrito desde una Seccion
        btn_addToSec[j].addEventListener("click", function() {
            POSTTOServ(ArrayProduct(this.closest(".producto"), "toSecction"));
        });
        // Redireccion a Vista de Producto en Espesifico
        btn_product[j].addEventListener("click", function(){
            objectProduct = ArrayProduct(this.closest(".producto"), "redirection");
            let serializedProduct = encodeURIComponent(JSON.stringify(objectProduct));
            window.location.href = `/templates/producto.php?value=${serializedProduct}`;
        });
    }
}

//Metodo de Envio de POST para añadir productos al carrito desde el producto espesifico
let btn_addToPro = document.getElementById("add_product");
if (btn_addToPro){
    btn_addToPro.addEventListener("click", function(){
        POSTTOServ(ArrayProduct(document, "toProduct"));
    });
}

let count_Pro = document.getElementsByClassName("modify_count");
let btns_deletePro = document.getElementsByClassName("delete_product");
if (count_Pro){//Modificar la Cantidad de Productos
    MOdifyCar(count_Pro, "update_cantidad");
}if(btns_deletePro){ //Eliminar Producto de Carrito de Compras
    MOdifyCar(btns_deletePro, "delete");
}