<!-- <?php
// include_once "bd/crud.php";
// include_once "bd/session.php";
// $Session = new Session();
// $iduser = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
// $estatusSession = $iduser == 0 ? 0 : 1;
// $functions    = new Crud();
// if($iduser != 0){
    //     $productos_disponibles = $functions -> productos_disponibles_con_carrito_cliente($iduser,'1');
    //     $carrito = $functions -> cantidad_en_carrito($iduser);
    // }
    // else{
        //     $carrito = 0;
        //     $productos_disponibles = $functions -> productos_disponibles('1');
        // }
        // $sucursales = $functions->catalogo_de_sucursales();
        // $sucursal_actual = "";
        ?> -->
        
        <!-- <input id="iduser" name="iduser" type="hidden" value= <?php echo($iduser);?>> -->
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="Alex Santiago" />
        <title>Calisthenix</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!--- Datatables --->
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/vendor/datatables/css/datatables.min.css"/>
        <!--- Datatables  style Bootstrap 4--->
        <link rel="stylesheet"  type="text/css" href="<?=base_url()?>static/vendor/datatables/css/bootstrap4/css/dataTables.bootstrap4.min.css">
        <!--- Datatables Responsive --->
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>static/vendor/datatables/css/responsive/responsive.dataTables.min.css"/> 
        <link href="<?=base_url()?>static/css/styles.css" rel="stylesheet" />
        <link href="<?=base_url()?>static/css/select.css" rel="stylesheet" />
        
        <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url()?>static/assets/favicon_io/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>static/assets/favicon_io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>static/assets/favicon_io/favicon-16x16.png">
        <link rel="manifest" href="<?=base_url()?>static/assets/favicon_io/site.webmanifest">
        
        <meta name="msapplication-TileColor" content="#00aba9">
        <meta name="theme-color" content="#ffffff">
        <script src='<?=base_url()?>static/node_modules/jquery/jquery-3.6.0.min.js'></script>
        <script>
        var appData = {
            base_url  : "<?=base_url()?>",
            ws_url    : "<?=base_url()?>../back/",
            email_cliente    : "<?= $this->session->email_cliente?>",
            nombre_cliente    : "<?= $this->session->nombre_cliente?>",
            apellidos_cliente    : "<?= $this->session->apellidos_cliente?>",
            token     : "<?= $this->session->token?>",
            idcliente : "<?= $this->session->idcliente?>",
            direccion : "<?=$this->session->direccion?>"
        };
        </script>
        
        </head>
        <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
        <!-- -<a class="navbar-brand" href="#page-top"><img src="<?=base_url()?>static/assets/img/navbar-logo.svg" alt="..." /></a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu<i class="fas fa-bars ms-1"></i>
        </button>
        
        <div class="d-flex justify-content-between mt-4 mb-4">
        
        <?php if(empty($this->session->userdata('idcliente'))):?>
            <strong style="color:white;padding-right: 20px; justify-content:baseline; align-items:baseline;" >
            Don't you have an account?  
            </strong>
            <?php elseif(!empty($this->session->userdata('idcliente'))):?>
                <strong style="color:white;padding-right: 20px;">
                <small>   Welcome <?= $this->session->nombre_cliente ?> <?= $this->session->apellidos_cliente ?> </small>
                </strong>
                <?php endif;?>
                
                
                </div>
                <div class="navbarsession">
                <ul class="navbar-nav">
                <li class="nav-item">
                
                
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
            
            </li>
            </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
            <?php if(empty($this->session->userdata('idcliente'))):?>
                <li class="nav-item">  <a href="#" class="nav-link" onclick="return iniciarSesion()"><i class="fas fa-user me-2" ></i> Login</a> </li>
                <?php elseif(!empty($this->session->userdata('idcliente'))):?>
                    <li class="nav-item"><a class="nav-link"  <a href="<?= base_url() ?>home/cierrasesion/<?=$this->session->email_cliente?>/<?=$this->session->token?>"><i class="fas fa-user me-2" ></i> Log out</a></li>
                    
                    <?php endif;?>
                    <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#portfolio">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Acerca De</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Equipo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                    </ul>
                    </div>
                    <div class="navbarcarrito">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                    
                    <?php  if(!empty($this->session->userdata('idcliente'))):?>
                        
                        <button class="btn btn-social">
                        <a href="#"class="nav-link" id = "carritopro" ><i class="fas fa-shopping-cart fa-lg"></i></a> 
                        </button>
                        <span class="badge badge-notify" id="cantidad-cart">0</span>
                        
                        <?php elseif(empty($this->session->userdata('idcliente'))):?>
                            
                            <button class="btn  btn-social" onclick="return iniciarSesion()">
                            <a href="#"  class="nav-link"><i class="fas fa-shopping-cart fa-lg"></i></a> 
                            </button>
                            <span class="badge badge-notify" id="cantidad-cart">Login</span>
                            <?php endif;?>
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
                            <li data-target="#carousel" data-slide-to="0" class="active" style="background-image:url('<?=base_url()?>static/assets/img/carousel/1.jpeg')"></li>
                            <li data-target="#carousel" data-slide-to="1" style="background-image:url('<?=base_url()?>static/assets/img/carousel/2.jpeg')"></li>
                            <li data-target="#carousel" data-slide-to="2" style="background-image:url('<?=base_url()?>static/assets/img/carousel/3.jpeg')"></li>
                            </ol>
                            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                            <img src="<?=base_url()?>static/assets/img/team/left-arrow.svg" alt="Prev">     
                            </a>
                            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                            <img src="<?=base_url()?>static/assets/img/team/right-arrow.svg" alt="Next">
                            </a>
                            </div>
                            <div class="carousel-inner">
                            <div class="carousel-item active" style="background-image:url('<?=base_url()?>static/assets/img/carousel/1.jpeg')">
                            <div class="container">
                            <h2>The best products</h2>
                            <p>Calisthenix</p>
                            </div>
                            </div>
                            <div class="carousel-item" style="background-image:url('<?=base_url()?>static/assets/img/carousel/2.jpeg')">
                            <div class="container">
                            <h2>Be yourself</h2>
                            <p>Calisthenix</p>
                            </div>
                            </div>
                            <div class="carousel-item" style="background-image:url('<?=base_url()?>static/assets/img/carousel/3.jpeg')">
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
                            <h2 class="section-heading text-uppercase">Servicios</h2>
                            <h3 class="section-subheading text-muted">Nada vale más que la comodidad.</h3>
                            </div>
                            <div class="row text-center">
                            <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="my-3">Entregas</h4>
                            <p class="text-muted">Compra desde la comodidad de tu casa, oficina o donde sea que te encuentres, y nosotros te lo enviamos.</p>
                            </div>
                            <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="my-3">Diseño Innovador</h4>
                            <p class="text-muted">Nuestros productos podras visualizarlos desde cualquier tipo de dispositivo.</p>
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
                            <!-- Portfolio Grid-->
                            <section class="page-section bg-light" id="suc">
                            <div class="container-fluid">
                            <div class="col-12">
                            <div class="row">
                            <div class = "col-md-4">
                            
                            <div class="select" style="margin-left:50%">
                            <select id="select_categorias">
                            <option selected disabled >All</option>
                      
                            </select>
                            </div>
                    
             
                                            </div>
                                            
                                            </div>
                                            </div>
                                            </div>
                                            </section>
                                            <section class="page-section bg-light">
                                            <div class="container">
                                            <div class="text-center">
                                            
                                            <!-- PRODUCTOS -->
                                            
                                            
                                            <h2 class="section-heading text-uppercase" id = "titulo_categoria"></h2>
                                            
                                            
                                            
                                            
                                            <h2 class="section-heading text-uppercase" id = "titulo_productos">Products</h2>
                                            <h3 class="section-subheading text-muted">take a look to our catalog</h3>
                                            </div>

                                            <div class="row" id="portfolio">
                    <!-- <div class="col-lg-4 col-sm-6 mb-4"> -->
                        <!-- Portfolio item 1-->
                        <!-- <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/1.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Threads</div>
                                <div class="portfolio-caption-subheading text-muted">Illustration</div>
                            </div>
                        </div>
                    </div> -->
                                            
                        <!-- <?php
                        // foreach ($productos_disponibles as $row){
                            //     $id_prod     = $row["id_prod"];
                            //     $descripcion = $row["descripcion_prod"];
                            //     $img_produc  = $row["img_producto"];
                            //     $categoria   = $row["categoria_prod"];
                            //     $precio      = $row["precio_prod"];
                            //     $stock       = $row["stock"];
                            //     $class       = $stock <= 0 ? "producto_agotado" : ($stock <= 5 ? "producto_por_agotar" : "producto_existencia");
                            //     $text        = $stock <= 0 ? "Stock Agotado" : ($stock <= 5 ? "Stock disponible" : "Stock disponible");
                            //     $icono       = $stock <= 0 ? "<i class='fas fa-store-slash me-2'></i>" : ($stock <= 5 ? "<i class='fas fa-shopping-bag me-2'></i>" : "<i class='fas fa-shopping-bag me-2'></i>");
                            //     // crear el item 
                            //     echo('<div class="col-lg-4 col-sm-6 mb-4">
                            //             <div class="portfolio-item">
                            //                 <a class="portfolio-link"  href="#" onclick="return false;">
                            //                 <div class="portfolio-hover '.$class.'" id = "div'.$id_prod.'">
                            //                     <form >
                            //                         <div class="portfolio-hover-content" id = "text'.$id_prod.'">
                            //                             '.$icono.$text.'
                            //                         </div>
                            //     ');
                            //     if($stock != 0){
                                //         echo('
                                //                         <div class="cantidad_disponible mt-2">
                                //                                     <span>Cantidad: </span>
                                //                                     <span id = "'.$id_prod.'" class = "cantidades_stock">'.$stock.' piezas</span>
                                //                                 </div>
                                //                                 <div class="text-center mt-4">
                                //                                     <button class="btn btn-info btn-social"  id = "button'.$id_prod.'" onclick="return agregarCarrito(\'' . $id_prod . '\') ">
                                //                                         <i class="fas fa-plus-circle"></i>
                                //                                     </button>
                                //                                 </div>
                                //         ');
                                //     }
                                //         echo(' 
                                //                     </form>
                                //                 </div>
                                //                 <img class="img-fluid" src="'.$img_produc.'" alt="..." />
                                //                 </a>
                                //                 <div class="portfolio-caption">
                                //                     <div class="portfolio-caption-heading">'.$categoria.'</div>
                                //                     <div class="portfolio-caption-subheading text-muted">'.$descripcion.'</div>
                                //                 </div>
                                //             </div>
                                //         </div>               
                                //         ');
                                // }
                                ?> -->
                                                    </div>
                                                    </div>
                                                    </section>
                                                    <!-- About-->
                                                    <section class="page-section" id="about">
                                                    <div class="container">
                                                    <div class="text-center">
                                                    <h2 class="section-heading text-uppercase">Acerca De</h2>
                                                    <h3 class="section-subheading text-muted">Conocenos más a fondo.</h3>
                                                    </div>
                                                    <ul class="timeline">
                                                    <li>
                                                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?=base_url()?>static/assets/img/about/1.jpg" alt="..." /></div>
                                                    <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                    <h4>2020-2021</h4>
                                                    <h4 class="subheading">Nuestros Comienzos</h4>
                                                    </div>
                                                    <div class="timeline-body"><p class="text-muted">Nacimos como una necesidad de facilitarte la busqueda de la mochila perfecta la visión de tener un catalogo amplio y para todo tipo de usuario</p></div>
                                                    </div>
                                                    </li>
                                                    <li class="timeline-inverted">
                                                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?=base_url()?>static/assets/img/about/2.jpg" alt="..." /></div>
                                                    <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                    <h4>2021</h4>
                                                    <h4 class="subheading">Nuestra Idea Tomo Forma</h4>
                                                    </div>
                                                    <div class="timeline-body"><p class="text-muted">Lo que comenzo como una idea se empezo a concretar</p></div>
                                                    </div>
                                                    </li>
                                                    <li>
                                                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?=base_url()?>static/assets/img/about/3.jpg" alt="..." /></div>
                                                    <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                    <h4>2021</h4>
                                                    <h4 class="subheading">Creamos un modelo de negocio</h4>
                                                    </div>
                                                    <div class="timeline-body"><p class="text-muted"> Todos los colaboraderes llegamos al común acuerdo de que la mejor manera de crecer era aprovechando los recursos y las ventajas de las plataformas online.</p></div>
                                                    </div>
                                                    </li>
                                                    <li class="timeline-inverted">
                                                    <div class="timeline-image"><img class="rounded-circle img-fluid" src="<?=base_url()?>static/assets/img/about/4.jpg" alt="..." /></div>
                                                    <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                    <h4>Octubre 2021</h4>
                                                    <h4 class="subheading">Fase de Expansión</h4>
                                                    </div>
                                                    <div class="timeline-body"><p class="text-muted">Contabamos con el apoyo, la idea y los medios ahora venia buscar nuestro mercado y que mejor que tener diversidad en este asunto, y claro brindandote la facilidad de realizar una compra segura, con envio seguro hasta la comodidad de tu hogar</p></div>
                                                    </div>
                                                    </li>
                                                    <li class="timeline-inverted">
                                                    <div class="timeline-image">
                                                    <h4>
                                                    Se parte
                                                    <br />
                                                    De Nuestra
                                                    <br />
                                                    Historia!
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
                                                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?=base_url()?>static/assets/img/logos/microsoft.svg" alt="..." /></a>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 my-3">
                                                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?=base_url()?>static/assets/img/logos/google.svg" alt="..." /></a>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 my-3">
                                                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?=base_url()?>static/assets/img/logos/facebook.svg" alt="..." /></a>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6 my-3">
                                                    <a href="#!"><img class="img-fluid img-brand d-block mx-auto" src="<?=base_url()?>static/assets/img/logos/ibm.svg" alt="..." /></a>
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
                                                    <a class="link-dark text-decoration-none me-3" href="#!">Politicas de Privacidad</a>
                                                    <a class="link-dark text-decoration-none" href="#!">Terminos de uso</a>
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
                                                    <h5 class="modal-title" id="modallogin">Log in</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- Parte cambiante -->
                                                    <form id = "newModalTableForm" method="post" >
                                                    <div class = "modal-body inicioSesionModal" id = "modal_inicio_session_m">
                                                    <div class="container-login">
                                                    <div class="forms-container">
                                                    <div class="signin-signup">
                                                    <form class="login_form" >
                                                    <h2 class="title">Iniciar Sesión</h2>
                                                    <div class="input-field mb-3">
                                                    <i class="fas fa-envelope iconleft" style="left:1px;"></i>
                                                    <input type="email" placeholder="Correo electrónico" class="input correoel" name="correoelectronico" id="correoelectronico"/>
                                                    </div>
                                                    <div class="input-field mb-3">
                                                    <i class="fas fa-key iconleft" style="left:1px;"></i>
                                                    <input type="password" name="pass" id="pass" autocomplete="off" placeholder="Contraseña" class="input"/>
                                                    <i onclick="show('pass')" class="fas fa-eye-slash fa-fw" id="display" style="margin-right:10px;"></i>
                                                    </div>
                                                    <input type="submit" value="Entrar" class=" btn solid btn-session mb-2"/>
                                                    
                                                    
                                                    <a href="#" onclick="return registrar_usuario()" class="external mb-2"> Create an Account</a>
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
                                                    <div class = "modal-body inicioSesionModal" id = "modal_registro_m">
                                                    <div class="container-login">
                                                    <div class="forms-container">
                                                    <div class="signin-signup">
                                                    <form method="post"id="form-registro" class="login_form" >
                                                    <h2 class="title">Create an Account</h2>
                                                    
                                                    <div class="input-field mb-3" id = "divNombreuser">
                                                    <i class="fas fa-user iconleft" style="left:1px;"></i>
                                                    <input type="text" placeholder="Enter firstName" class="input" name="Nombreuser" id="Nombreuser"/>
                                                    </div>
                                                    <div class="input-field mb-3" id = "divApellidoUser">
                                                    <i class="fas fa-user iconleft" style="left:1px;"></i>
                                                    <input type="text" placeholder="Enter lastName" class="input" name="ApellidoUser" id="ApellidoUser"/>
                                                    </div>
                                                    <div class="input-field mb-3" id = "divNumeroUser">
                                                    <i class="fas fa-phone iconleft" style="left:1px;"></i>
                                                    <input type="text" placeholder="Enter Phone" class="input" name="NumeroUser" id="NumeroUser"/>
                                                    </div>
                                                    <div class="input-field mb-3" id = "divemailUser">
                                                    <i class="fas fa-envelope iconleft" style="left:1px;"></i>
                                                    <input type="email" placeholder="Enter email" class="input" name="emailUser" id="emailUser" />
                                                    </div>
                                                    <div class="input-field mb-3" id = "divpasswordUser">
                                                    <i class="fas fa-key iconleft" style="left:1px;"></i>
                                                    <input type="text" placeholder="Enter a password" class="input" name="passworduser" id="passwordUser"/>
                                                    </div>
                                                    <div class="input-field mb-3" id = "divciudadUser">
                                                    <i class="fas fa-map-marker-alt iconleft" style="left:1px;"></i>
                                                    <input type="text" placeholder="enter homeAddress" class="input" name="ciudadUser" id="ciudadUser"/>
                                                    </div>
                                                    
                                                    
                                                    
                                                    <input type="submit" value="Register" id="btn-guardar" class=" btn solid btn-session mb-2"/>
                                                    
                                                    
                                                    </form>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
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
                                                    <h5 class="modal-title" id="modalCarrito">Carrito de Compras</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class = "modal-body modalCarritoUser">
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    
                                                    <!-- <div class="aviso-cookies" id="aviso-cookies">
                                                    <img class="galleta" src="<?=base_url()?>static/assets/img/cookie.svg" alt="Galleta">
                                                    <h3 class="titulo">Cookies</h3>
                                                    <p class="parrafo">Utilizamos cookies propias y de terceros para mejorar nuestros servicios.</p>
                                                    <button class="boton" id="btn-aceptar-cookies">De acuerdo</button>
                                                    <a class="enlace" href="<?=base_url()?>static/aviso-cookies.html">Aviso de Cookies</a>
                                                    </div>  -->
                                                    <!-- <div class="fondo-aviso-cookies" id="fondo-aviso-cookies"></div> -->
                                                    <!-- Fin Modal Carrito de Compras-->
                                                    <!-- Fin Modals-->
                                                    <!-- Bootstrap core JS-->
                                                    <script src="<?=base_url()?>static/vendor/bootstrap513.bundle.min.js"></script>
                                                    <script src="<?=base_url()?>static/vendor/bootstrap.bundle.min.js"></script>
                                                    
                                                    <script src="<?=base_url()?>static/vendor/jquery/jquery.min.js"></script>
                                                    <!--- Sweet Alert --->
                                                    <script src="<?=base_url()?>static/vendor/sweetalert/sweetalert2.all.min.js"></script>
                                                    <!--- Datatables --->
                                                    <script type="text/javascript" src="<?=base_url()?>static/vendor/datatables/js/datatables.min.js"></script>  
                                                    <script type="text/javascript" src="<?=base_url()?>static/vendor/datatables/js/dataTables.responsive.min.js"></script>
                                                    <script type="text/javascript" src="<?=base_url()?>static/vendor/datatables/js/sum.js"></script>
                                                    
                                                    <!-- <script src="<?=base_url()?>static/js/aviso-cookies.js"></script> -->
                                                    <!-- Core theme JS-->
                                                    <script src="<?=base_url()?>static/js/scripts.js"></script>
                                                    <!---
                                                    
                                                    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=MXN" data-sdk-integration-source="button-factory"></script>
                                                    
                                                    -->
                                                    <script src="https://www.paypal.com/sdk/js?client-id=AdQKJEmkXXmzU70smbIoHWng02h5EC7-mwi3P1sy1AujADe9HaoaY-s7s0Egbvq0_ImD9ccXssH_lm2R&currency=MXN"></script>
                                                    
                                                    <!-- <?php
                                                    // $vale = rand(1, 100);
                                                    // echo('<script type="text/javascript" src = "<?=base_url()?>static/js/main.js'."?$vale" . '"></script>');
                                                    ?>
                                                    
                                                    -->
                                                    

<script type="text/javascript" src = "<?=base_url()?>static/js/main.js"></script>
<script src="<?=base_url()?>static/vendor/sbforms.js"></script>
<script src="<?=base_url()?>static/js/mensajes.js"></script>
<script src="<?=base_url()?>static/js/sesion.js"></script>
<script src="<?=base_url()?>static/js/carrito.js"></script>
<script src="<?=base_url()?>static/js/productos.js"></script>
</body>
</html>
