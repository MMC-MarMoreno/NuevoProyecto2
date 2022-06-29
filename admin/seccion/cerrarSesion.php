<?php include("admin/configuracion/conexion.php");?>
<?php include("template/cabecera.php");?>
public function logout(){
      session_start();
      session_destroy();    
      header("location:admin/index.php"); // HTTP
  }
    

  <?php include("template/pie.php");?>