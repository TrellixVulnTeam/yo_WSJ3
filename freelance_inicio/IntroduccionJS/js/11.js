const numero1 = 20;
const numero2 = "20";

console.log(parseInt(numero2));


function sumar(num1 = 0,num2 = 0){ //PARAMETROS
    console.log(num1+num2);
}

sumar(10,10); //ARGUMENTOS
sumar(1);
const sumar2 = function(){
    console.log(3+3);
}

sumar2();

