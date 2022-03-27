<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Practica 2</title>
    <link
      rel="stylesheet"
      href="../node_modules/bootstrap/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="../node_modules/fontawesome-free-5.15.4-web/css/all.min.css"
    />
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../node_modules/jquery/jquery.min.js"></script>
    <script src="practica2.js"></script>
    <script src="mensajes.js"></script>

  </head>
  <body>
    <div class="container-fluid">
      <h3>Practica 2</h3>

      <div class="row mt-4">
        <div class="col-md-2 mt-2">
          <form id="form-cantidad">
            <div class="form-group"id='group-cantidad'>
              <label for=""><strong>Objetos:</strong></label>
              <input type="number" id="cantidad" min="1"value='1'
               class='form-control is-valid'/>
            </div>
            <button class="btn btn-success btn-lg mt-4" type="submit">
              <i class="fas fa-paper-plane"></i>
              Enviar
            </button>
          </form>
        </div>
        <div class="col-md-10">
          <div class="card"style='height:400px;'>
            <div class="card-header bg-secondary text-white"><strong>Resultado de la practica</strong></div>
            <div class="card-body"id='resultado'>Aqui se dibujaran los objetos</div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
