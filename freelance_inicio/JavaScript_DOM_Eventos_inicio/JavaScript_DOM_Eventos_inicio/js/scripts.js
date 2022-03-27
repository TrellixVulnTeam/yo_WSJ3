const heading = document.querySelector('.header__texto');
heading.textContent = "Nuevo heading"
console.log(heading);

const enlaces = document.querySelectorAll(".navegacion a");
enlaces[0].textContent = "Nuevo enlace"
// enlaces[0].href = "google.com"
enlaces[0].classList.add("nueva-clase");
enlaces[0].classList.remove("navegacion__enlace");



const nuevoEnlace = document.createElement("A");
nuevoEnlace.href = 'nuevo-enlace.html';
nuevoEnlace.textContent = "Un nuevo enlace omg";
nuevoEnlace.classList.add("navegacion__enlace");

const navegacion = document.querySelector(".navegacion");
navegacion.appendChild(nuevoEnlace);
console.log(nuevoEnlace)

console.log(1);
window.addEventListener("load",function(){
    console.log(2);
})



window.onload = function () {
    console.log(2);
}
document.addEventListener("DOMContentLoaded", function(){
    console.log(3);
})
console.log(4);

window.onscroll = function(){
    console.log("scrolling;")
}

// const btnEnviar = document.querySelector(".boton--primario");
// btnEnviar.addEventListener("click", function(e){
//     console.log(e);
//     e.preventDefault();
//     console.log("enviando form...")
// })

const datos = {
    nombre: '',
    email: '',
    mensaje: ''
}
const nombre = document.querySelector('#nombre');
const email = document.querySelector('#email');
const mensaje = document.querySelector('#mensaje');
const formulario = document.querySelector(".formulario");
nombre.addEventListener("input",leetTexto);
email.addEventListener("input",leetTexto);
mensaje.addEventListener("input",leetTexto);



formulario.addEventListener('submit',function(e){
    e.preventDefault();
    
    const {nombre, email, mensaje} = datos;
    if(nombre === '' || email === '' || mensaje === '' ){
        mostrarAlerta("Todos los campos son obligatorios", "error")
        return;
    }
    mostrarAlerta("Mensaje enviado");
    console.log(nombre);
    console.log(email);
    console.log(mensaje);
    
    console.log("enviando formulario...")
})


function mostrarAlerta(mensaje,error =null){
    const alerta = document.createElement("P");
    alerta.textContent = mensaje;
    
    if(error){
        alerta.classList.add("error");
    }
    else{
        alerta.classList.add("correcto");
    }
    formulario.appendChild(alerta)
    
    setTimeout(()=>{
        alerta.remove();
    },5000);
}


function leetTexto(e){
    //console.log("escribiendo: " + e.target.value);
    datos[e.target.id] = e.target.value;
    console.log(datos);
}