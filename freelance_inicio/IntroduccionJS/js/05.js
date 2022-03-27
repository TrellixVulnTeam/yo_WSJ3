const producto = {
    nombreProducto : "Monitor",
    precio : 300,
    disponible : true
}


//antiguo

// const precioProducto = producto.precio;
// const nombreProducto = producto.nombreProducto;

// console.log(precioProducto);
// console.log(nombreProducto);

//
//Destructuring
const {precio, nombreProducto} = producto;
console.log(precio);
console.log(nombreProducto);