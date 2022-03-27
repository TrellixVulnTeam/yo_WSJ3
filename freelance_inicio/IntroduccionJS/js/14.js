//METODOS DE PROPIEDAD
const reproductor = {
    reproducir : function(id){
        console.log(`Reproduciendo Cancion con id: ${id}`)
    },
    pausar : function(){
        console.log("Pausando...")
    },
    crearPlaylist: function(nombre){
        console.log(`Creando playlist: ${nombre}`)
    }
}

reproductor.reproducir(12);

reproductor.pausar();

reproductor.borrarCancion = function(id){
    console.log(`Eliminando la cancion ${id}`);
}

reproductor.borrarCancion(12);
reproductor.crearPlaylist('The neighbourhood');