//ARRAYS

const numeros = [10,20,30,40,50];
console.table(numeros);

const meses = ['enero','febrero','marzo','abril','mayo'];
console.table(meses);


console.log(numeros[1]);

console.log(numeros.length);

meses.forEach(function(mes){
    console.log(mes);
});


numeros[5] = 60;
console.table(numeros);

numeros.push(69,100);
console.table(numeros);

//INICIO ARREGLO
numeros.unshift(-10,-20,-30);
console.table(numeros);

meses.pop();
console.table(meses);

meses.shift();
console.table(meses);


//ELIMINAR UN DATO EN MEDIO
meses.splice(1,1);
console.table(meses);

const nuevoArreglo = [... meses, 'diciembre'];
console.table(nuevoArreglo);