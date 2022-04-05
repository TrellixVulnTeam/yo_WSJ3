
function iniciarSesion(){
    $('#cerrarmodal').click();
    this.event.preventDefault();
    $('#btn_back').remove();
     document.getElementById("modal_inicio_session_m").style.display = "block";
     document.getElementById("modal_registro_m").style.display = "none";
    $('#loginM').modal({show:true});
    $(".modal-title").html("LOG IN"); 
}


function registrar_usuario(){
    
    this.event.preventDefault();
 
    document.getElementById("modal_inicio_session_m").style.display = "none";
    document.getElementById("modal_registro_m").style.display = "block";
    $(".modal-title").html("REGISTER FORM"); 
    $("#modal_footer_registro_sesion").append(
           ' <button id="btn_back"type="button" class="btn btn-info" onclick="return iniciarSesion()">Go back</button>'
        );
}

$('#loginM').on('hidden.bs.modal', function (e) {
    document.getElementById("modal_registro_m").style.display = "none";
    document.getElementById("modal_inicio_session_m").style.display = "block";
});

