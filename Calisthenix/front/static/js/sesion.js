var expMail = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

$(document).ready(function(){
    //Evento submit del form-registro
    $("#form-registro").submit(function(e){
        e.preventDefault();
        alert("estoy registrando");
        // $(".invalid-feedback").remove();
        // $(".is-invalid").removeClass("is-invalid");
        
        // if($("#modal-nombre").val() == ""){
        //     error_formulario("modal-nombre","Name is required");
        //     return false;
        // }
        // else if($("#modal-correo").val() == ""){
        //     error_formulario("modal-correo","Email is required");
        //     return false;
        // }
        // else if( !expMail.test( $( "#modal-correo" ).val() ) ) {
        //     error_formulario( "modal-correo", "El formato del correo es erroneo ej(usuario@ejemplo.algo)" );
        //     return false;
        // }
        // else if($("#modal-telefono").val() == ""){
        //     error_formulario("modal-telefono","Phone is required");
        //     return false;
        // }


        //insercion jugador

        $.ajax({
            'url' : appData.ws_url + "acceso/registrajugador/",
            "dataType" : "json",
            "type" : "post",
            "data" : {
                "nombre_cliente" : $("#Nombreuser").val(),
                "apellidos_cliente" : $("#ApellidoUser").val(),
                "telefono" : $("#NumeroUser").val(),
                "email_cliente" : $("#emailUser").val(),
                "direccion" : $("#ciudadUser").val(),
                "password_cliente" : $("#passwordUser").val()
            }
        })
        .done( function(json){
            if(json.resultado){
                alerta("success",json.mensaje);
                $("#modal-registro").modal("toggle");
                $("#correo").val($("#modal-correo").val());
                $("#btn-entrar").focus();

            }
            else{
                alerta("danger",json.mensaje);
            }

        })
        .fail(alert("error"));

       


        return true;
    });

    //EVENTO CLICK BOTON REGISTRAR
    $("#btn-registrar").click(function(){
        $( ".invalid-feedback" ).remove();
        $( ".is-invalid" ).removeClass( "is-invalid" );
        $("#modal-nombre").val("");
        $("#modal-correo").val("");
        $("#modal-telefono").val("");
    });
    



    $("#btn-entrar").click(function(){
    
        $.ajax({
            'url' : appData.ws_url + "acceso/verficausuario/",
            'dataType' : "json",
            "type" : "post",
            "data" : {
                "email_cliente" : $("#correoelectronico").val()
            }
        })
        .done(function(json){
             alert(JSON.stringify(json));
            if(json.resultado){
                $(location).attr(
                    "href",
                    appData.base_url   + "home/inicio/" +
                    json.cliente.idcliente + "/" +
                    json.cliente.nombre_cliente + "/" + 
                    json.cliente.email_cliente + "/" +
                    json.token 
                );
            }
            else{
                alerta("danger",json.mensaje);
            }
        })
        .fail(alert("error"));
    })
    
    
})