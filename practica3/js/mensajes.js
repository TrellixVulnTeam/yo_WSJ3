function error_formulario( campo, mensaje) {
    $( "#" + campo ).addClass( "is-invalid" );
    $( "#group-" + campo ).append( '<div class="invalid-feedback">'+ mensaje +'</div>');
    $( "#" + campo ).focus();
}

function error_ajax() {
    alerta( "danger","ERROR", "with AJAX");
}

function alerta(tipo, aviso, mensaje ) {
    $( "#mensaje" ).append( '<div class="alert alert-' + tipo + ' alert-dismissible fade show" role ="alert"> <strong>¡' + aviso + '! </strong> ' + mensaje + ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

    setTimeout( function(){
        $(".alert").fadeOut("slow");
    }, 5000);
}