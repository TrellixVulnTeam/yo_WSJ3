
$(document).ready(function () {
    getcategoria();

    _



});




var activities = document.getElementById("select_categorias");
activities.addEventListener("change", function () {
    $("#titulo_productos").html($("#select_categorias :selected").text());
    $(".productos").remove();
    getcategoria();
});

_

function getcategoria() {
    $.ajax({
        "url": appData.ws_url + "productos/getproductos/",
        'dataType': "json"
    })
        .done(function (json) {


            if (json.resultado) {
                $(".productos").remove();


                if ($("#select_categorias option[value='text-center']").length > 0) {

                }
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


                    if (categoria === $("#titulo_productos").html()) {

                        console.log(element)
                        $("#portfolio").append(
                            `
                            <div class="col-lg-4 col-sm-6 mb-4 productos" id="${element.idproducto}">
                            <div class="portfolio-item">
                            <a onclick="modaljeje(${element.idproducto},'${element.nombre_producto}','${element.descripcion_producto}','${element.imagen_producto}',${element.precio_producto},'${element.categoria_producto}')
                            "class="portfolio-link" data-bs-toggle="modal" href=".portfolio-modal">
                            <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid"style="height:500px; width:fill-content;" src="${appData.base_url}static/assets/img/build/img/calistenia/${imagen}"alt="..." />
                            </a>
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

                        console.log(element)
                        $("#portfolio").append(
                            `
                                <div class="col-lg-4 col-sm-6 mb-4 productos" id="${element.idproducto}">
                                <div class="portfolio-item">
                                <a onclick="modaljeje(${element.idproducto},'${element.nombre_producto}','${element.descripcion_producto}','${element.imagen_producto}',${element.precio_producto},'${element.categoria_producto}')
                                "class="portfolio-link" data-bs-toggle="modal" href=".portfolio-modal">
                                <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid"style="height:500px; width:fill-content;" src="${appData.base_url}static/assets/img/build/img/calistenia/${imagen}"alt="..." />
                                </a>
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
        .fail(error_ajax);
}


function modaljeje(idproducto, nombre_producto, descripcion_producto, imagen_producto, precio_producto, categoria_producto) {

    $("#ProjectName").html("");
    $("#ProjectDescription").html("");
    $("#ProjectPrice").html("");
    $("#ProjectCategory").html("");
    $("#ProjectImage").html("");
    $("#ProjectId").html("");
    console.log(idproducto, nombre_producto, descripcion_producto, imagen_producto, precio_producto);
    alert(idproducto)


    $("#ProjectId").html(idproducto);
    $("#ProjectName").html(nombre_producto);

    $("#ProjectDescription").html(descripcion_producto);
    $("#ProjectPrice").html(precio_producto);
    $("#ProjectCategory").html(categoria_producto);
    $("#ProjectImage").attr("src", appData.base_url + 'static/assets/img/build/img/calistenia/' + imagen_producto);

    $("#addCart").attr("onclick", `addCart(${idproducto},'${nombre_producto}','${descripcion_producto}','${imagen_producto}',${precio_producto},'${categoria_producto}')`);


}



