<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Alex Santiago" />
    <title>Calisthenix</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- CSS -->
    <link href="<?= base_url() ?>static/css/styles.css" rel="stylesheet" />
    <link href="<?= base_url() ?>static/css/select.css" rel="stylesheet" />
    <link href="<?= base_url() ?>static/css/alert.css" rel="stylesheet" />
    <!-- ICONOS -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>static/assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>static/assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>static/assets/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url() ?>static/assets/favicon_io/site.webmanifest">

    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#ffffff">
    <script src='<?= base_url() ?>static/node_modules/jquery/jquery-3.6.0.min.js'></script>
    <script>
        var appData = {
            base_url: "<?= base_url() ?>",
            ws_url: "<?= base_url() ?>../back/",
            email_cliente: "<?= $this->session->email_cliente ?>",
            nombre_cliente: "<?= $this->session->nombre_cliente ?>",
            apellidos_cliente: "<?= $this->session->apellidos_cliente ?>",
            token: "<?= $this->session->token ?>",
            idcliente: "<?= $this->session->idcliente ?>",
            direccion: "<?= $this->session->direccion ?>",
            cantidadicono: "<?= base_url() ?>../back/productos/cantidadcarrito/<?= $this->session->idcliente ?>"
        };
    </script>

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">

            <!-- MOSTRAR BIENVENIDA CLIENTE  -->
            <div class="d-flex justify-content-between mt-4 mb-4">
                <?php if (empty($this->session->userdata('idcliente'))) : ?>
                    <strong style="color:white;padding-right: 20px; justify-content:baseline; align-items:baseline;">
                        Don't you have an account?
                    </strong>
                <?php elseif (!empty($this->session->userdata('idcliente'))) : ?>
                    <strong style="color:white;padding-right: 20px;">
                        <small> Welcome <?= $this->session->nombre_cliente ?> <?= $this->session->apellidos_cliente ?>
                        </small>
                    </strong>
                <?php endif; ?>
            </div>
            <!-- MOSTRAR BIENVENIDA CLIENTE  -->

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <!-- MOSTRAR INICIAR SESION O CERRAR SESION -->
                    <?php if (empty($this->session->userdata('idcliente'))) : ?>
                        <li class="nav-item"> <a href="#" class="nav-link" onclick="return iniciarSesion()"><i class="fas fa-user me-2"></i> Login</a> </li>
                    <?php elseif (!empty($this->session->userdata('idcliente'))) : ?>
                        <li class="nav-item"><a class="nav-link" <a href="<?= base_url() ?>home/cierrasesion/<?= $this->session->email_cliente ?>/<?= $this->session->token ?>"><i class="fas fa-user me-2"></i> Log out</a></li>
                    <?php endif; ?>
                    <!-- MOSTRAR INICIAR SESION O CERRAR SESION -->
                    <li class="nav-item"><a class="nav-link" href="#services"style="margin-inline:inherit">Utilities</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio"style="margin-inline:inherit">Productos</a></li>


                    <!-- WISHES -->
                    <?php if (empty($this->session->userdata('idcliente'))) : ?>
                        <li class="nav-item">
                        <a href="#"onclick="return iniciarSesion()" class="nav-link corazon"style="margin-inline:inherit;display:flex">Wishes
                                    <i class="fa fa-heart"></i></a></li>
                          
                    <?php elseif (!empty($this->session->userdata('idcliente'))) : ?>
                        <li class="nav-item"> 
                      <a href="#" class="nav-link corazon" style="margin-inline:inherit;display:flex" onclick="return wishes()"> Wishes<i class="fa fa-heart"></i></a></li>
                    <?php endif; ?>
                    <!-- WISHES -->

 
                    <li class="nav-item"><a class="nav-link " href="#team">Account</a></li>
                </ul>
            </div>
            <div class="navbarcarrito">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <!--ENTRAR A CARRITO O ENVIAR A LOGIN -->
                        <?php if (!empty($this->session->userdata('idcliente'))) : ?>
                            <button class="btn btn-social">
                                <a href="#" class="nav-link" onclick="return shopping()"><i class="fas fa-shopping-cart fa-lg"></i></a>
                            </button>
                            <span class="badge badge-notify" id="cantidad-cart"></span>
                        <?php elseif (empty($this->session->userdata('idcliente'))) : ?>

                            <button class="btn  btn-social" onclick="return iniciarSesion()">
                                <a href="#" class="nav-link"><i class="fas fa-shopping-cart fa-lg"></i></a>
                            </button>
                            <!-- CANTIDAD EN ICONO DE CARRITO -->
                            <span class="badge badge-notify">Login</span>
                        <?php endif; ?>
                        <!--ENTRAR A CARRITO O ENVIAR A LOGIN -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Carrousel-->
    <section class="home nopadding">
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-controls">
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active" style="background-image:url('<?= base_url() ?>static/assets/img/carousel/1.jpeg')"></li>
                    <li data-target="#carousel" data-slide-to="1" style="background-image:url('<?= base_url() ?>static/assets/img/carousel/2.jpeg')"></li>
                    <li data-target="#carousel" data-slide-to="2" style="background-image:url('<?= base_url() ?>static/assets/img/carousel/3.jpeg')"></li>
                </ol>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <img src="<?= base_url() ?>static/assets/img/logos/left-arrow.svg" alt="Prev">
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <img src="<?= base_url() ?>static/assets/img/logos/right-arrow.svg" alt="Next">
                </a>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" style="background-image:url('<?= base_url() ?>static/assets/img/carousel/1.jpeg')">
                    <div class="container">
                        <h2>The best products</h2>
                        <p>Calisthenix</p>
                    </div>
                </div>
                <div class="carousel-item" style="background-image:url('<?= base_url() ?>static/assets/img/carousel/2.jpeg')">
                    <div class="container">
                        <h2>Be yourself</h2>
                        <p>Calisthenix</p>
                    </div>
                </div>
                <div class="carousel-item" style="background-image:url('<?= base_url() ?>static/assets/img/carousel/3.jpeg')">
                    <div class="container">
                        <h2>Become stronger</h2>
                        <p>Calisthenix</p>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Utilities</h2>
                <h3 class="section-subheading text-muted">Get your gym equipment rigth now</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Delivery</h4>
                    <p class="text-muted">Acquire from the comfort of your wherever you are, we'll send it to you for free</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Multiplatform</h4>
                    <p class="text-muted"> We can be found on web or by android app (google play store)
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Compras Seguras</h4>
                    <p class="text-muted">Comprar nunca fue tan facil y seguro, hasta que llegamos nosotros.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section bg-light">
        <div class="container">
            <div class="text-center" style="display:flex; justify-content:flex-start">

                <!-- PRODUCTOS -->
                <div class="select">
                    <select id="select_categorias">
                        <option selected>All</option>

                    </select>
                </div>
                <div class="display-block" style="display:inline-block">
                    <h2 class="section-heading text-uppercase" style="margin-left: 100%;" id="titulo_productos">Products
                        <h3 class="section-subheading text-muted" style="margin-left: 100%;width:max-content">&nbsp;
                            &nbsp; take a look to our catalog</h3>
                    </h2>

                </div>
            </div>
            <!--INSERTAR PRODUCTOS -->
            <div class="row" id="portfolio">

            </div>
        </div>
    </section>
    <!-- About-->
    <section class="page-section" id="about">
        <div class="container">

            <ul class="timeline">


                <li class="timeline-inverted">
                    <div class="timeline-image">
                        <h4>
                            Get
                            <br />
                            stronger
                            <br />
                            every day!
                        </h4>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <!-- Clients-->
    <div class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?= base_url() ?>static/assets/img/logos/microsoft.svg" alt="..." /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?= base_url() ?>static/assets/img/logos/google.svg" alt="..." /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?= base_url() ?>static/assets/img/logos/facebook.svg" alt="..." /></a>
                </div>
                <div class="col-md-3 col-sm-6 my-3">
                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?= base_url() ?>static/assets/img/logos/ibm.svg" alt="..." /></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact-->

    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Calisthenix</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!">Privacy policies</a>
                    <a class="link-dark text-decoration-none" href="#!">Terms of use</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modals-->
    <!-- Modal Inicio de Sesion-->
    <div class="modal fade" id="loginM" tabindex="-1" role="dialog" aria-labelledby="modallogin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modallogin">LOGIN</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Parte cambiante -->
                <form id="newModalTableForm" method="post">
                    <div class="modal-body inicioSesionModal" id="modal_inicio_session_m">
                        <div class="container-login">
                            <div class="forms-container">
                                <div class="signin-signup">
                                    <form class="login_form">
                                        <h2 class="title">Iniciar Sesión</h2>
                                        <div class="input-field mb-3">
                                            <i class="fas fa-envelope iconleft" style="left:1px;"></i>
                                            <input type="email" placeholder="Correo electrónico" class="input correoel" name="correoelectronico" id="correoelectronico" />
                                        </div>
                                        <div class="input-field mb-3">
                                            <i class="fas fa-key iconleft" style="left:1px;"></i>
                                            <input type="password" name="pass" id="pass" autocomplete="off" placeholder="Contraseña" class="input" />
                                            <i onclick="show('pass')" class="fas fa-eye-slash fa-fw" id="display" style="margin-right:10px;"></i>
                                        </div>
                                        <input type="submit" value="Entrar" class=" btn solid btn-session mb-2" />


                                        <a href="#" onclick="return registrar_usuario()" class="external mb-2"> Create
                                            an Account</a>
                                        <div class="section" id="contact">
                                            <footer>
                                                <span class="mb-4">© All rights reserved. Calisthenix</span>
                                            </footer>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- //REGISTRAR -->
                    <div class="modal-body inicioSesionModal" id="modal_registro_m">
                        <div class="container-login">
                            <div class="forms-container">
                                <div class="signin-signup">
                                    <form method="post" id="form-registro" class="login_form">
                                        <h2 class="title">Create an Account</h2>


                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label>First name</label>
                                                <input type="text" class="form-control tiene" placeholder="first name" required name="nombreUser" id="nombreUser">
                                                <div class="invalid-feedback">
                                                    First Name must be larger!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label>Last name</label>
                                                <input type="text" class="form-control tiene" placeholder="Last name" required name="ApellidoUser" id="ApellidoUser">
                                                <div class="invalid-feedback">
                                                    Last Name must be larger!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label>Phone</label>
                                                <input type="number" class="form-control tiene" placeholder="Phone " required name="NumeroUser" id="NumeroUser">
                                                <div class="invalid-feedback">
                                                    10 digits only
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label>Email</label>
                                                <input type="email" class="form-control tiene" placeholder="Email" required name="emailUser" id="emailUser">
                                                <div class="invalid-feedback">
                                                    Has to be -> "user@domain.com"
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">

                                            <div class="col-md-12 mb-3">
                                                <label>Password</label>
                                                <input type="text" class="form-control tiene" placeholder="Password" required name="passwordUser" id="passwordUser">
                                                <div class="invalid-feedback">
                                                    Password must be 8 lenght minimum
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">

                                            <div class="col-md-12 mb-3">
                                                <label>Home Adress</label>
                                                <input type="text" class="form-control tiene" placeholder="Home Adress" required name="ciudadUser" id="ciudadUser">
                                                <div class="invalid-feedback">
                                                    Home Address must be larger
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" value="Register" id="btn-guardar" class="btn btn-primary" />

                                        <!-- </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="modal_footer_registro_sesion">
                        <button type="button" id="cerrar" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fin Modal Inicio de Sesion -->

    <!-- Modal Carrito de Compras -->
    <div class="modal fade" id="carritoM" tabindex="-1" role="dialog" aria-labelledby="modalCarrito" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCarrito">Shopping Cart</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modalCarritoUser">
                </div>
            </div>
        </div>
    </div>





    <!-- Portfolio item 1 modal popup-->
    <div class="portfolio-modal modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="margin: 50px auto;max-width:50%">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="<?= base_url() ?>static/assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center" style="background-color:#FFF5E3">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->
                                <h2 class="text-uppercase" id="ProjectName"></h2>
                                <p class="item-intro text-muted">Calisthenix</p>
                                <img class="img-fluid d-block mx-auto" style="width:300px;height:300px" id="ProjectImage" src="" alt="close modal" />
                                <p id="ProjectDescription"> </p>
                                <ul class="list-inline">
                                    <li style="display:flex">
                                        <strong style="font-size:1.5rem">Price: &nbsp; </strong>
                                        <p id="ProjectPrice" style="font-size:1.2rem; margin: 0 10px">Price: </p>

                                    </li>
                                    <li style="display:flex">
                                        <strong style="font-size:1.5rem">Category:&nbsp;</strong>
                                        <p id="ProjectCategory" style="font-size:1.2rem; margin: 0 10px">Category: </p>
                                    </li>
                                    <p id="ProjectId" hidden style="font-size:1.2rem; margin: 0 10px">id </p>
                                </ul>

                                <button id="cerrarmodal" class="btn btn-dark btn-lg text-uppercase" style="margin:0 20px" data-bs-dismiss="modal" type="button">
                                    <i class="fas fa-times me-1"></i>
                                    Continue looking
                                </button>

                                <?php if (empty($this->session->userdata('idcliente'))) : ?>
                                    <button onclick="return iniciarSesion()" class="btn btn-success btn-lg text-uppercase" style="margin:0 20px" type="button">
                                        <i class="fas fa-times me-1"></i>
                                        Add to Shopping Cart
                                    </button>
                                <?php elseif (!empty($this->session->userdata('idcliente'))) : ?>
                                    <button id="addCart" onclick="" class="btn btn-success btn-lg text-uppercase" style="margin:0 20px" type="button">
                                        <i class="fas fa-times me-1"></i>
                                        Add to Shopping Cart
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Fin Modal Carrito de Compras-->
    <!-- Fin Modals-->
    <!-- Bootstrap core JS-->
    <script src="<?= base_url() ?>static/vendor/bootstrap513.bundle.min.js"></script>
    <script src="<?= base_url() ?>static/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>static/vendor/jquery/jquery.min.js"></script>
    <!--- Sweet Alert --->
    <script src="<?= base_url() ?>static/vendor/sweetalert/sweetalert2.all.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= base_url() ?>static/js/scripts.js"></script>
    <script src="<?= base_url() ?>static/js/alert.js"></script>
    <!---<script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=MXN" data-sdk-integration-source="button-factory"></script>-->
    <script src="https://www.paypal.com/sdk/js?client-id=AdQKJEmkXXmzU70smbIoHWng02h5EC7-mwi3P1sy1AujADe9HaoaY-s7s0Egbvq0_ImD9ccXssH_lm2R&currency=MXN">
    </script>
    <script type="text/javascript" src="<?= base_url() ?>static/js/main.js"></script>
    <script src="<?= base_url() ?>static/vendor/sbforms.js"></script>
    <script src="<?= base_url() ?>static/js/mensajes.js"></script>
    <script src="<?= base_url() ?>static/js/sesion.js"></script>
    <script src="<?= base_url() ?>static/js/carrito.js"></script>
    <script src="<?= base_url() ?>static/js/productos.js"></script>
    <script src="<?= base_url() ?>static/js/shopping.js"></script>
    <script src="<?= base_url() ?>static/js/deseos.js"></script>
</body>

</html>