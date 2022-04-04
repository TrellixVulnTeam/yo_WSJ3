<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="CodeHim">
  <title>Update Quantity Shopping Cart Example</title>

  <!-- Style CSS -->
  <link href="<?=base_url()?>static/css/alert.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url() ?>static/css/shopping.css">
  <!-- Demo CSS (No need to include it into your project) -->

  <script>
    var appData = {
      base_url: "<?= base_url() ?>",
      ws_url: "<?= base_url() ?>../back/",
      email_cliente: "<?= $this->session->email_cliente ?>",
      nombre_cliente: "<?= $this->session->nombre_cliente ?>",
      apellidos_cliente: "<?= $this->session->apellidos_cliente ?>",
      token: "<?= $this->session->token ?>",
      idcliente: "<?= $this->session->idcliente ?>",
      direccion: "<?= $this->session->direccion ?>"
    };
  </script>
</head>

<body>
  <!-- <header class="intro">
 <h1>Update Quantity Shopping Cart Example</h1>
 <p>A JavaScript project to update quantity and price in shopping cart.</p>

 <div class="action">
 <a href="https://www.codehim.com/collections/javascript-shopping-cart-examples-with-demo/" title="Back to download and tutorial page" class="btn back">Back to Tutorial</a>
 </div>
 </header> -->


  <main>
    <!-- Start DEMO HTML (Use the following code into your project)-->
    <header id="site-header">
      <div class="container">
        <h1>Shopping cart <span>[</span> <em id="nombreCliente"></em> <span class="last-span is-open">]</span></h1>
      </div>
    </header>

    <div class="container">

      <section id="cart">


      </section>

    </div>

    <footer id="site-footer">
      <div class="container clearfix">

        <div class="left">
          <h2 class="subtotal">Subtotal: <span>0</span>$</h2>
          <h3 class="tax">Taxes (5%): <span>8.2</span>€</h3>
        </div>

        <div class="right">
          <h1 class="total">Total: <span id="subtotal">177.16</span>€</h1>
          <a class="btn">Checkout</a>
        </div>

      </div>
    </footer>
    <!-- END EDMO HTML (Happy Coding!)-->
  </main>


  <footer class="credit">Calisthenix- Distributed By: Alex Santiago</footer>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  <script src="<?= base_url() ?>static/js/shopping.js"></script>
  <script src="<?= base_url() ?>static/js/alert.js"></script>

</body>

</html>