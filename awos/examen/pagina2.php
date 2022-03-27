
<?php
 // Esto es pagina2.php
  session_start ();
 // La función strlen () devuelve la longitud de un string
 
  $sesion = strlen ( $_SESSION ["sesion"] );
  echo $sesion;
  session_unset ();
  session_reset();
  $nombre = $_SESSION ["nombre"];
  echo $nombre;

  
 ?>

