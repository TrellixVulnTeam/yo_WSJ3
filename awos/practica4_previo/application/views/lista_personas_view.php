

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Practica 4 CodeIgniter</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?=base_url()?>static/node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>static/node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
<script src="<?=base_url()?>static/node_modules/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>static/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>static/lista.js"></script>
<script>
        var appData = {
            "base_url"  : "<?= base_url() ?>"
        };
    </script>
</head>
<body>
    
<div class="container-fluid mt-2 mb-4">
    <h3 class="mb-2">Üben vier </h3>

    <div class="d-flex justify-content-between mt-4 mb-4">
		<strong>
            Hallo, <?= $this->session->nomusuario ?>
        </strong>
        <a href="<?= base_url() ?>acceso/cerrar/" >
            <small>
                <i class="fas fa-sign-out-alt fa-2x"></i>
               Abbrechen (<?= $this->session->correo ?>)
            </small>
        </a>
    </div>

<?php
if ( $personas != NULL ) :
?>
    
    <table class="table table-borderd table-hover mt-4">
        <thead>
            <tr class="bg-secondary text-white text-center">
                <th>Name</th>
                <th>Email</th>
                <th>Land</th>
                <th>Staat/Provinz</th>
                <th>City</th>
                <th>Aktionen</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($personas as $p ) :
            ?>
            <tr>
                <td><?= $p->nombre ?> <?= $p->apellidos ?></td>
                <td><?= $p->correo ?></td>
                <td><?= $p->nompais ?></td>
                <td><?= $p->nomestado ?></td>
                <td><?= $p->nommpio ?></td>
                <td class="text-center d-flex justify-content-around">
                    <a class="btn btn-primary" 
                       href="<?= base_url() ?>personas/modificar/<?= $p->idpersona ?>">
                        <i class="fas fa-user-edit"></i>
                    </a>

                    <button class="btn btn-danger btn-borrar" type="button" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modal-bajas"
                            data-idpersona="<?= $p->idpersona ?>"
                            data-nombre-persona="<?= $p->nombre ?> <?= $p->apellidos ?>">
                        <i class="fas fa-user-times"></i>
                    </button>
                </td>
            </tr>
            <?php 
            endforeach;
            ?>

        </tbody>
    </table>
<?php
endif; 
?>

    <div class="col-md-6" id="mensaje">
<?php
    if ( $this->session->flashdata( "mensaje" ) != "" ) {
        alerta( 
            $this->session->flashdata( "tipo" ),
            $this->session->flashdata( "mensaje" )
        );
    }
?>
    </div>

    <a class="btn btn-success btn-lg mt-3"
       href="<?= base_url() ?>personas/insertar ">
        <i class="fas fa-user-plus fa-2x"></i>
		Benutzer hinzufügen
    </a>
</div>

<!-- Modal Bajas -->
<div class="modal fade" id="modal-bajas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Benutzer löschen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  willst du wirklich <strong id="nombre-persona-borrar"></strong>auslöschen?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn-borrar-confirmar">
            <i class="fas fa-trash"></i>
			löschen
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times"></i>
			abbrechen
        </button>
      </div>
    </div>
  </div>
</div>

</body>
</html>