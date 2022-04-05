var deseoid = 0;
$(document).ready(function () {
    getcategoria();
});

var activities = document.getElementById("select_categorias");
activities.addEventListener("change", function () {
    $("#titulo_productos").html($("#select_categorias :selected").text());
    $(".productos").remove();
    getcategoria();
});

function getcategoria() {
    $.ajax({
        "url": appData.ws_url + "productos/getproductos/",
        'dataType': "json"
    })
        .done(function (json) {

            if (json.resultado) {

                productodeseo();



                $(".productos").remove();
                if ($("#select_categorias option[value='text-center']").length > 0) {                }
                else {
                    json.categorias.forEach(element => {
                        $("#select_categorias").append(
                            '<option value="text-center">' + element["categoria_producto"] + '</option>'
                        )
                    });
                }

                json.productos.forEach((element, i) => {

                    imagen = JSON.stringify(element["imagen_producto"]);
                    imagen = JSON.parse(imagen);

                    categoria = JSON.stringify(element["categoria_producto"]);
                    categoria = JSON.parse(categoria);

                    deseoid++
                    if (categoria === $("#titulo_productos").html()) {

                        $("#portfolio").append(
                            `
                            <div class="col-lg-4 col-sm-6 mb-4 productos" id="${element.idproducto}">
                            <div class="portfolio-item">
                            <a onclick="modaljeje(${element.idproducto},'${element.nombre_producto}','${element.descripcion_producto}','${element.imagen_producto}',${element.precio_producto},'${element.categoria_producto}',${element.cantidad})
                            "class="portfolio-link" data-bs-toggle="modal" href=".portfolio-modal">
                            <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid"style="height:500px; width:fill-content;" src="${appData.base_url}static/assets/img/build/img/calistenia/${imagen}"alt="..." />
                            </a>
                            <a id="addWishes_${element.idproducto}" onclick="addWishes(${element.idproducto},'${element.nombre_producto}','${element.descripcion_producto}','${element.imagen_producto}',${element.precio_producto},'${element.categoria_producto}')" class="nav-link" style="margin-inline:inherit;display:flex;position:absolute;"> <i id="idcorazon_${element.idproducto}"class="fa fa-heart"></i></a>
                            <div class="portfolio-caption">
                            <div class="portfolio-caption-heading">${element.nombre_producto}</div>
                            <div class="portfolio-caption-subheading text-muted">${element.descripcion_producto}</div>

                            </div>
                            </div>
                            </div>
                            `
                        )
                    }
                    else if ($("#select_categorias :selected").text() == "All") {

                        $("#portfolio").append(
                            `
                                <div class="col-lg-4 col-sm-6 mb-4 productos" id="${element.idproducto}">
                                <div class="portfolio-item">
                                <a onclick="modaljeje(${element.idproducto},'${element.nombre_producto}','${element.descripcion_producto}','${element.imagen_producto}',${element.precio_producto},'${element.categoria_producto}',${element.cantidad})
                                "class="portfolio-link" data-bs-toggle="modal" href=".portfolio-modal">
                                <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid"style="height:500px; width:fill-content;" src="${appData.base_url}static/assets/img/build/img/calistenia/${imagen}"alt="..." />
                                </a>
                                <a id="addWishes_${element.idproducto}" onclick="addWishes(${element.idproducto},'${element.nombre_producto}','${element.descripcion_producto}','${element.imagen_producto}',${element.precio_producto},'${element.categoria_producto}')" class="nav-link" style="margin-inline:inherit;display:flex;position:absolute;"> <i id="idcorazon_${element.idproducto}"class="fa fa-heart"></i></a>
                                <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">${element.nombre_producto}</div>
                                <div class="portfolio-caption-subheading text-muted">${element.descripcion_producto}</div>
                                </div>
                                </div>
                                </div>
                                `
                        )
                    }
                });
                appDataProductos = json;
            }
            else {
                alerta("info", json.mensaje);
            }
        })
        .fail();
}


function modaljeje(idproducto, nombre_producto, descripcion_producto, imagen_producto, precio_producto, categoria_producto,cantidad_producto) {
    $("#addCart").show();
    $("#ProjectName").html("");
    $("#ProjectDescription").html("");
    $("#ProjectPrice").html("");
    $("#ProjectCategory").html("");
    $("#ProjectImage").html("");
    $("#ProjectId").html("");
    $("#ProjectCantidad").html("");
    $("#ProjectId").html(idproducto);
    $("#ProjectName").html(nombre_producto);
    $("#ProjectDescription").html(descripcion_producto);
    $("#ProjectPrice").html(precio_producto);
    $("#ProjectCategory").html(categoria_producto);
    $("#ProjectCantidad").html(cantidad_producto);
    $("#ProjectImage").attr("src", appData.base_url + 'static/assets/img/build/img/calistenia/' + imagen_producto);
    if(cantidad_producto == 0){
        $("#ProjectCantidad").html("There're no products available"); 
        $("#addCart").hide();
    }

    $("#addCart").attr("onclick", `addCart(${idproducto},'${nombre_producto}','${descripcion_producto}','${imagen_producto}',${precio_producto},'${categoria_producto}')`);

}

