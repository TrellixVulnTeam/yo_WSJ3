<?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$courses = [
    'frontend' => 'js', 
    'framework'=>'laravel', 
    "backend"=> 'php', 
];


foreach ($courses as $key => $course){
    echo "$key: $course <br>";
}

echo "<br><br>";

function upper($course){
    echo strtoupper($course) ."<br>";
}
array_walk($courses, 'upper');





?>