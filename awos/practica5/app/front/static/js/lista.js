    $( document ).ready( function() {
        
        $("#tabla-promociones").hide();
        
        setTimeout( function(){
            $( ".alert").fadeOut();
        },8000);
        
        
        /* Consume el servicio web back/end/getpromociones, 
        regresa el objeto SOAP y con el atributro promociones
        rellena la tabla de datos.
        */
        
        
        $.ajax({
            "url"  : appData.ws_url + "backend/getpromociones",
            "dataType" : "json"
            })
        .done( function( json ) {
            //alert( JSON.strinify( json ) );
            if(!json.resultado){
                alerta("warning",json.mensaje);
            }
            else{
                $("#tabla-promociones").show();
                $("#tabla-promociones").find("tbody").html("");
                
                $.each(json.promociones, function( i, p ){
                    $( "#tabla-promociones" ).find("tbody").append(
                        '<tr id="tr-' +
                        p.idpromocion + '"' +
                        ( p.vigente == 1 ? ' class="bg-success bg-opacity-25"' : "" ) + '><td>' +
                        p.nomproducto + '</td><td>' +
                        p.descripcion + '</td><td style="text-align:right;">' +
                        p.precio + '</td><td style="text-align:right;">' +
                        p.existencia + '</td><td class="text-center"><i id=icono-' +
                        p.idpromocion + ' class="fa-2x fas fa-toggle-' +
                        ( p.vigente == 1 ? 'on' : 'off' ) +
                        '" onclick="click_icono( ' +
                        p.idpromocion + ' )" onmouseover="this.style.cursor = \'pointer\';"onmouseout="this.style.cursor = \'default\';"></i></td><td class="d-flex justify-content-between text-center"><button class="btn btn-danger btn-borrar" type="button" data-bs-toggle="modal" data-bs-target="#modal-bajas" onclick="click_btn_borrar( ' + p.idpromocion + ', \'' + p.nomproducto + '\' )"><i class="fas fa-trash-alt"></i></button></td></tr>'
                        );          
                    });  
                    
                    alerta( "primary", json.mensaje );
                }      
            })
            .fail( error_ajax );
            
            
            //Evento click del boton 'Eliminar' de la venta modal
            $( "#btn-borrar-confirmar" ).click( function() {       
                
                var idpromocion = $(this).attr("data-idpromocion");
                $.ajax({
                    "url"  : appData.ws_url + "backend/borrapromocion",
                    "dataType" : "json",
                    "type" : "post",
                    "data" : {
                        "idpromocion" : idpromocion
                    }
                })
                
                .done( function( json ) {
                    $("#tr-" + idpromocion).remove();
                    alerta(
                        json.resultado ? "warning" : "danger",
                        json.mensaje
                        )
                        if($("#tabla-promociones").find("tbody").html() == ""){
                            $("#tabla-promocion").find("thead").hide();
                            alerta("warning","No hay promociones registradas" );
                        }
                        
                    })
                    
                    .fail( error_ajax );
                    
                }); 
                
            });
            
            
            
            
            
            /*
            Evento click de los botones borrar, es necesario porque los b
            botones no existen al momento de cargar la pagina.
            */
            function click_btn_borrar( idpromocion, nomproducto){
                $( "#nomproducto-borrar" ).html(nomproducto);
                $( "#btn-borrar-confirmar" ).attr(
                    "data-idpromocion",
                    idpromocion
                    );      
                }
                
                /*
                Evento click sobre los iconos de toggle-on y toggle-off
                */
                function click_icono( idpromocion ){
                    $.ajax({
                        "url" : appData.ws_url + "backend/cambiavigencia/",
                        "dataType" : "json",
                        "type" : "post",
                        "data" : {
                            "idpromocion" : idpromocion
                        }
                    })
                    .done( function( json ){
                       
                        alerta(
                            json.resultado ? "primary" : "danger",
                            json.mensaje
                            );
                            
                            if( $( "#tr-" + idpromocion ).hasClass( "bg-success" ) ){
                                $( "#tr-" + idpromocion ).removeClass( "bg-success" );
                                $( "#tr-" + idpromocion ).removeClass( "bg-opacity-25" );
                                $( "#icono-" + idpromocion ).removeClass( "fa-toggle-on" );
                                $( "#icono-" + idpromocion ).addClass( "fa-toggle-off" );
                            }
                            else {
                                $( "#tr-" + idpromocion ).addClass( "bg-success" );
                                $( "#tr-" + idpromocion ).addClass( "bg-opacity-25" );
                                $( "#icono-" + idpromocion ).removeClass( "fa-toggle-off" );
                                $( "#icono-" + idpromocion ).addClass( "fa-toggle-on" );
                            }


            

                        })
                        .fail();
                    }