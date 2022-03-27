const boton = document.querySelector('#boton');

boton.addEventListener("click", () => {
    Notification.requestPermission()
    .then(resultado => console.log("El resultado es:" +resultado))
    .catch()
});

if(Notification.permission == 'granted'){
    new Notification('Esta es una notificacion',{
        icon: '../../basichtmlcss/images/plasma.png',
        body: "Hola soy guapo"
    })
}