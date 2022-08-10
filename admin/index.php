<?php
session_start();
    if($_POST) {
        if(($_POST["usuario"]=="yesicanicole")&&($_POST["password"]=="holamucho")){
            $_SESSION["usuario"]="ok";
            $_SESSION["nombreUsuario"]="YesicaNicole";
            header('Location:inicio.php');
        } else {
            $mensaje="Error: El usuario y/o contraseña son incorrectos.";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mucho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-warning">Login</h4>
                    </div>
                    <div class="card-body">
                        <?php if() {} ?>
                        <div class="alert alert-warning" role="alert">
                            <?php echo $mensaje; ?>
                        </div>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Usuario</label>
                                <input type="text" class="form-control" name="usuario" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-warning">Ingresar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>