

//obj literal
const producto ={
nombre: "alex",
precio: 500
}


//obj dinamico

function Producto(nombre,precio){
   this.nombre = nombre;
   this.precio = precio;
    
}
Producto.prototype.formatearproducto = function(){
    return `El producto ${this.nombre} tiene un precio de: ${this.precio}`
}

const producto2 = new Producto("Celular", 1000);
console.log(producto2);
console.log(producto2.formatearproducto());

