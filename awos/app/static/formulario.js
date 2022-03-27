$( document ).ready( function() {

	$.ajax({
		"url"      : appData.base_url + "catalogos/productos/",
		"dataType" : "json"
	})
	.done( function( obj ) {
		if ( obj.resultado ) {
			$( "#idproducto" ).html( "" );
			$( "#idproducto" ).append( $( "<option>", {
				"text"  : "-- Select product --",
				"value" : 0
			}));

			$.each( obj.productos, function( i, producto ) {
				$( "#idproducto" ).append( $( "<option>", {
					"text"  : producto.nomproducto,
					"value" : producto.idproducto
				}));
			});
			

			if ( $( "#idproducto-hidden" ).val() != 0 ) {
				$( "#idproducto" ).val( $( "#idproducto-hidden" ).val() );

				$.ajax({
					"url"      : appData.base_url + "catalogos/producto/",
					"dataType" : "json",
					"type"     : "post",
					"data"     : {
						"idproducto" : $( "#idproducto-hidden" ).val()
					}	
				})
				.done( function( producto ) {
					cambia_tipo_producto( producto.idtp );
				})
				.fail( error_ajax );
			}

		}
		else {
			alerta( "warning", obj.mensaje );
		}
	})
	.fail( error_ajax );

	// Evento change del  SELECT idproducto
	$( "#idproducto" ).change( function() {
		$.ajax({
			"url"      : appData.base_url + "catalogos/producto/",
			"dataType" : "json",
			"type"     : "post",
			"data"     : {
				"idproducto" : $( this ).val()
			}	
		})
		.done( function( producto ) {
			cambia_tipo_producto( producto.idtp );
		})
		.fail( error_ajax );
	});

	// Evento submit del FORM para validar formulario
	$( "#form-promocion" ).submit( function () {

		if( $( "#idproducto" ).val() == 0 ) {
			error_formulario ("idproducto", "You must chose a product" )
			return false;
		}

		return true;

	});

});


function cambia_tipo_producto( idtp ) {
	$.ajax({
		"url"      : appData.base_url + "catalogos/tipoproducto/",
		"dataType" : "json",
		"type"     : "post",
		"data"     : {
			"idtp" : idtp
		}
	})
	.done( function( obj ) {
		if ( obj.resultado ) {
			$( "#tipoproducto" ).val( obj.descripcion );
		}	
		else {
			alerta( "warning", obj.mensaje );
		}
	})
	.fail( error_ajax );
}

