// $(document).ready(function(){
// alert("df");

// $("#modal-sesion").click(function(e){
//     alert("hola");
//     iniciarSesion(e);    
// })

// })



var elementoEnCarrito = document.getElementById("cantidad-cart");
// var id_usuario = document.getElementById("iduser").value;
var dataItems = [];
var selectSucursal       = document.querySelector('.select_sucursal');
var id_sucursal = 1;
create_event_sucursal();


var hasBeenClicked = false; 
function changeContent(link,data = "NULL"){
      return new Promise(resolve => {
        $.post(link, data, function(htmlexterno){
            if(hasBeenClicked == false){ 
                hasBeenClicked = true;
                resolve($("#portfolio").html(htmlexterno));
            }
        });
        hasBeenClicked = false;
  });
}

function create_event_sucursal(){
    selectSucursal.addEventListener('change',(event)=>{
        id_sucursal = event.target.value;
        let a = ($( "#sucursales option:selected" ).text().trim()).split(":")[1].trim();
        document.getElementById("titulo_productos").innerHTML = "PRODUCTOS " + a.toString();
        cambiarContenido(id_sucursal);
        
    });
}
async function cambiarContenido(id_suc){
    await changeContent("vistas/inventario_sucursal.php",{id_sucursal:id_suc,id_cliente:id_usuario});     
    creardataItems();
}
//sucursales
var objeto = new Map();
creardataItems();

function creardataItems(){
    objeto.clear();
    let x = document.querySelectorAll(".cantidades_stock");
    for(var i= 0; i < x.length; i++) {
        let value = (x[i].textContent.split(" "))[0];
        let idvalue = x[i].id;
        objeto.set(idvalue, value);
    }
}

async function agregarCarrito(id){
    this.event.preventDefault();
    iduser = document.getElementById("iduser").value;
    if(iduser == 0){
        iniciarSesion();
    }
    else{
        //obtener lo que hay en el carrito 
        let a = (document.getElementById(id).textContent.trim().split(" ")[0]).trim();
        let valor = objeto.get(id.toString());
        let newvalue = valor - 1;
        let div = "div" + id.toString();
        let text = "text" + id.toString();
        let button = "button" + id.toString();
        if((newvalue >= 0 ) && (newvalue <= 5)){
            objeto.set(id, newvalue);
            let value_car = elementoEnCarrito.textContent = (parseInt(elementoEnCarrito.textContent.trim(),10) + 1).toString();
            document.getElementById(id).textContent = newvalue.toString();
            document.getElementById(div).classList.remove("producto_existencia");
            document.getElementById(div).classList.add("producto_por_agotar");
            await carrito_de_usuario(id);
            if(newvalue == 0){
                agregarCarrito(id);
            }
        }
        else if(newvalue > 5 ){
            objeto.set(id, newvalue);
            let value_car = elementoEnCarrito.textContent = (parseInt(elementoEnCarrito.textContent.trim(),10) + 1).toString();
            document.getElementById(id).textContent = newvalue.toString();
            await carrito_de_usuario(id);
            
        }
        else{
            objeto.set(id, 0);
            document.getElementById(id).textContent = '0';
            document.getElementById(text).textContent = 'Stock Agotado';
            document.getElementById(button).style.display = "none";
            //document.getElementById(button).disabled = true;
            document.getElementById(div).classList.remove("producto_por_agotar");
            document.getElementById(div).classList.remove("producto_existencia");
            document.getElementById(div).classList.add("producto_agotado");
            // Poner en color rojo
        }
    }
    
}

function carrito_de_usuario(id_producto){
    let url = "bd/enlaces/agregar_al_carrito.php";
    let postData = {
        id_usuario : id_usuario,
        id_producto : id_producto,
        id_sucursal: id_sucursal
    }
    return new Promise(resolve => {
        $.post(url,postData,function(response){
            resolve(response);
        });
    });
}

function iniciarSesion(){
    this.event.preventDefault();
    $('#loginM').modal({show:true});
}

// async function cerrarSesion(){
//     this.event.preventDefault();
//     let url = 'bd/enlaces/cerrar_sesion_cliente.php';
//     let postData = {
//         id_usuario:id_usuario
//     };
//     $.post(url,postData, function(response){
//         datos = JSON.parse(response);
//         let status        = datos.status;
//         let message       = datos.message;
        
//         if(status == "error"){
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Oops...',
//                 text: message,
//             }).then(() => {
//                 $(location).attr('href','index.php');
//             });
//         }
//         else{
//             Swal.fire(
//                 'Correct!',
//                 message,
//                 'success'
//             ).then(() => {
//                 $(location).attr('href','index.php');
//             });
//         }
//     });
    
    
// }

function carrito_de_compras(){
    this.event.preventDefault();
    let url = "vistas/modal/carrito_de_compras.php?id_usuario="+ id_usuario;
    $('.modalCarritoUser').load(url,function(){
        $('#carritoM').modal({show:true}); 
    });
}

