var expMail = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
var x = 0;
$(document).ready(function(){
    //Evento submit del form-registro
    $("#form-registro").submit(function(e){
        e.preventDefault();
        
        // nombre = $("#Nombreuser").val().trim();
        // apellidos = $("#ApellidoUser").val().trim();
        // telefono = $("#NumeroUser").val().trim();
        // emial = $("#emailUser").val().trim();
        // password = $("#passworduser").val().trim();
        // direccion =$("#ciudadUser").val().trim();
        // alert(nombre);
        // if(nombre.lenght <= 5){
        //     $("#divNombreuser").removeClass("success-input");
        //     $("#divNombreuser").addClass("error-input");
        // }
        // else{
        //     $("#divNombreuser").addClass("success-input");
        //     $("#divNombreuser").removeClass("error-input");
        // }
        $( ".success-input" ).removeClass( "success-input" );
        $( ".error-input" ).removeClass( ".error-input" );

        if( $( "#Nombreuser" ).val() == "" ) {
            $("#divNombreuser").removeClass("success-input");
             $("#divNombreuser").addClass("error-input");
             x=1;
        }
        else{
            $("#divNombreuser").addClass("success-input");
            $("#divNombreuser").removeClass("error-input");
            x=0;
        }

        if( $( "#ApellidoUser" ).val() == "" ) {
            $("#divApellidoUser").removeClass("success-input");
             $("#divApellidoUser").addClass("error-input");
             x=1;
        }
        else{
            $("#divApellidoUser").addClass("success-input");
            $("#divApellidoUser").removeClass("error-input");
            x=0;
        }

        if( $( "#NumeroUser" ).val() == "" ) {
            $("#divNumeroUser").removeClass("success-input");
             $("#divNumeroUser").addClass("error-input");
             x=1;
        }
        else{
            $("#divNumeroUser").addClass("success-input");
            $("#divNumeroUser").removeClass("error-input");
            x=0;
        }
        if( $( "#emailUser" ).val() == "" ) {
            $("#divNudivemailUsermeroUser").removeClass("success-input");
             $("#divNdivemailUserumeroUser").addClass("error-input");
             x=1;
        }
        else if( !expMail.test( $( "#emailUser" ).val() ) ) {
            $("#divNumeroUser").addClass("success-input");
            $("#divNumeroUser").removeClass("error-input");
            x=1;
        }
        else{
            $("#divemailUser").addClass("success-input");
            $("#divemailUser").removeClass("error-input");
            x=0;
        }
        if( $( "#passwordUser" ).val() == "" ) {
            $("#divpasswordUser").removeClass("success-input");
             $("#divpasswordUser").addClass("error-input");
             x=1;
        }
        else{
            $("#divpasswordUser").addClass("success-input");
            $("#divpasswordUser").removeClass("error-input");
            x=0;
        }
        if( $( "#ciudadUser" ).val() == "" ) {
            $("#divciudadUser").removeClass("success-input");
             $("#divciudadUser").addClass("error-input");
            x=1;
        }
        else{
            $("#divciudadUser").addClass("success-input");
            $("#divciudadUser").removeClass("error-input");
            x=0;
        }
        if(x==0){
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
            alert(JSON.stringify(json));
            if(json.resultado){
                alert("interesanrte");

                // alerta("success",json.mensaje);
                // $("#modal-registro").modal("toggle");
                // $("#correo").val($("#modal-correo").val());
                // $("#btn-entrar").focus();
                $('#cerrar').click();
                janelaPopUp.abre( "example", 'p green',  'REGISTER' ,  json.mensaje);
                setTimeout(function(){janelaPopUp.fecha('example');}, 2000);
                setTimeout(() => {
                    location.href = appData.base_url; 
                }, 2000);
              

               
                

            }
            else{
                 $('#cerrar').click();
                janelaPopUp.abre( "example", 'p red',  'REGISTER' ,  "This "+json.mensaje + ". try again");
                setTimeout(function(){janelaPopUp.fecha('example');}, 8000);
                // setTimeout(() => {
                //     location.href = appData.base_url; 
                // }, 2000);
              
                // alerta("danger",json.mensaje);
              
            }

        })
        .fail(error_ajax);
    }
    });


    $("#newModalTableForm").submit(function(e){
        e.preventDefault(); 
        
        if($("#correoelectronico").val()==""){
            alert("email vacio");
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Debes introducir tu correo electrónico!',
            });
        }
        else if($("#pass").val()==""){
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Debes introducir tu contraseña!',
            });
        }


        else{
            $.ajax({
                'url' : appData.ws_url + "acceso/verficausuario/",
                'dataType' : "json",
                "type" : "post",
                "data" : {
                    "email_cliente" : $("#correoelectronico").val(),
                    "password_cliente":$("#pass").val()
                }
            })
            .done(function(json){
                 alert(JSON.stringify(json.cliente));
    
               if(json.resultado){
                    $(location).attr(
                        "href",
                        appData.base_url   + "home/inicio/" +
                        json.cliente.idcliente + "/" +
                        json.cliente.nombre_cliente + "/" + 
                        json.cliente.email_cliente + "/" +
                        json.cliente.apellidos_cliente + "/" +
                        json.cliente.direccion + "/" +
                        json.token 
                    );
                }
                else{
                    Swal.fire({
                        icon: 'info',
                        title: 'Oops...',
                        text: 'Password doesnt match your account!',
                    });
                }
            })
            .fail(error_ajax);

        }
       
    })
    

    // $("#cerrarsesion").click(function(){
    //     cierra_sesion(); 
    // });
    

});
