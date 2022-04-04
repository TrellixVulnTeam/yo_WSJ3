<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CodeHim">
    <title>Update Quantity Shopping Cart Example</title>

    <!-- Style CSS -->
    <link rel="stylesheet" href="<?=base_url()?>static/css/shopping.css">
	<!-- Demo CSS (No need to include it into your project) -->
	<link rel="stylesheet" href="css/demo.css">
  <script>
var appData = {
            base_url  : "<?=base_url()?>",
            ws_url    : "<?=base_url()?>../back/",
            email_cliente    : "<?= $this->session->email_cliente?>",
            nombre_cliente    : "<?= $this->session->nombre_cliente?>",
            apellidos_cliente    : "<?= $this->session->apellidos_cliente?>",
            token     : "<?= $this->session->token?>",
            idcliente : "<?= $this->session->idcliente?>",
            direccion : "<?=$this->session->direccion?>"
        };
  </script>


  </head>


  <body>
<?php
  if (!empty($_POST["nombre_producto"])) {
    echo "Yes, mail is set";    
} else {  
    echo "No, mail is not set";
}

 echo $dataProducto["nombre_producto"];

echo $dataCliente["idcliente"];

?>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="<?=base_url()?>static/js/shopping.js"></script> 
      
  </body>
</html>