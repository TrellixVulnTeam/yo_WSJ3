const meses = ['enero','febrero','marzo','abril','mayo'];

const carrito = [
    {nombre: 'monitor', precio: 500},
    {nombre: 'Television', precio: 700},
    {nombre: 'Tablet', precio: 300},
    {nombre: 'Audifonos', precio: 5100},
    {nombre: 'Teclado', precio: 100},
    {nombre: 'Celular', precio: 120}];


    meses.forEach(function(mes){
        console.table(mes);
    })

    //SOME PARA ARREGLO DE OBJETOS/
    // let resultado = carrito.some(function(producto){
    //     return producto.nombre === 'Teclado';
    // })

    let resultado = carrito.some(producto =>producto.nombre === 'Teclado' );


    console.log(resultado);

//TOTAL DE UN AREGLO
    resultado = carrito.reduce(function(total, producto){
        return total + producto.precio
    }, 0);
    console.log(resultado);


    console.table(carrito);

    resultado = carrito.filter(checkproduct);

    console.log(resultado);





    function checkproduct(producto){
        return producto.precio == 120 ;
    }
