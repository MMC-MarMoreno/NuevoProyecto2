<?php 
 
 $host = "localhost"; 
 $user = "root"; 
 $password = ""; 
 $db = "proyectgestioncomunidad";

try {
 $conexion = mysqli_connect($host ,$user, $password,$db);
   if ($conexion){ echo "Conectado.... a proyectgestioncomunidad";}
     } catch (Exception $ex){
       echo $ex->getMessage();
}

?>