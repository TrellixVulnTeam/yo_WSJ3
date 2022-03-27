<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Practica 2</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./node_modules/fontawesome-free-5.15.4-web/css/all.min.css">

    <script src="./node_modules/jquery/jquery.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/practica2.js"></script>
    <script src="js/mensajes.js"></script>
</head>


<body>
    <div class="#container-fluid ps-4 mt-2">
        <h3>2nd Practice</h3>
    </div>

    <div class="row mt-4 p-4">

        <div class="col-md-2">

            <form id="form-cantidad">

                <div class="form-group" id="group-cantidad">
                    <label><strong>Obejcts:</strong> </label>
                    <input type="number" id="cantidad" min="1" values="1" class="form-control is-valid"placeholder='Enter amount'/>
                </div>

                <button class="btn btn-outline-info btn-lg mt-4" typr="submit">
                    <i class="fas fa-paper-plane fa-2x"></i>
                    Send
                </button>

            </form>
        </div>


        <div class="col-md-10">

            <div class="card" style="height: 540px;">
                <div class="card-header bg-secondary text-white">
                    <strong>A lot of circuleees! &#10084 &#10084</strong>
                </div>
                <div class="card-body" id="resultado">
                    Display of objects
                </div>
            </div>
        </div>
    </div>

</body>

</html>