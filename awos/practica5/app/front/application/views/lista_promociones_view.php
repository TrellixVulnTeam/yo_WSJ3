<!DOCTYPE html>
<html>
<head>
	<title>Practice 5</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?=base_url()?>static/node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>static/node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
  
<script src='<?=base_url()?>static/node_modules/jquery/jquery.min.js'></script>
<script src='<?=base_url()?>static/node_modules/bootstrap/dist/js/bootstrap.min.js'></script>
		<script src="<?= base_url() ?>static/js/lista.js"></script>
		<script src="<?= base_url() ?>static/js/mensajes.js"></script>
		<script >
		var appData = {
			"base_url" : "<?= base_url() ?>",
			"ws_url" : "<?= base_url() ?>../back/"
		};
	</script>
</head>
<body>

<div class="container mt-2 mb-4 col-md-10">
	<h2 class="mb-2">Practice 4 services web oriented</h2>

	<table class="table table-borderd table-hover mt-4" id="tabla-promociones">
		<thead>
			<tr class="bg-secondary text-white text-center">
				<th>Product</th>
				<th>Type</th>
				<th>Price</th>
				<th>Existence</th>
				<th>Validity</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
		
	</table>
<div id="mensaje" class="col-md-6 mt-4">
	</div>

</div>


<!-- Modal Bajas -->
<div class="modal fade" id="modal-bajas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" 
aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete promotion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        Are you sure to delete  <strong id="nomproducto-borrar"></strong>?
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