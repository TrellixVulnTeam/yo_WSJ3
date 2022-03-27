//Objects


const nombreProducto = "Monitor"
const precio = 300;
const disponible = true;

const producto = {
     nombreProducto : "Monitor",
     precio : 300,
     disponible : true
}

console.log(producto.precio);
console.log(producto["precio"]); 

//AGREGAR PROPIEDADES
producto.imagen = 'imagen.jpg';

console.log(producto);

//ELIMINAR PROPIEDADES
delete producto.disponible;
console.log(producto);