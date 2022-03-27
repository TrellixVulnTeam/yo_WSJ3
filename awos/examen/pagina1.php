<?php
  // Esto es paginal.php
  session_start();
  $_SESSION ["sesion"] = "mi sesión del examen";
  $_SESSION ["nombre"] = "mi nombre";
  header ( "location:pagina2.php" );
?>