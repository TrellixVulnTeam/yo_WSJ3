<?php
echo 'Un texto de una línea 
varias líneas
comilla simple \' backslash \\ continuar con mas texto
$variable <br/>';

$name = 'alex';
echo "Mi nombre es $name no concatenacion<br>" ;
echo 'Mi nombre es ' .$name. ' concatenacion';


$courses = [
    'backend' => [
        'PHP',
        'laravel']
    ];
    

class User{
    public $name = 'Tania';
}

$user = new User;

echo "<br><br>$user->name quiere aprender {$courses['backend'][0]}";

//VARIABLE DE VARIABLE
$frutas = 'verdes';
$verdes = 'son manzanas';
echo "<br>$frutas es igual a ${$frutas}";


$frutas = '<strong>Rojas</strong>';
function getFrutas(){
    return 'frutas';
}

echo "<br>{${getFrutas()}} es mi corazon";
    ?>
    
    