
<!DOCTYPE html>
<html lang="en">
<head>
<title>Formulario practica 5</title>
<link rel="stylesheet" href="<?=base_url()?>static/node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>static/node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
  
<script src='<?=base_url()?>static/node_modules/jquery/jquery.min.js'></script>
<script src='<?=base_url()?>static/node_modules/bootstrap/dist/js/bootstrap.min.js'></script>
<script src='<?=base_url()?>static/formulario.js'></script> 
<script src="<?=base_url()?>static/mensajes.js"></script>
<script>
		var appData = {
			"base_url" : "<?= base_url() ?>",
			"ws_url" : "<?=base_url()?>../back/"
		}
	</script>
</head>
<body>

<div class="container mt-2 mb-4">
	<h3>Práctica 5 web services oriented </h3>
	

	<form id="form-persona" method="post">

		<input type="hidden" name="accion" id="accion"value="<?= $accion ?>"/>
		<input type="hidden" name="idpersona" id="idpersona"value="<?= $idpersona?>"/>
	
		
		<div class="row mt-4">    <!-- 12 columnas -->
			
			<div class="form-group col-md-2" id="group-nombre">
				<label><strong>Name:</strong></label>
				<input type="text" class="form-control" name="nombre" id="nombre"/>
			</div>

			<div class="form-group col-md-3" id="group-apellidos">
				<label><strong>Nachname:</strong></label>
				<input type="text" class="form-control" name="apellidos" id="apellidos" />
			</div>

			<div class="form-group col-md-4" id="group-correo">
				<label><strong>Email:</strong></label>
				<input type="text" class="form-control" name="correo" id="correo" />
			</div>

			<div class="form-group col-md-3" id="group-contrasenia">
				<label><strong>Paswort:</strong></label>
				<input type="password" class="form-control" name="contrasenia" id="contrasenia" placeholder="<?= $accion == "cambio" ? "Solo escribir si quieres cambiar" : "" ?>"/>
			</div>
		</div>

		<div class="row mb-5 mt-3">
			<div class="form-group col-md-4" id="group-idpais">
				<label><strong>Land:</strong></label>
				<select class="form-control" name="idpais" id="idpais"></select>
				<input type="hidden" id="idpais-hidden" />
			</div>

			<div class="form-group col-md-4" id="group-idedo">
				<label><strong>Staat/Provinz:</strong></label>
				<select class="form-control" name="idedo" id="idedo"></select>
				<input type="hidden" id="idedo-hidden"  />
			</div>	

			<div class="form-group col-md-4" id="group-idmpio">
				<label><strong>City:</strong></label>
				<select class="form-control" name="idmpio" id="idmpio"></select>
				<input type="hidden" id="idmpio-hidden"  />
			</div>				
		</div>

		<button type="submit" class="btn btn-lg btn-success">
			<i class="fas fa-save"></i>
            Speichern
		</button>
		<button type="reset" class="btn btn-lg btn-secondary" id="btn-restablcer">
			<i class="fas fa-ban"></i>
			Wiederherstellen
		</button>
		<a class="btn btn-lg btn-danger " id='btn-cancelar'
			href="<?= base_url() ?>personas/">
			<i class="fas fa-times"></i>		
			Abbrechen
		</a>

	</form>

	<div id="mensaje" class="mt-4 col-md-6"></div>
	
</div>
</body>
</html>