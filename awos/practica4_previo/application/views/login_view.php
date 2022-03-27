<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Práctica 4 - App Web con CodeIgniter</title>
    <link rel="stylesheet" href="<?=base_url()?>static/node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>static/node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
<script src="<?=base_url()?>static/node_modules/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>static/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>static/login.js"></script>
    <script src="<?= base_url(); ?>static/mensajes.js"></script>
    <script>
        var appData = {
            "base_url" : "<?= base_url(); ?>"
        }
    </script>
</head>
<body>
<div class="container mt-2 mb-4">
    <h3>Üben 4 </h3>

    <div class="row mt-3">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary text-white text-center">
                    <h4>Anmeldung</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url() ?>acceso/inicio/" method="post" id="form-login">
                        <div class="form-group" id="group-correo">
                            <label><strong>Email:</strong></label>
                            <input type="text" class="form-control" name="correo" id="correo">
                        </div>

                        <div class="form-group" id="group-contrasenia">
                            <label><strong>Passwort:</strong></label>
                            <input type="password" class="form-control" name="contrasenia" id="contrasenia">
                        </div>

                        <button type="submit" class="btn btn-success btn-lg mt-3 mb-4">
                            <i class="fas fa-sign-in-alt fa2x"></i>
                            Anmelden
                        </button>
                    </form>
                </div>
                <div class="card-footer bg-info bg-opacity-50 text-center">
                    <a href="#"
                       data-bs-toggle="modal"
                       data-bs-target="#modal-registro">
                        <i class="fas fa-user-plus fa-2x"></i>
                    Neuen Benutzer registrieren
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3"></div>
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
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modal-registro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Neuw Benutzer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= base_url() ?>acceso/registro" method="post" id="form-modal-registro"> 

        <div class="modal-body">
            <div class="form-group" id="group-modal-nombre">
                <label><strong>Name:</strong></label>
                <input type="text" class="form-control" name="modalnombre" id="modal-nombre" />
            </div>

            <div class="form-group" id="group-modal-apellidos">
                <label><strong>Nachnamen:</strong></label>
                <input type="text" class="form-control" name="modalapellidos" id="modal-apellidos" />
            </div>

            <div class="form-group" id="group-modal-correo">
                <label><strong>Email:</strong></label>
                <input type="text" class="form-control" name="modalcorreo" id="modal-correo" />
            </div>

            <div class="form-group" id="group-modal-contrasenia">
                <label><strong>Passwort:</strong></label>
                <input type="password" class="form-control" name="modalcontrasenia" id="modal-contrasenia" />
            </div>

            <div class="form-group" id="group-modal-contrasenia2">
                <label><strong>Passwort (Wieder):</strong></label>
                <input type="password" class="form-control" name="modalcontrasenia2" id="modal-contrasenia2" />
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fas fa-times"></i>
                Abbrechen
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Speichern
            </button>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>