<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="CodeHim">
  <title>Shopping Cart</title>

  <!-- Style CSS -->
  <link href="<?= base_url() ?>static/css/alert.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url() ?>static/css/shopping.css">
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
  <main>

    <header id="site-header">
      <div class="container">
        <h1>Shopping cart <span>[</span> <em id="nombreCliente"></em> <span class="last-span is-open">]</span></h1>
        <button id="btn_back" type="button" class="btn " onclick="return tienda()">Go back</button>
      </div>
    </header>

    <div class="container">
      <section id="cart">

      </section>
    </div>

    <footer id="site-footer">
      <div class="container clearfix">
        <div class="left">
          <h2 class="subtotal">Subtotal: $ <span>0</span></h2>
          <h3 class="tax">Taxes (5%): <span>8.2</span>€</h3>
        </div>
        <div class="right">
          <h1 class="total">Total: $ <span id="subtotal">177.16</span></h1>
          <a class="btn" id="checkout" onclick="insertardetalle()">Checkout</a>
        </div>
      </div>
    </footer>
  </main>


  <footer class="credit" style="display:flex;justify-content:center;padding:15px">Calisthenix- Distributed By: Alex Santiago</footer>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="<?= base_url() ?>static/js/shopping.js"></script>
  <script src="<?= base_url() ?>static/js/alert.js"></script>
</body>

</html>