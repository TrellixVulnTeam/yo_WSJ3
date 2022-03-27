const carrito = [
    {nombre: 'monitor', precio: 500},
    {nombre: 'Television', precio: 700},
    {nombre: 'Tablet', precio: 300},
    {nombre: 'Audifonos', precio: 5100},
    {nombre: 'Teclado', precio: 100},
    {nombre: 'Celular', precio: 120}];
    
    
    //FOR EACH SE USA EN ARREGLOS MOSTRARLOS
    console.log("for each");
    const fe = carrito.forEach(prd =>prd.precio);
    console.log(fe);

   //map  CREAR UN ARREGLO

    const mp = carrito.map(prd => `${prd.precio} - ${prd.precio}`);

    mp.tamano = "";
    mp[1].tamano = "nomas"
    console.log(mp);
    console.log(carrito);


    
    