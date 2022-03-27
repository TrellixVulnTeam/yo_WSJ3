<!DOCTYPE html>
<html>
<head>
	<title>Practica 4 </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?=base_url()?>static/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>static/node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
	<script src="<?=base_url()?>static/node_modules/jquery/jquery.min.js"></script>
	<script src="<?=base_url()?>static/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>static/lista.js"></script>
	<script >
		var appData = {
			"base_url" : "<?= base_url() ?>"
		};
	</script>
</head>
<body>

<div class="container">
	<h2>Promotions list</h2>
<?php
if ( $promociones != NULL ) :
?>


	<table class="table table-hover">

		<thead class="bg-secondary text-white">
			<tr>
				<td>Product</td>
				<td>Type</td>
				<td>Price</td>
				<td>Existence</td>
				<td>Actions</td>
			</tr>
		</thead>

		<tbody>
<?php
foreach ( $promociones as $promocion ) :
?>


				<tr <?= $promocion->vigente ==1 ? ' class="bg-success bg-opacity-25"' : "" ?> >
				<td><?= $promocion->nomproducto ?></td>
				<td><?= $promocion->descripcion ?></td>
				<td><?= $promocion->precio ?></td>
				<td><?= $promocion->existencia ?></td>
				<td>
					<a href="<?= base_url() ?>promociones/modificar/<?= $promocion->idpromocion ?>"
						class="btn btn-primary">
						<i class="fas fa-edit"></i>
					</a>
					&nbsp;
					<button type="button" class="btn btn-danger btn-borrar"
						data-bs-toggle="modal" data-bs-target="#modal-borrar"
						data-idpromocion="<?= $promocion->idpromocion ?>"
						data-nomproducto="<?= $promocion->nomproducto ?>">
						<i class="fas fa-trash"></i>
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


	<a href="<?= base_url() ?>promociones/insertar" class="btn btn-success">
		<i class="fas fa-plus"></i>
	Add promotion
	</a>
	<!-- agregar el js de mensajes -->
	<?php
	if ( $this->session->flashdata( "mensaje" ) ) {
		alerta(
			$this->session->flashdata( "tipo" ),
			$this->session->flashdata( "mensaje" )	
		);
	}
	?>
<!--
	<div class="row mt-3" id="mensaje">
		<div class="ml-3 alert alert-info alert-dismissible fade show" role="alert">
		  <strong>¡AVISO!</strong> 3 promociones recuperadas.
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		  </button>
		</div>
-->
	</div>
</div>


<!-- Modal Borrar -->
<div class="modal fade" id="modal-borrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Delete promotion</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
		</button>
	  </div>
	  <div class="modal-body">
		Delete <strong id="modal-borrar-nomproducto"></strong>?
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
			<i class="fas fa-times"></i>
			Cancel
		</button>
		<button type="button" class="btn btn-danger" id="btn-borrar-confirmar">
			<i class="fas fa-check"></i>
			Confirm
		</button>
	  </div>
	</div>
  </div>
</div>
 
</body>
</html>