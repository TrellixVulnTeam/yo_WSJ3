$( document ).ready( function() {

	setTimeout( function() {
		$( ".alert" ).fadeOut( "slow" );
	}, 8000 );

	// Evento click de botón de borrar de cada registro
	$( ".btn-borrar" ).click( function() {
			
		$( "#modal-borrar-nomproducto" ).html( $( this ).attr( "data-nomproducto" ) );
		$( "#btn-borrar-confirmar" ).attr( 
				"data-idpromocion", 
				$( this ).attr( "data-idpromocion" ) 
		);

	});

	// Evento click del botón 'Eliminar' de la ventana modal
	$( "#btn-borrar-confirmar" ).click( function() {
		
		$( location ).attr( "href",
			appData.base_url +
			"promociones/borrar/" + 
			$( this ).attr( "data-idpromocion" ) 
		);

	});


}); 