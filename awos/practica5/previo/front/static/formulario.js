
var nombre;
var apellido;
var correo;
var expMail = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;



$(document).ready(function () {
    // alert($("#accion").val() == "cambio");
    if($("#accion").val() == "cambio"){
       
        $.ajax({
           
            "url"  : appData.ws_url + "backend/getpersona/",
            "dataType" : "json",
            "type" : "post",
            "data" : {
                "idpersona" : $("#idpersona").val()
            }
        })
        .done(function(json){
            
            if(json.resultado){
                //alert(JSON.stringify(json.persona.idmpio));
                $( "#nombre")       .val(json.persona.nombre);
                $( "#apellidos")     .val(json.persona.apellidos);
                $( "#correo")       .val(json.persona.correo);
                $( "#idpais-hidden").val(json.persona.idpais);
                $( "#idedo-hidden") .val(json.persona.idedo);
                $( "#idmpio-hidden").val(json.persona.idmpio);

    
                carga_paises();

                nombre      = json.persona.nombre;
                apellido    =json.persona.apellidos;
                correo      = json.persona.correo;
            
            }
            else{
                alerta("danger",json.mensaje);
                nombre = "";
                apellidops ="";
                correo ="";
            }

        })
        .fail(error_ajax);
    }
    else{
        carga_paises();
    }


   

    //Evento change del idpais
    $ ("#idpais").change(function () {
        carga_edos( $(this).val() );
        limpia_idmpio();
    });

    //evento change del idedo
    $ ("#idedo").change(function () {
        carga_mpios ( $( "#idpais").val(), $(this).val() );
    });

    // evento click en retableser
    $( "button[type='reset']").click(function(e) {
        e.preventDefault();
        $( "#nombre" ).val(nombre);
        $( "#apellidos" ).val(apellido);
        $( "#correo" ).val(correo);
        $("#idpais").val($("#idpais-hidden").val());
        carga_edos($("#idpais-hidden").val());
        carga_mpios ( $("#idpais-hidden").val(), $("#idedo-hidden").val());
    });

    $( "#form-persona").submit( function(e) {
        e.preventDefault();
        $( ".is-invalid" ).removeClass( "is-invalid" );
        $( ".invalid-feedback" ).remove();
        
        if( $( "#nombre" ).val() == "" ) {
            error_formulario( "nombre", "El nombre es requerido" );
            return false;
        }
        else if( $( "#apellidos" ).val() == "" ) {
            error_formulario( "apellidos", "El apellido es requerido" );
            return false;
        }
        else if( $( "#correo" ).val() == "" ) {
            error_formulario( "correo", "El correo es requerido" );
            return false;
        }
        else if( !expMail.test( $( "#correo" ).val() ) ) {
            error_formulario( "correo", "El formato del correo es erroneo ej(usuario@ejemplo.algo)" );
            return false;
        }
        else if( $( "#idpais" ).val() == 0 ) {
            error_formulario( "idpais", "El pais es requerido" );
            return false;
        }
        else if( $( "#idedo" ).val() == 0 ) {
            error_formulario( "idedo", "El estado es requerido" );
            return false;
        }

        else if( $( "#idmpio" ).val() == 0 && $( "#idpais" ).val() != 3 ) {
            error_formulario( "idmpio", "El municipio es requerido" );
            return false;
        }

        $.ajax({
            "url" : appData.ws_url+"backend/actualizapersona/",
            "dataType" : "json",
            "type" : "post",
            "data" : {
                "accion" : $( "#accion" ).val(),
                "idpersona" : $( "#idpersona" ).val(),
                "nombre": $( "#nombre" ).val(),
                "apellidos"  : $( "#apellidos" ).val(),
                "correo" : $( "#correo" ). val(),
                "contrasenia" : $( "#contrasenia" ).val(),
                "idpais" : $( "#idpais" ).val(),
                "idedo" : $( "#idedo" ). val(),
                "idmpio" : $( "#idmpio" ).val()
                
        

            }
 
        })
        .done(function(json){
            if(json.resultado){
                 $(".form-control, .btn").prop("disabled",true);
                 $( "#btn-cancelar").css("pointer-events", "none");
                 $( "#btn-cancelar").addClass("opacity-50");
                alerta("success",json.mensaje);
                setTimeout(function(){
                    $(location).attr("href", appData.base_url);
                },3000);
            }
            else{
                alerta("danger",json.mensaje);
            }
        })
        .fail(error_ajax)
        return true;
    });

}); //fin del rady


//Funciones Externas (no se ejecuntan al cargar la pagina)





function carga_paises(){
    $.ajax({
        "url": appData.ws_url + "backend/getpaises/",
        "dataType": "json"
    })
        .done(function (obj) {
            if(obj.resultado){
                $("#idpais").html("");
                $("#idpais").append($("<option>", {
                    "text": "-- Seleccione pais --",
                    "value": 0
                }));
    
                $.each(obj.paises, function (i, pais) {
                    $("#idpais").append($("<option>", {
                        "text": pais.nompais,
                        "value": pais.idpais
                    }));
                });
    
                $("#idpais").val($("#idpais-hidden").val() );
                carga_edos( $( "#idpais-hidden" ).val() );
            }
            else{
                alerta("warning", obj.mensaje);
            }
        })

        .fail(error_ajax);
}

function carga_edos (idpais) {
    $.ajax({
        "url"       : appData.ws_url + "backend/getestados",
        "dataType"  : "json",
        "type"      : "post",
        "data"      : {
            "idpais": idpais
        }
    })
    .done( function( obj ) {
        if(obj.resultado){
            $("#idedo").html( "" );
            $("#idedo").append( $("<option>", {
                "text"  : "--Seleccion estado/provincia --",
                "value" : 0
            }));
            
            $.each(obj.estados, function (i, edo) {
                $("#idedo").append($("<option>", {
                    "text"  : edo.nomestado,
                    "value" : edo.idedo
                }));
            });
    
            if ( $("#idpais" ).val() == $ ("#idpais-hidden").val() ){
                $( "#idedo").val( $( "#idedo-hidden").val() );
                carga_mpios(  $("#idpais" ).val(), $("#idedo" ).val() );
            }
        }
        else{
            $("alert").remove();
             if($( "#idpais" ).val() != 0){
                 alerta("warning",obj.mensaje);
         }      }  
    })
    .fail(error_ajax);
}

function carga_mpios( idpais, idedo) {
    $.ajax({
        "url"       : appData.ws_url + "backend/getmpio/",
        "dataType"  : "json",
        "type"      : "post",
        "data"      : {
            "idpais" : idpais,
            "idedo"  : idedo
        }
    })
    .done( function (obj) {
        if(obj.resultado){
        limpia_idmpio();

        $.each( obj.mpios, function(i, mpio) {
            $("#idmpio").append( $("<option>", {
                "text"  : mpio.nommpio,
                "value" : mpio.idmpio
            }));
        });

        if ( $("#idpais" ).val() == $ ("#idpais-hidden").val() &&
            $("#idedo" ).val() == $ ("#idedo-hidden").val() ) {
            $("#idmpio").val( $("#idmpio-hidden").val() );
        }
    }
    else{
       $("alert").remove();
        if($( "#idedo" ).val() != 0){
            alerta("primary",obj.mensaje);
    }      }
    })
    .fail(error_ajax);
}

function limpia_idmpio() {
    $("#idmpio").html("");
        $("#idmpio").append( $("<option>", {
            "text"  : "--Seleccion municipio/condado --",
            "value" : 0
        }));
}
