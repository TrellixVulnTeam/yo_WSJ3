$(document).ready(function(){

    $.ajax({
        "url" : appData.ws_url + "partidas/getdatospartida/",
        "dataType" : "json",
        "type" : "post",
        "data" : {
            "idpartida" : appData.idpartida,
            "correo" : appData.correo,
            "token" : appData.token
        }
    })
    .done(function(json){

        if(json.resultado){
            alert(JSON.stringify(json));

            if(json.partida.status == 3){
                $( "#btn-regreso-partidas" ).css( "visibility", "visible" );
            }


            $("#table-partida" ).find( "tbody" ).html("");
            
            $.each( json.jugadores, function( i, j ) {
             
                $( "#table-partida" ).find( "tbody" ).append(
                    '<tr>' +
                    '<td class="text-center">' + j.turno + '</td>' +
                    '<td class="text-center">' + j.nombre + '</td>' +
                    '<td class="text-center">' + 
                    (j.tirando == 1) ?
                    '<div class="fas fa-spinner-grow text-success"</div>' : '') +
                     '</td>'+
                    '<td class="text-center">' +
                     (j.ganador) +
                    '</td>' +
                    '</tr>'
                );
            });
            alerta("primary", json.mensaje);
        
        }
        else{
            alerta("warning",json.mensaje)
            if(!json.tokenvalido){
                cierra_sesion();
            }
        }
    }}
    .fail(error_ajax);


});