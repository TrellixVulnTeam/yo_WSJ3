<?php
extract( $_REQUEST );
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Practica 1 </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
    
<script src="./node_modules/jquery/jquery.min.js"></script>
   <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="js/login.js" ></script>
        <script src="js/mensajes.js" ></script>
    </head>
    <body>
        <div class="container mt-2 mb-4">
            <h3>Practica 1</h3>

            <div class="row mt-3">
                <div class="col-md-3"></div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-secondary text-white text-center">
                            <h4>practica 1</h4>
                        </div>
                        <div class="card-body">
                            <form action="inicio.php" method="post" id="form-login">
                                <div class="form-group" id="group-correo">
                                    <label><strong>Email:</strong></label>
                                    <input type="text" class="form-control" name="correo" id="correo">
                                </div>

                                <div class="form-group" id="group-contrasenia">
                                    <label><strong>Password: </strong></label>
                                    <input type="password" class="form-control" name="contrasenia" id="contrasenia">
                                </div>

                                <button type="submit" class="btn btn-success btn-lg mt-3 mb-4">
                                    <i class="fas fa-sign-in-alt fa-2x"></i>
                                    Log in
                                </button>
                            </form>

                        </div>
                        <div class="card-footer bg-info bg-opacity-50 text-center">
                            <a href="#" data-bs-toggle="modal"
                            data-bs-target="#modal-registro">
                                <i class="fas fa-user-plus fa-2x"></i>
                                Register new user
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-4">
                <div class="col-md-3"></div>
                <?php
                if (isset ( $iderror ) ) :
                    switch ($iderror) {
                        case 1:
                            $tipo    = "danger";
                            $mensaje = "User or password are incorrect";
                            break;
                        case '2':
                            $tipo    = "danger";
                            $mensaje = "invalid session";
                            break;
                        case '3':
                            $tipo    = "danger";
                            $mensaje = "Already registered";
                            break;
                        case '4':
                            $tipo    = "success";
                            $mensaje = "Succesfull registration";
                            break;
                        default:
                            $mensaje = "Something unknow happened";
                            break;
                    }
                ?>

                <div class="alert alert-<?= $tipo ?> alert-dismissible fade show col-md-6" role="alert">
                    <strong><?= $tipo == "danger" ? "ERROR" : "AVISO" ?>:</strong> <?= $mensaje ?>. 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                endif;
                ?>
            </div>
        </div>

        <div class="modal fade" id="modal-registro" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="registro.php" method="post" id="form-modal-registro" >
                    <div class="modal-body">
                        <div class="form-group" id="group-modal-nombre">
                            <label><strong>Name: </strong></label>
                            <input type="text" class="form-control" name="modalnombre" id="modal-nombre">
                        </div>

                        <div class="form-group" id="group-modal-apellidos">
                            <label><strong>Last name: </strong></label>
                            <input type="text" class="form-control" name="modalapellidos" id="modal-apellidos">
                        </div>

                        <div class="form-group" id="group-modal-correo">
                            <label><strong>Email: </strong></label>
                            <input type="text" class=" form-control" name="modalcorreo" id="modal-correo">
                        </div>

                        <div class="form-group" id="group-modal-contrasenia">
                            <label><strong>Password: </strong></label>
                            <input type="password" class=" form-control" name="modalcontrasenia" id="modal-contrasenia">
                        </div>

                        <div class="form-group" id="group-modal-contrasenia2">
                            <label><strong>Rewrite password: </strong></label>
                            <input type="password" class=" form-control" name="modalcontrasenia2" id="modal-contrasenia2">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save
                        </button>
                    </div>
                </form>

            </div>

        </div>
        </div>
        
    </body>
</html>