
<!DOCTYPE html>
<html>
<head>
	<title>Práctica 6 - Gato</title>
	<meta charset="UTF-8">
  <meta http-equiv="refresh" content="20">
	<meta author="Martin Larios">

	<link rel="stylesheet" href="<?=base_url()?>static/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>static/node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
	
	<script src='<?=base_url()?>static/node_modules/jquery/jquery-3.6.0.min.js'></script>
	<script src='<?=base_url()?>static/node_modules/bootstrap/dist/js/bootstrap.min.js'></script>

	<link rel="stylesheet" href='<?=base_url()?>static/css/styles.css'>

  <script>
    var appData = {
      base_url  : "<?=base_url()?>",
      ws_url    : "<?=base_url()?>../back/",
      correo    : "<?= $this->session->correo?>",
      token     : "<?= $this->session->token?>",
      idjugador : "<?= $this->session->idjugador?>"
    };
  </script>
  <script src="<?= base_url() ?>static/partidas.js"></script>
  <script src="<?= base_url() ?>static/mensajes.js"></script>

</head>
<body>
<div class="container">

<h2>Práctica 6 - GaTO</h2>

<div class="row">
  <div class="col col-md-12">
    Bienvenido <span id="nombre-jugador"><?=$this->session->nombre?></span>
    <a href="<?= base_url() ?>gato/cierrasesion/<?=$this->session->correo?>/<?=$this->session->token?>" class="btn btn-danger"><i
      class="fas fa-sign-out-alt fa-2x"></i>
      Cerrar sesión
    </a>
</div>
</div><BR />

<div class="row">
  <div class="col col-md-6">
    <div class="card">
      <div class="card-header bg-primary text-white">
       Matches available
      </div>
      <div class="card-body">
        <table id="table-partidas" class="table table-hover">
          <thead>
            <tr>
              <Th>Host</Th><Th>acción</Th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="container col col-md-6">
    <button type="button" class="btn btn-success"
      id="btn-crea-partida"><i
      class="fas fa-plus-square fa-2x"></i>
      Create match
    </button>
    <button 
      type="button" 
      class="btn btn-warning text-white" 
      id="btn-scores"
      data-bs-toggle="modal" 
      data-bs-target="#modal-scores"><i
      class="fas fa-award fa-2x p-2"></i>
      Best scores
  </button>
  </div>
</div>
<BR>

<div class="row">
    <div id="mensaje"></div>
</div>

</div>

<!-- The Modal -->
<div class="modal fade" id="modal-scores">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <!-- Modal header -->
      <div class="modal-header">
        <h4 class="modal-title">Mejores scores</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>


      <!-- Modal body -->
      <div class="modal-body">
        <table id="tabla-scores" class="table">
          <thead></thead>
          <tbody></tbody>
        </table>
      </div>

    </div>
  </div>
</div>



<!-- !-- The Modal BORRAR PARTIDA --> -->
<div class="modal fade" id="modal-borrar">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete match</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Are you sure to delete the match <strong id="modal-idpartida"></strong>?
      </div>
      
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-ban"></i>
          Cancel
        </button>
        <button class="btn btn-danger" id="btn-confirmar-borrar" data-bs-dismiss="modal">
        <i class="fas fa-trash"></i>
          Confirm
        </button>
      </div>

    </div>
  </div>
</div>


</body>
</html>