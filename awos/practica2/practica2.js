$(document).ready(function(){


 $("#form-cantidad").submit( function (e){
     e.preventDefault();
 if( $("#cantidad").val() <= 0 ){
     alert("a");
 }

 });


})