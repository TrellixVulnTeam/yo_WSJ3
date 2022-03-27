
$( document ).ready( function() {
    
    $("#tabla-personas").hide();
    
    setTimeout( function(){
        $( ".alert").fadeOut();
    },8000);
    
    
    //Consumir servicio web de back/backend/get/personas
    
    
    $.ajax({
        "url"  : appData.ws_url + "backend/getpersonas",
        "dataType" : "json"
    })
    .done( function( json ) {
        
        if(!json.resultado){
            alerta("warning",json.mensaje);
        }
        else{
            $("#tabla-personas").show();
            $("#tabla-personas").find("tbody").html("");
            
            $.each(json.personas, function(i,p){
                $("#tabla-personas").find("tbody").append(
                    '<tr id="tr-'+p.idpersona+'"><td>'
                    +p.nombre+
                    ' '+p.apellidos+
                    '</td><td>'
                    +p.correo+
                    '</td><td>'
                    +p.nompais+
                    '</td><td>'
                    +p.nomestado+
                    '</td><td>'
                    +(p.nommpio== null ? "" : p.nommpio)+
                    '</td><td class="text-center d-flex justify-content-around"><a class="btn btn-primary" href="'
                    +appData.base_url + 'frontend/formulario/cambio/' +
                    p.idpersona + '"><i class="fas fa-user-edit"></i></a><button class="btn btn-danger btn-borrar" type="button" data-bs-toggle="modal"data-bs-target="#modal-bajas" onclick="click_btn_borrar(' +
                    p.idpersona + ', \'' +
                    p. nombre + ' '+ p. apellidos +
                    '\' )"><i class="fas fa-user-times"></i></button></td></tr>'
                    );          
                });   
            }      
        })
        .fail( error_ajax );
        
        
        //Evento click del boton 'Eliminar' de la venta modal
        $( "#btn-borrar-confirmar" ).click( function() {       
            
            var idpersona = $(this).attr("data-idpersona");
            $.ajax({
                "url"  : appData.ws_url + "backend/deletepersona",
                "dataType" : "json",
                "type" : "post",
                "data" : {
                    "idpersona" : idpersona
                }
            })
            .done( function( json ) {
                $("#tr-" + idpersona).remove();
                alerta(
                    json.resultado ? "info" : "danger",
                    json.mensaje
                )
                if($("#tabla-personas").find("tbody").html() == ""){
                    $("#tabla-personas").find("thead").hide();
                    alerta("warning","No registered users");
                }
                })
                .fail( error_ajax );
    }); 
});
    function click_btn_borrar( idpersona, nompersona){
        $( "#nombre-persona-borrar" ).html(nompersona);
        $( "#btn-borrar-confirmar" ).attr(
            "data-idpersona",idpersona);
            
        } 