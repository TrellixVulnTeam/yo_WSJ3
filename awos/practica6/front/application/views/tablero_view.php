
<!DOCTYPE html>
<html>
<head>
	<title>Práctica 6 - Gato</title>
	<meta charset="UTF-8">
  <meta http-equiv="refresh" content="10">
	<meta author="alex Santiago">

	<link rel="stylesheet" href='<?=base_url()?>static/node_modules/css/styles.css'>
	<link rel="stylesheet" href="<?=base_url()?>static/node_modules/bootstrap/dist/css/bootstrap.min.css">s
	<link rel="stylesheet" href="<?=base_url()?>static/node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
	
	<script src='<?=base_url()?>static/node_modules/jquery/jquery-3.6.0.min.js'></script>
	<script src='<?=base_url()?>static/node_modules/bootstrap/dist/js/bootstrap.min.js'></script>



	<script src="<?= base_url() ?>static/mensajes.js"></script>


  <script>
	var appData = {
	  base_url  : "<?=base_url()?>",
	  ws_url    : "<?=base_url()?>../back/",
	  correo    : "<?= $this->session->correo?>",
      token     : "<?= $this->session->token?>",
      idjugador : "<?= $this->session->idjugador?>",
	  idpartida : "<?=$idpartida?>",
	  tirando   : 0,
	  status    : 0
	};
  </script>
</head>
<body>

<div class="container-fluid">

<h2>Práctica 6 - GaTO</h2>

<div class="row">
  <div class="col col-md-12">
	Bienvenido <span id="nombre-jugador">alex</span>
	
	<a href="<?=base_url()?>gato/partidas/<?=$this->session->correo?>/<?=$this->session->token?>" class="btn btn-primary"
	  id="btn-regreso-partidas" style="visibility: hidden;"><I
	  class="fas fa-undo fa-2x"></I>
	  Partidas
	</a>
</div>
</div><br />

<div cl	ss="row">
  <div class="col col-md-6">
	<div class="card">
	  <div class="card-header bg-info text-white">
		Mi partida (#<?=$idpartida?>)
	  </div>
	  <div class="card-body">
		<table id="table-partida" class="table table-hover">
		  <thead>
			<tr>
			  <th class="text-center">Turno</th>
			  <th class="text-center">Jugador</th>
			  <th class="text-center">Tirando</th>
			  <th class="text-center">Ganador</th>
			</tr>
		  </thead>
		  <tbody></tbody>
		</table>
	  </div>
	</div>
  </div>

  <div class="col col-md-6">
	<div class="card">
	  <div class="card-header bg-info text-white">
		Mi tablero
	  </div>
	  <div class="card-body">

		<div class="linea-ganadora linea-ganadora-horizontal linea-ganadora-1"></div>
		<div class="linea-ganadora linea-ganadora-horizontal linea-ganadora-2"></div>
		<div class="linea-ganadora linea-ganadora-horizontal linea-ganadora-3"></div>

		<div class="linea-ganadora linea-ganadora-vertical linea-ganadora-4"></div>
		<div class="linea-ganadora linea-ganadora-vertical linea-ganadora-5"></div>
		<div class="linea-ganadora linea-ganadora-vertical linea-ganadora-6"></div>

		<canvas id="linea-7" width="360" height="360" class="linea-ganadora-7"></canvas>
		<canvas id="linea-8" width="360" height="360" class="linea-ganadora-8"></canvas>

		<table id="table-tablero" class="col col-md-12">

		  <tr>
			<td class="casilla borde-abajo borde-derecha" id="td-1"></td>
			<td class="casilla borde-abajo borde-derecha" id="td-2"></td>
			<td class="casilla borde-abajo" id="td-3"></td>
		  </tr>
		  
		  <tr>
			<td class="casilla borde-abajo borde-derecha" id="td-4"></td>
			<td class="casilla borde-abajo borde-derecha" id="td-5"></td>
			<td class="casilla borde-abajo" id="td-6"></td>
		  </tr>

		  <tr>
			<td class="casilla borde-derecha" id="td-7"></td>
			<td class="casilla borde-derecha" id="td-8"></td>
			<td class="casilla casilla" id="td-9"></td>
		  </tr>

		</table>
	  </div>
	</div>
  </div>
</div>
<BR>

<div class="row">
	<div id="mensaje" class="col col-md-6"></div>
</div>

</div>

  <script src="<?=base_url()?>static/tablero.js"></script>

</body>
</html>
