<?php 
 
 $host = "localhost"; 
 $user = "root"; 
 $password = ""; 
 $db = "proyectgestioncomunidad";

try {
 $conexion = mysqli_connect($host ,$user, $password,$db);
   if ($conexion);
     } catch (Exception $ex){
       echo $ex->getMessage();
}


?>