$(document).ready(function(){
	
	carga_partidas();
	
	$( "#btn-scores").click(function(){
	
		$.ajax({
			"url" : appData.ws_url  + "jugadores/getscores/",
			"dataType" : "json",
			"type" : "post",
			"data" : {
				"correo" : appData.correo,
				"token" : appData.token
			}
		})
		.done(function(json){
			if(json.resultado){
				$("#tabla-scores").find("thead").html("");
				$("#tabla-scores").find("tbody").html("");
				
				$("#tabla-scores").find("thead").html('<tr class="bg-secondary text-center text-white"><th>Player</th><th>Won matches</th></tr>');
				$.each(json.scores, function(i, j){
					$("#tabla-scores").find("tbody").append(
						'<tr>' + 
						'<td>' + j.nombre + '</td>' +
						'<td style="text-align:center"' + j.score + '</td>' +
						'</tr>'
						)
					})
				}
				else{
					alerta("warning",json.mensaje);
					if(!json.tokenvalido){
						cierra_sesion();
					}
				}
			})
			.fail(error_ajax)
		});
		
	
		$("#btn-confirmar-borrar").click(function(){
			$.ajax({
				"url" : appData.ws_url + "partidas/borrapartida/",
				"dataType" : "json",
				"type" : "post",
				"data" : {
					"idpartida" : $("#modal-idpartida").html(),
					"correo" : appData.correo,
					"token" : appData.token
				}
			}
			)
			.done(function(json){
				if(json.resultado){
					$("#tr-" + $("#modal-idpartida").html()).remove()
					alerta("success",json.mensaje);
				}
				else{
					alerta("danger", json.mensaje);
					if(!json.tokenvalido){
						cierra_sesion();
					}
				}
			})
			.fail(error_ajax)
		});
		
		//EVENTO CLICK DE BOTON CREAR PARTIDAS	
		
		$("#btn-crea-partida").click(function(){
			$.ajax({
				"url" : appData.ws_url + "partidas/creapartida/",
				"dataType" : "json",
				"type" : "post",
				"data" : {
					"idjugador" : appData.idjugador,
					"correo" : appData.correo,
					"token" : appData.token
				}
			})
			.done(function(json){
				if(json.resultado){
					carga_partidas();
					alerta("success",json.mensaje);	
				}
				else{
					alerta("danger", json.mensaje);
					if(!json.tokenvalido){
						cierra_sesion();
					}
				}
			})
			.fail(error_ajax)
		});
	}); //FIN DE DOCUMENT ****************************************
	
	function carga_partidas(){
		$.ajax({
			"url" : appData.ws_url + "partidas/getpartidas/",   
			"dataType" : "json",
			"type" : "post",
			"data" : {
				"correo" : appData.correo,
				"token" : appData.token
			}
		})
		.done(function(json){
			if(json.resultado){
				/*ESTA ES LA LINEA QUE LE COMENTO*/
				//$( "#table-partidas" ).find( "tbody" ).htm1("");
				
				alerta("dark",json.mensaje);
				$.each(json.partidas,function(i, p){
					$("#table-partidas").find("tbody").append(
						'<tr id="tr-'+
						p.idpartida +
						'"><td>Match '+
						p.idpartida+
						'(<strong>'+
						p.nombre+
						'</strong>)'+
						'</td><td>'+
						
						( p.idjugador == appData.idjugador ?
							'<a href="'+
							appData.base_url + 'gato/tablero/'+
							p.idpartida + '/' +
							appData.correo+ '/'+
							appData.token+
							'"class="btn btn-outline-primary"><i class="fas fa-play"></i>Play</a>&nbsp;<button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-borrar" onclick="click_borrar('+
							p.idpartida + 
							')"><i class="fas fa-trash"></i>Delete</button>' :
							
							'<button class="btn btn-outline-secondary" onclick="click_unirte('+
							p.idpartida + ',' +
							appData.idjugador
							+')"><i class="fas fa-hand-point-up"></i>Join</button>') + 
							'</td></tr>'
							);
						});
					}
					else{
						alerta("warning",json.mensaje);
						if(!json.tokenvalido){
							cierra_sesion();
						}
					}
				})
				.fail(error_ajax);
				
			}
			
			
			
			
			
			
			
			
			
			
			
			
			function click_borrar(idpartida){
				$("#modal-idpartida").html(idpartida);
			}
			
			
			
			function click_unirte(idpartida,idjugador){
				$.ajax({
					"url" : appData.ws_url + "partidas/unepartida/",
					"dataType" : "json",
					"type" : "post",
					"data" : {
						"idpartida" : idpartida,
						"idjugador" : idjugador,
						"correo" : appData.correo,
						"token" : appData.token
					}
				})
				.done(function(json){
					if(json.resultado){
						$(location).attr("href",
						appData.base_url + "gato/tablero/" + 
						idpartida + '/' +
						appData.correo +'/'+
						appData.token
						)
						alerta("success",json.mensaje);
					}
					else{
						alerta("danger", json.mensaje);
						if(!json.tokenvalido){
							cierra_sesion();
						}
					}
				})
				.fail(error_ajax)
			}