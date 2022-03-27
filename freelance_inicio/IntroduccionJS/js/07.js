const producto = {
    nombreProducto : "Monitor",
    precio : 300,
    disponible : true
}


const medidas = {
    peso: '1kg',
    mediad: '1m'
}

const unionObjetos = {...producto, ...medidas};
console.log(unionObjetos);