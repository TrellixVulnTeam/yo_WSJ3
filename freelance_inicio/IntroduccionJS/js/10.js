


//IIFE FUNCIONES QUE SE MANDAN A LLAMAR ELLAS MISMAS
//PROTEGEN FUNCIONES Y VARIABLES DE OTROS ARCHIVOS
(function(){
    console.log("Esto es una funcion");
})();


sumar();
function sumar(){
    console.log(10+10);
}

sumar2();
const sumar2 = function(){
    console.log(3+3);
}