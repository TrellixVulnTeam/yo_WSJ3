const inputs=document.querySelectorAll(".input"); //Seleccionar las entradas de Texto

function addcl(){ //Añade el foco
    let parent=this.parentNode;
    parent.classList.add("focus");
}

function remcl(){ //Quita el Foco
    let parent=this.parentNode;
    if(this.value==""){
        parent.classList.remove("focus");
    }
}

/* La entrada de texto seleccionada se le asigna o quita el Foco */ 
inputs.forEach(input=>{
    input.addEventListener("focus",addcl);
    input.addEventListener("blur",remcl);
}
);

// Mostrar Password
function show(a) {
    var x=document.getElementById(a);
    var c=x.nextElementSibling

    if (x.getAttribute('type') == "password") {
        c.removeAttribute("class");
        c.setAttribute("class","fas fa-eye fa-fw");
        x.removeAttribute("type");
        x.setAttribute("type","text");
    } 
    else {
        x.removeAttribute("type");
        x.setAttribute('type','password');
        c.removeAttribute("class");
        c.setAttribute("class","fas fa-eye-slash fa-fw");
    }
}

/* JQUERY GENERAL */
$(function(){
    /* Control del formulario de login */
    $('#login-form').submit(function(e){
        e.preventDefault(); //quitar comportamiento por defecto
        

        let url = "bd/enlaces/login_admin.php";
        let postData = {
            name    : $('#name').val(),
            password: $('#pass').val(),
        }

        if(postData.name == ""){
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Debes introducir tu nombre de usuario!',
            });
        }

        else if(postData.password == ""){
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Debes introducir tu contraseña!',
            });
        }

        else{
            $.post(url,postData, function(response){
                $('#login-form').trigger('reset');
                let respuesta = JSON.parse(response);
                let message  = respuesta.message;
                let status   = respuesta.status;
                let rol  = respuesta.ROL;
                if(status == "error"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: message,
                    });
                }
                else{
                    if(status == "correct"){
                        $(location).attr('href','admin.php');
                    }
                    else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Login error...',
                            text: 'Verifique su conexion a internet!',
                        });
                    }
                }
            });
        }
    });
});