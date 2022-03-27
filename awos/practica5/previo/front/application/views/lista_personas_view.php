

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Practica 5 CodeIgniter</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?=base_url()?>static/node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>static/node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
<script src="<?=base_url()?>static/node_modules/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>static/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>static/lista.js"></script>
<script src="<?=base_url()?>static/mensajes.js"></script>
<script>
        var appData = {
            "base_url"  : "<?= base_url() ?>",
            "ws_url" : "<?=base_url() ?>../back/"
        };
    </script>
</head>
<body>
    
<div class="container-fluid mt-2 mb-4">
    <h3 class="mb-2">Üben vier </h3> 

    
    <table class="table table-borderd table-hover mt-4"id="tabla-personas">
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
        
            

        </tbody>
    </table>




    <a class="btn btn-success btn-lg mt-3"
       href="<?= base_url() ?>frontend/formulario/alta ">
        <i class="fas fa-user-plus fa-2x"></i>
		Benutzer hinzufügen
    </a>


    <div class="col-md-6 mt-4" id="mensaje">

    </div>

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
	  willst du wirklich <strong id="nombre-persona-borrar"></strong> auslöschen?
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
        