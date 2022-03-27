<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>

<body>

<?php    
if($personas != null):
    ?>
    
    
    
    
    <table border="1" width="50%" cellpadding="10">
    <thead>
    <tr>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Pais</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ( $personas as $p):
        ?>
        
        <tr>
        <td><?= $p->nompersona ?></td>
        <td><?= $p->correo ?></td>
        <td><?= $p->nompais ?></td>
        </tr>
        
        <?php
    endforeach;
    ?>
    </tbody>
    </table>
    
    
    <?php    
else:
    ?>
  
    <h3>No hay personas registradas</h3>
 
    <?php    
endif;
?>


<a href="<?=base_url()?>">Inicio</a>
</body>

</html>