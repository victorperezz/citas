<?php


 if (isset($_POST['guardar'])) {
    // Recibe los datos del formulario
    $mascota = $_POST['mascota'];
    $propietario = $_POST['propietario'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $sintomas = $_POST['sintomas'];

    include ("db.php");
    // Inserta los datos en la base de datos
    $sql = "INSERT INTO datos (mascota, propietario, telefono, fecha, hora, sintomas) VALUES ('".$mascota."', '".$propietario."', '".$telefono."', '".$fecha."', '".$hora."', '".$sintomas."')";
    $resultado=mysqli_query($conn,$sql);

    // Ejecuta la consulta y verifica si fue exitosa
    if ($resultado) {
        echo "<script language='JavaScript'>
        alert('Los datos se agregaron correctamente');
        location.assign('index.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
        alert('Los datos NO se agregaron');
        location.assign('index.php');
        </script>";
      }
    mysqli_close($conexion);
}else{
 ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="PWA JS.">
    <title>Administrador de Pacientes</title>
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="apple-touch-icon" href="img/icons/Icon-96x96.png">
    <link rel="icon" type="image/x-icon" href="img/icons/Icon-72.png">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="black">
</head>
<body>
    <div id="splashScreen" class="splash">
        <img src="img/icons/Icon-144.png">
        <br>
        <h1>Bienvenido</h1>
      </div>
      
    <h2 class="text-center my-5 titulo">Administrador de Pacientes de Veterinaria</h2>
    <div class="container mt-5 p-5">
        <div id="contenido" class="row">
            <div class="col-md-6 agregar-cita">
                <form id="nueva-cita" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                    <legend class="mb-4">Datos del Paciente</legend>
                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Nombre Mascota:</label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="text" id="mascota" name="mascota" class="form-control" placeholder="Nombre Mascota">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Propietario:</label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="text" id="propietario" name="propietario" class="form-control"  placeholder="Nombre Dueño de la Mascota">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Teléfono:</label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="tel" id="telefono" name="telefono" class="form-control"  placeholder="Número de Teléfono">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Fecha:</label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="date" id="fecha" name="fecha" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Hora:</label>
                        <div class="col-sm-8 col-lg-8">
                            <input type="time" id="hora" name="hora" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-lg-4 col-form-label">Sintomas:</label>
                        <div class="col-sm-8 col-lg-8">
                            <input id="sintomas" name="sintomas" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                            <button name="guardar" type="submit" class="btn btn-success w-100 d-block">Crear Cita</button>
                    </div>
                </form>
                <?php
    }
    ?>
            </div>
            <div class="col-md-6">
                <h2 id="administra" class="mb-4"></h2>
                <ul id="citas" class="list-group lista-citas"></ul>
            </div>
        </div> <!--.row-->
    </div><!--.container-->

    <script src="js/app.js"></script>
    <script src="js/apv.js"></script>

</body>
</html>
