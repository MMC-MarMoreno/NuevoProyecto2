<?php
            session_start();
            if(!isset($_SESSION['usuario'])){
            header("location:../index.php");
            }else{
              if($_SESSION['usuario']=="ok"){
                $nombreUsuario=$_SESSION["nombreUsuario"];
              }
            }

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  
  <?php $url="http://".$_SERVER['HTTP_HOST']."/SegundoProyecto" ?>
  
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="nav navbar-nav">
        <a class="nav-item nav-link active" href="#">GestionaT<span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/admin/inicio.php">Inicio</a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/admin/seccion/presupuestos.php">Presupuestos</a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/admin/seccion/movimientos.php">Movimientos</a>
        <a class="nav-item nav-link" href="<?php echo $url;?>/admin/seccion/informes.php">Informes</a>        
        <a class="nav-item nav-link" href="<?php echo $url;?>">Cerrar Sesión</a>
    </div>
</nav>
  <div class="container">
      <br/>
        <div class="row">