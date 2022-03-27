
<!DOCTYPE html>
<HTML>
<head>
	<TITLE>Práctica 6 - Gato</TITLE>
	<meta charset="UTF-8">
	<meta author="Martin Larios">


		<link rel="stylesheet" href="<?=base_url()?>static/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>static/node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
	
	<script src='<?=base_url()?>static/node_modules/jquery/jquery-3.6.0.min.js'></script>
	<script src='<?=base_url()?>static/node_modules/bootstrap/dist/js/bootstrap.min.js'></script>

	 <LINK rel="stylesheet" href='<?=base_url()?>static/css/styles.css'> 

	<script>
		var appData = {
			base_url : "<?=base_url()?>",
			ws_url   : "<?=base_url()?>../back/"
		}
	</script>
	<script src="<?= base_url()?>static/registro.js"></script>
	<script src="<?= base_url()?>static/mensajes.js"></script>
 </script>
</head>
<body>
<div class="container">

	<H2 class="ml-3">Práctica 6 - GATO</H2>

	<div class="form-group col col-md-8" id="group-correo">
		<label><strong>Email:</strong></label>
		<input type="text" class="form-control" id="correo" />
	</div>
	<button type="button" class="btn btn-success ml-3" id="btn-entrar"><I 
		class="fas fa-sign-in-alt fa-2x"></I> Entrar
	</button>

	<br /><br />

	<button type="button" class="btn btn-secondary ml-3" id="btn-registrar"
		data-bs-toggle="modal" data-bs-target="#modal-registro"><I 
		class="fas fa-address-card fa-2x"></I> Register
	</button>


<!-- The Modal -->
<div class="modal fade" id="modal-registro">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<!-- Modal header -->
			<div class="modal-header">
				<H4 class="modal-title">Insert data</H4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<form method="post"id="form-registro">
			<!-- Modal body -->
			<div class="modal-body">
				
				<div class="form-group" id="group-modal-nombre">
					<label><strong>Name:</strong></label>
					<input type="text" class="form-control" id="modal-nombre">
				</div>
				<div class="form-group" id="group-modal-correo">
					<label><strong>Email:</strong></label>
					<input type="text" class="form-control" id="modal-correo">
				</div>
				<div class="form-group" id="group-modal-telefono">
					<label><strong>Phone:</strong></label>
					<input type="text" class="form-control" id="modal-telefono">
				</div>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-bs-dismiss="modal"><I class="fas fa-times"></I> Cancel</button>
				<button type="submit" class="btn btn-danger"  id="btn-guardar"><I class="fas fa-check"></I> Save</button>
			</div>
			</form>-
		</div>
	</div>
</div>

<div id="mensaje" class="ml-1 mt-3 col col-md-6">
	<?php
	
	if($this->session->flashdata("tipo") != NULL &&
	$this->session->flashdata("mensaje")  != NULL):
		alerta(
			$this->session->flashdata("tipo"),
			$this->session->flashdata("mensaje")
		);
	endif;


	
	?>
</div>

</div>

</body>
	</html>