function error_formulario( campo, mensaje ) {
	$( "#" + campo ).addClass( "is-invalid" );
	$( "#group-" + campo ).append( '<div class="invalid-feedback">' + mensaje + '</div>' );
	$( "#" + campo ).focus();
}

function error_ajax() {
	alerta( "danger", "Hubo algún problema con el componente AJAX" );
}

function alerta( tipo, mensaje ) {
	switch( tipo ) {
		case "success":
			icono = "fa-check-circle";
			break;
		case "primary":
		case "secondary":
		case "dark":
		case "light":
		case "info":
			icono = "fa-info-circle";
			break;
		case "warning":
			icono = "fa-exclamation-triangle";
			break;
		case "danger":
			icono = "fa-ban";
			break;
	}
	$( "#mensaje" ).append( '<div class="alert alert-' + tipo + ' alert-dismissible fade show" role="alert"><i class="fas fa-2x ' + icono + '"></i>&nbsp;&nbsp;' + mensaje + '.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>' );

	setTimeout( function() {
		$( ".alert" ).fadeOut( "slow" );
	}, 8000 );
}