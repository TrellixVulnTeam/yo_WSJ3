<?php

$data = 'Estudio PHP';
echo $data[0];

$post = "<br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus expedita beatae ab aliquam dicta, nisi amet inventore sunt nostrum repellat consequuntur quisquam? Error cupiditate temporibus optio omnis quidem illo laborum! ";
$extract = substr( $post, 0, 20); 

echo "$extract... (see more) <br> <br>";

$data = 'javascript, php, laravel';
$tags = explode(', ', $data);
echo "<pre>";
echo "Informacion :${var_dump($tags)}";
echo "</pre>ola";

$courses = ['js', 'php', 'laravel', 'nodejs'];
$Stringealo = implode(',',$courses);
echo "<pre> $Stringealo <br>";
echo implode('-s-',$courses);

$course = "     P H P         ";
$course = trim($course);   //ltrim rtrim
echo "<br><br> MUUUCHO $course";

?>