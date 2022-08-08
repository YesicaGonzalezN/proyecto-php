<!doctype html>
<html lang="es">
  <head>
    <title>Administrador - Mucho</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>

  <?php $url="http://".$_SERVER['HTTP_HOST']."/sitioweb-php" ?>

  <nav class="navbar navbar-expand navbar-light bg-light">
      <div class="nav navbar-nav">
          <a class="nav-item nav-link active text-warning text-uppercase fs-4" href="#">Administrador</a>
          <a class="nav-item nav-link mt-2" href="<?php echo $url;?>/admin/inicio.php">Inicio</a>
          <a class="nav-item nav-link mt-2" href="<?php echo $url;?>/admin/seccion/products.php">Productos</a>
          <a class="nav-item nav-link mt-2" href="<?php echo $url;?>/admin/seccion/close.php">Cerrar Sesión</a>
          <a class="nav-item nav-link mt-2" href="<?php echo $url;?>">Ver Sitio Web</a>
      </div>
  </nav>

    <div class="container">
        <div class="row mt-5">