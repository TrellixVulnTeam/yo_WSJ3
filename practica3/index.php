<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Práctica 3</title>

    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./node_modules/fontawesome-free-5.15.4-web/css/all.min.css">

    <script src="./node_modules/jquery/jquery.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="js/practica3.js"></script>
    <script src="js/mensajes.js"></script>
</head>


<body>
    <div class="#container-fluid ms-2">
        <h3>Práctica 3 </h3>
    </div>

    <div class="row mt-4">

        <div class="col-md-3 ">

            <form id="form-personas">
                <div class="form-group" id="group-personas">
                    <label for="personas"><strong>Registered users</strong> </label>
                    <select multiple size="4" name="personas[]" id="personas" class="form-control">
                    </select>
                </div>

                <button class="btn btn-success btn-lg mt-4" typr="submit">
                    <i class="fas fa-paper-plane fa-2x"></i>
                    Send
                </button>

            </form>

            <div id="mensaje" class="mt-5"></div>
        </div>


        <div class="col-md-9">

            <div class="card" style="height: 500px;">
                <div class="card-header bg-secondary text-white">
                    <strong>Users</strong>
                </div>
                <div class="card-body" id="resultado">
                    Display of objects
                </div>
            </div>
        </div>
    </div>

</body>

</html>