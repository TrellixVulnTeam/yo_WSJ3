<?php
/*
	Archivo: mensajes_helper.php
	Ubicación: application/helpers
*/

function alerta( $tipo, $mensaje ) {
	switch( $tipo ) {
		case "success":
			$icono = "fa-check-circle";
			break;

		case "primary":
		case "secondary":
		case "light":
		case "dark":
		case "info":
			$icono = "fa-info-circle";
			break;

		case "warning":
			$icono = "fa-exclamation-triangle";
			break;

		case "danger":
			$icono = "fa-ban";
			break;

	}
	echo '<div class="alert alert-'.
			$tipo.
			' alert-dismissible fade show" role="alert">
			<i class="fas fa-2x '.
			$icono.'"></i> '.
			$mensaje.
			'.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
			</button>
			</div>';
}

function mensaje_usuario( $tipo, $mensaje ) {
	$miApp = &get_instance();
	$miApp->session->set_flashdata( "tipo",    $tipo );
	$miApp->session->set_flashdata( "mensaje", $mensaje );
}

?>