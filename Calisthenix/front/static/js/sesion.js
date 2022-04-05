var expMail = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
var x = 0;
$(document).ready(function () {
    //Evento submit del form-registro
    $("#form-registro").submit(function (e) {
        e.preventDefault();

        nombre = $("#nombreUser").val() == undefined ? '' : $("#nombreUser").val().trim();
        apellido = $("#ApellidoUser").val() == undefined ? '' : $("#ApellidoUser").val().trim();
        telefono = $("#NumeroUser").val() == undefined ? '' : $("#NumeroUser").val().trim();
        emial = $("#emailUser").val() == undefined ? '' : $("#emailUser").val().trim();
        password = $("#passwordUser").val() == undefined ? '' : $("#passwordUser").val().trim();
        direccion = $("#ciudadUser").val() == undefined ? '' : $("#ciudadUser").val().trim();

        if (nombre.length <= 2) {
            $("#nombreUser").removeClass("is-valid");
            $("#nombreUser").addClass("is-invalid");
            x = 0;
        }
        else {
            $("#nombreUser").removeClass("is-invalid");
            $("#nombreUser").addClass("is-valid");
            x = 1;
        }
        if (apellido.length <= 2) {
            $("#ApellidoUser").removeClass("is-valid");
            $("#ApellidoUser").addClass("is-invalid");
            x = 0;
        }
        else {
            $("#ApellidoUser").removeClass("is-invalid");
            $("#ApellidoUser").addClass("is-valid");
            x = 1;
        }

        if (telefono.length == 10) {
            $("#NumeroUser").removeClass("is-invalid");
            $("#NumeroUser").addClass("is-valid");
            x = 1;
        }
        else {
            $("#NumeroUser").removeClass("is-valid");
            $("#NumeroUser").addClass("is-invalid");
            x = 0;
        }

        if (!expMail.test($("#emailUser").val())) {
            $("#emailUser").addClass("is-valid");
            $("#emailUser").removeClass("is-invalid");
            x = 1;
        }
        else {
            $("#NombreUser").removeClass("is-invalid");
            $("#NombreUser").addClass("is-valid");
            x = 1;
        }
        if (password.length < 8) {
            $("#passwordUser").removeClass("is-valid");
            $("#passwordUser").addClass("is-invalid");
            x = 0;

        }
        else {
            $("#passwordUser").addClass("is-valid");
            $("#passwordUser").removeClass("is-invalid");
            x = 1;
        }
        if (direccion.length < 15) {
            $("#ciudadUser").removeClass("is-valid");
            $("#ciudadUser").addClass("is-invalid");
            x = 0;
        }
        else {
            $("#ciudadUser").addClass("is-valid");
            $("#ciudadUser").removeClass("is-invalid");
            x = 1;
        }

        if (!$(".tiene").hasClass("is-invalid")) {
            $.ajax({
                'url': appData.ws_url + "acceso/registrajugador/",
                "dataType": "json",
                "type": "post",
                "data": {
                    "nombre_cliente": $("#Nombreuser").val(),
                    "apellidos_cliente": $("#ApellidoUser").val(),
                    "telefono": $("#NumeroUser").val(),
                    "email_cliente": $("#emailUser").val(),
                    "direccion": $("#ciudadUser").val(),
                    "password_cliente": $("#passwordUser").val()
                }
            })
                .done(function (json) {
                    if (json.resultado) {
                        $('#cerrar').click();
                        janelaPopUp.abre("example", 'p green', 'REGISTER', json.mensaje);
                        setTimeout(function () { janelaPopUp.fecha('example'); }, 2000);
                        setTimeout(() => {
                            location.href = appData.base_url;
                        }, 2000);
                    }
                    else {
                        $('#cerrar').click();
                        janelaPopUp.abre("example", 'p red', 'REGISTER', "This " + json.mensaje + ". try again");
                        setTimeout(function () { janelaPopUp.fecha('example'); }, 8000);
                    }
                })
                .fail();
        }
    });


    $("#newModalTableForm").submit(function (e) {
        e.preventDefault();

        if ($("#correoelectronico").val() == "") {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Debes introducir tu correo electrónico!',
            });
        }
        else if ($("#pass").val() == "") {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Debes introducir tu contraseña!',
            });
        }
        else {
            $.ajax({
                'url': appData.ws_url + "acceso/verficausuario/",
                'dataType': "json",
                "type": "post",
                "data": {
                    "email_cliente": $("#correoelectronico").val(),
                    "password_cliente": $("#pass").val()
                }
            })
                .done(function (json) {
                    if (json.resultado) {
                        $(location).attr(
                            "href",
                            appData.base_url + "home/inicio/" +
                            json.cliente.idcliente + "/" +
                            json.cliente.nombre_cliente + "/" +
                            json.cliente.email_cliente + "/" +
                            json.cliente.apellidos_cliente + "/" +
                            json.cliente.direccion + "/" +
                            json.token
                        );
                    }
                    else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Oops...',
                            text: 'Password doesnt match your account!',
                        });
                    }
                })
                .fail();
        }
    })
});
