$(document).ready(function () {
    //OBTENER PRODUCTOS
    $.ajax({
        "url": appData.ws_url + "productos/getproductos/",
        'dataType': "json"
    })
        .done(function (json) {
         
            if (json.resultado) {
                $("#campos").html("");

                Object.keys(json.productos[0]).forEach((element, i) => {
                    $("#campos").append(
                        '<th>' + element + '</th>'
                    );
                    setTimeout(() => {
                        $("#tbody").append(
                            '<tr>' +
                            '<td>' +
                            '<span class="custom-checkbox">' +
                            '<input type="checkbox" id="checkbox1" name="options[]" value="1">' +
                            '<label for="checkbox1"></label>' +
                            '</span>' +
                            '</td>' +
                            '<td>' + json.productos[i]["idproducto"] + '</td>' +
                            '<td>' + json.productos[i]["categoria_producto"] + '</td>' +
                            '<td>' + json.productos[i]["nombre_producto"] + '</td>' +
                            '<td>' + json.productos[i]["descripcion_producto"] + '</td>' +
                            '<td>' + json.productos[i]["imagen_producto"] + '</td>' +
                            '<td>' + json.productos[i]["precio_producto"] + '</td>' +
                            '<td>' +
                            '<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>' +
                            '<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>' +
                            '</td>' +
                            '</tr>'
                        );
                        Object.keys(json.productos).forEach((element, i) => {
                            $("#cant").html("Amount of products: " + (i + 1));
                        });
                    }, 1000);
                });
                Object.keys(json.productos[0]).forEach((element, i) => {
                    $("." + element).text(element);
                })
            }
            else {
                alerta("info", json.mensaje);
            }
        })
        .fail();
})//FIN DEL READY


$("#insertar").submit(function (e) {

    e.preventDefault();
    $.ajax({
        "url": appData.ws_url + "productos/registraproducto/",
        'dataType': "json",
        "type": "post",
        "data": {
            "categoria_producto": $("#categoria_producto").val(),
            "nombre_producto": $("#nombre_producto").val(),
            "descripcion_producto": $("#descripcion_producto").val(),
            "imagen_producto": document.insertar.imagen_producto.value,
            "precio_producto": $("#precio_producto").text()
        }
    })
        .done(function (json) {
            if (json.resultado) {
                alerta("success", json.mensaje);
            }
        })
        .fail();
});


