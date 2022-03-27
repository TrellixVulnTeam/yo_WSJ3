<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1" width="50%" cellpadding="10">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Matricula</th>
                <th>Carrera</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td><?= $nombre ?></td>
            <td><?= $matricula ?></td>
            <td><?= $carrera ?></td>
            </tr>
          
        </tbody>
    </table>
    <a href="<?= base_url()?>">Inicio</a>
</body>

</html>