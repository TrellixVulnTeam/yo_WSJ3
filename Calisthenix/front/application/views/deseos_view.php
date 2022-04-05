<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="CodeHim">
  <title>Calisthenix</title>

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
        <h1>Favorites <span>[</span> <em id="nombreCliente"></em> <span class="last-span is-open">]</span></h1>
        <button id="btn_back" type="button" class="btn " onclick="return tienda()">Go back</button>
      </div>
    </header>

    <div class="container">
      <section id="cart">

      </section>
    </div>

   
  </main>


  <footer class="credit" style="display:flex;justify-content:center;padding:15px">Calisthenix- Distributed By: Alex Santiago</footer>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="<?= base_url() ?>static/js/alert.js"></script>
  <script src="<?= base_url() ?>static/js/deseos.js"></script>
</body>

</html>