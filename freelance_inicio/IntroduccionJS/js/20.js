//this

//ARROW FUCNTION HACE REFERENCIA A LA VENTANA GLOBAL
const reservacion = {
    nombre: "Alex",
    apellido: "Santiago ",
    total: 5000,
    pagado: false,
    informacion: function(){
        console.log(`El cliente ${this.nombre} reservo y su cantidad total es de 
        ${this.total}`);
    }
    }


    reservacion.informacion();