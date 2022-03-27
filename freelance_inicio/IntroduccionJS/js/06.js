// "use strict"; //Mandar erroes 


const producto = {
    nombreProducto : "Monitor",
    precio : 300,
    disponible : true
}

//NO MODIFICAR ELIMINAR NI AGREGAR
// Object.freeze(producto);

// producto.imagen = 'imagen.jpg';
// console.log(Object.isFrozen(producto))
// console.log(producto);



//SEAL SI PERMITE MODIFICAR PROPIEDADES EXISTENTES
Object.seal(producto);
producto.precio = '100';
console.log(producto);