function show(a){
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


async function borrar_articulo(idarticulo,cantidad){
    await carrito_de_usuario_borrar_articulo(idarticulo);
    $('.modalCarritoUser').empty();
    let value_car = elementoEnCarrito.textContent = (parseInt(elementoEnCarrito.textContent.trim(),10) - cantidad).toString();
    carrito_de_compras();
}

function carrito_de_usuario_borrar_articulo(id_producto){
    let url = "bd/enlaces/eliminar_al_carrito.php";
    let postData = {
        id_usuario : id_usuario,
        id_producto : id_producto,
    }
    return new Promise(resolve => {
        $.post(url,postData,function(response){
            resolve(response);
        });
    });
}

$('#carritoM').on('hidden.bs.modal', function (e) {
    let a = ($( "#sucursales option:selected" ).text().trim()).split(":")[1].trim();
    document.getElementById("titulo_productos").innerHTML = "PRODUCTOS " + a.toString();
    cambiarContenido(id_sucursal);
    //$(location).attr('href','index.php');
});

function registrar_usuario(){
    this.event.preventDefault();
    document.getElementById("modal_inicio_session_m").style.display = "none";
    document.getElementById("modal_registro_m").style.display = "block";
}

$('#loginM').on('hidden.bs.modal', function (e) {
    document.getElementById("modal_registro_m").style.display = "none";
    document.getElementById("modal_inicio_session_m").style.display = "block";
});

function validarEmail(email){
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// async function registrarUsuarioNuevo(){
//     alert("sdrf");
//     //validad los campos 
//     let nombre_usuario = document.getElementById("Nombreuser").value.trim();
//     let apellidos_usuario = document.getElementById("ApellidoUser").value.trim();
//     let telefono_usuario  = document.getElementById("NumeroUser").value.trim();
//     let email_usuario  = document.getElementById("emailUser").value.trim();
//     let pass_usuario = document.getElementById("passworduser").value.trim();
//     let ciudad = document.getElementById("ciudadUser").value.trim();

//     let errores = 0;

//     if(nombre_usuario.length <= 5){
//         document.getElementById("divNombreuser").classList.remove("success-input");
//         document.getElementById("divNombreuser").classList.add("error-input");
//         errores++;
//     }
//     else{
//         document.getElementById("divNombreuser").classList.add("success-input");
//         document.getElementById("divNombreuser").classList.remove("error-input");
//     }

//     if(apellidos_usuario.length <= 5){
//         document.getElementById("divNombreuser").classList.remove("success-input");
//         document.getElementById("divNombreuser").classList.add("error-input");
//         errores++;
//     }
//     else{
//         document.getElementById("divNombreuser").classList.add("success-input");
//         document.getElementById("divNombreuser").classList.remove("error-input");
//     }
//     if(telefono_usuario.length <= 6){
//         document.getElementById("divNumeroUser").classList.remove("success-input");
//         document.getElementById("divNumeroUser").classList.add("error-input");
//         errores++;
//     }
//     else{
//         document.getElementById("divNumeroUser").classList.add("success-input");
//         document.getElementById("divNumeroUser").classList.remove("error-input");
//     }

//     if(email_usuario.length == 0){
//         document.getElementById("divemailUser").classList.remove("success-input");
//         document.getElementById("divemailUser").classList.add("error-input");
//         errores++;
//     }
//     else{
//         a = validarEmail(email_usuario);
//         if(a == false){
//             document.getElementById("divemailUser").classList.remove("success-input");
//             document.getElementById("divemailUser").classList.add("error-input");
//             errores++;
//         }
//         else{
//             document.getElementById("divemailUser").classList.add("success-input");
//             document.getElementById("divemailUser").classList.remove("error-input");
//         }
//     }

//     if(pass_usuario.length <= 6){
//         document.getElementById("divpasswordUser").classList.remove("success-input");
//         document.getElementById("divpasswordUser").classList.add("error-input");
//         errores++;
//     }
//     else{
//         document.getElementById("divpasswordUser").classList.add("success-input");
//         document.getElementById("divpasswordUser").classList.remove("error-input");
//     }

//     if(ciudad.length <= 3){
//         document.getElementById("divciudadUser").classList.remove("success-input");
//         document.getElementById("divciudadUser").classList.add("error-input");
//         errores++;
//     }
//     else{
//         document.getElementById("divciudadUser").classList.add("success-input");
//         document.getElementById("divciudadUser").classList.remove("error-input");
//     }

//     if(direccion_user.length <= 6){
//         document.getElementById("divdireccionUser").classList.remove("success-input");
//         document.getElementById("divdireccionUser").classList.add("error-input");
//         errores++;
//     }
//     else{
//         document.getElementById("divdireccionUser").classList.add("success-input");
//         document.getElementById("divdireccionUser").classList.remove("error-input");
//     }
//     if(exterior_usuario.length == 0){
//         document.getElementById("divnumExterior").classList.remove("success-input");
//         document.getElementById("divnumExterior").classList.add("error-input");
//         errores++;
//     }
//     else{
//         document.getElementById("divnumExterior").classList.add("success-input");
//         document.getElementById("divnumExterior").classList.remove("error-input");
//     }
  

//     if(errores == 0){
//         var formData = new FormData();
//         formData.append('nombre',nombre_usuario.trim());
//         formData.append('telefono',apellidos_usuario.trim());
//         formData.append('email',telefono_usuario.trim());
//         formData.append('password',email_usuario.trim());
//         formData.append('ciudad',pass_usuario.trim());
//         formData.append('direccion',ciudad.trim());



//         // return false;
//     }
// }