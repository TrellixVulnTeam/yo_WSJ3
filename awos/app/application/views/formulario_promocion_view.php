<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?=base_url()?>static/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>static/node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
	<script src="<?=base_url()?>static/node_modules/jquery/jquery.min.js"></script>
	<script src="<?=base_url()?>static/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>static/formulario.js"></script>
	<script src="<?= base_url() ?>static/mensajes.js"></script>
	<script>
		var appData = {
			base_url    : "<?= base_url() ?>",
		};
	</script>
</head>
<body>

<div class="container">

	<h3>
		<i class="fas fa-hand-holding-usd">s</i>
		Modify data of promotion
	</h3>

	<form action="<?= base_url() ?>promociones/procesar" method="post" id="form-promocion">
		<input type="hidden" name="accion" value="<?= $accion ?>">
		<input type="hidden" name="idpromocion" value="<?= $promocion->idpromocion ?>">

		<div class="row">

			<div class="form-group col col-md-3" id="group-idproducto">
				<label for="idproducto"><strong>Product:</strong></label>
				<select name="idproducto" id="idproducto" class="form-control"</select>
				<input type="hidden" name="idproducto-hidden" id="idproducto-hidden"
				value="<?= $promocion->idproducto ?>">
			</div>

			<div class="form-group col col-md-3" id="group-tipoproducto">
				<label for="tipoproducto"><strong>Type:</strong></label>
				<input type="text" class="form-control" 
					name="tipoproducto" id="tipoproducto"
					disabled>
			</div>

			<div class="form-group col col-md-2" id="group-precio">
				<label for="precio"><strong>Price:</strong></label>
				<input type="number" min=1 class="form-control" name="precio" id="precio"
					value="<?= $promocion->precio ?>">
			</div>

			<div class="form-group col col-md-2" id="group-existencia">
				<label for="existencia"><strong>Existence:</strong></label>
				<input type="number" min="0" class="form-control" name="existencia" id="existencia"
					value="<?= $promocion->existencia ?>">
			</div>

			<div class="col col-md-2 form-check" id="group-vigente">
				<label for="vigente" class="form-check-label"><strong>Valid:</strong></label><br />
				<input type="checkbox" class="form-check-input" name="vigente" 
						id="vigente"<?= $promocion->vigente == 1 ? " checked" : "" ?> >
			</div>

		</div>

		<div class="row mt-3">
			<button type="submit" class="btn btn-success col-md-2">
				<i class="fas fa-save fa-2x"></i>
				Save
			</button>&nbsp;&nbsp;
			<a class="btn btn-secondary col-md-2" href="<?= base_url() ?>">
				<i class="fas fa-ban fa-2x"></i>
				Cancel
			</a>
		</div>

	</form>
	<div id="mensaje" class="mt-3"></div>
</div>

</body>
</html>