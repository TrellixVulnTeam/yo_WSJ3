<?php
    require_once( "helper.php");
    $mysqli = conectar();

    extract( $_REQUEST );

    session_start();
    if ( !sesion_valida( $c, $s ) ) :
        desconectar();
        header( "location:.?iderror=2" );
    else :
    
    $sql = "select p.idpersona, p.nombre, p.apellidos, p.correo, nompais, nomestado, nommpio
     from personas AS p
     left join paises using (idpais)
     left join estados using (idpais, idedo)
     left join municipios using (idpais, idedo, idmpio)
    order by apellidos, nombre";
    $rs = query ($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Practica 1 - Ajax y seciones</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
    <script src="./node_modules/jquery/jquery.min.js"></script>
   <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/lista.js"></script>
    <script>
        var appData = {
            "c": "<?= $c ?>",
            "s": "<?= $s ?>"
        };
    </script>
</head>

<body>
    <div class="container-fluid mt-2 mb-4">
        <h3 class="mb-2">Practica 1</h3>

        <a href="cerrar.php?c=<?= $c ?>&s=<?= $s ?>">
            <small>
                <i class="fas fa-sign-out-alt fa-2x"></i>
              Close sesion(<?= $_SESSION[ "correo"]?>)
            </small>
        </a>

        <?php
                if ($rs->num_rows > 0) :
                ?>
        <table class="table table-borderd table-hover mt-4">
            <thead>
                <tr class="bg-secondary text-white text-center">
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Estado/provincia</th>
                    <th>Municipio/condado</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    while( $row = $rs->fetch_assoc() ) :
                    extract ( $row); 
                    ?>
                <tr>
                    <td>
                        <?= $nombre ?>
                        <?= $apellidos ?>
                    </td>
                    <td>
                        <?= $correo ?>
                    </td>
                    <td>
                        <?= $nompais ?>
                    </td>
                    <td>
                        <?= $nomestado ?>
                    </td>
                    <td>
                        <?= $nommpio ?>
                    </td>
                    <td class="text-center d-flex justify-content-around">
                        <a class="btn btn-primary" href="formulario.php?accion=cambio&idpersona=<?= $idpersona ?>&c=<?= $c ?>&s=<?= $s ?>">
                            <i class="fas fa-user-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-borrar" type="button"
                        data-bs-toggle="modal" 
                        data-bs-target="#modal-bajas"
                        data-idpersona="<?= $idpersona ?>"
                        data-nombre-persona="<?= "$nombre $apellidos" ?>">
                        <i class="fas fa-user-times"></i>
                        </button>
                    </td>
                </tr>
                <?php
                    endwhile;
                ?>
            </tbody>
        </table>

        <?php
            else :
            ?>

        <div class="alert alert-warning alert-dismissible fade show mt-3 col-md-6" role="alert">
            <strong>Warning!</strong> No hay datos de personas registradas.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
                endif;
                ?>
        <a class="btn btn-success btn-lg mt-2" href="formulario.php?accion=alta&c=<?= $c ?>&s=<?= $s ?>">
            <i class="fas fa-user-plus fa-2x"></i>
       Add user
        </a>
    </div>

    <div class="modal fade" id="modal-bajas" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete user</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure?<strong id="nombre-persona-borrar"></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                id="btn-borrar-confirmar">
            <i class="fas fa-trash"></i>
            Delete
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fas fa-times"></i>
                Cancel
            </button>
            </div>
        </div>
    </div>
    </div>


</body>

</html>
<?php
desconectar();
endif;
?>