class Producto{
constructor(nombre, precio){
    this.nombre = nombre;
    this.precio = precio;
}

formatearProducto(){
    return `El producto ${this.nombre} tiene un precio de: ${this.precio}`
}
}


const producto = new Producto("Cel",344);
const producto2 = new Producto("POPO",2);


console.log(producto);
console.log(producto2.formatearProducto());


//inherit 
class Libro extends Producto {
constructor(nombre,precio,isbn){
    super(nombre,precio);
    this.isbn = isbn;
}
formatearProducto(){
    return `El producto ${this.nombre} tiene un precio de: ${this.precio} y su isbn: ${this.isbn}`;
}
}

const libro = new Libro("Js",120,'3434343434');
console.log(libro.formatearProducto() )
