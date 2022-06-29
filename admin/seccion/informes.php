<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informes</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php include("../template/cabecera.php"); ?>
<?php include("../configuracion/conexion.php");

$id_comunidad =  $_SESSION['usuario']['id_comunidad'];
$sentenciaSQL= "select * from movimientos where id_comunidad = $id_comunidad";
$stmt = mysqli_query($conexion, $sentenciaSQL);
$movimientos = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

$sentencia2SQL= "SELECT `movimientos`.`tipo`, `movimientos`.`cantidad` FROM `movimientos` WHERE `movimientos`.`tipo` = 'Gasto'; id_comunidad = $id_comunidad";
$stmt2 = mysqli_query($conexion, $sentencia2SQL);
$gastos = mysqli_fetch_all($stmt2, MYSQLI_ASSOC);

$sentencia3SQL= "SELECT `movimientos`.`tipo`, `movimientos`.`cantidad` FROM `movimientos` WHERE `movimientos`.`tipo` = 'Ingreso'; id_comunidad = $id_comunidad";
$stmt3 = mysqli_query($conexion, $sentencia3SQL);
$ingresos = mysqli_fetch_all($stmt2, MYSQLI_ASSOC);

//SELECT SUM(cantidad) WHERE tipo = 'Ingreso' FROM movimientos;
//SELECT SUM(cantidad) WHERE tipo = 'Gasto' FROM movimientos;

//SELECT `movimientos`.`tipo`, `movimientos`.`cantidad`, `presupuestos`.`importeTotal` FROM `movimientos` , `presupuestos` WHERE `movimientos`.`tipo` = 'Gasto';

//Total a descontar

?>

<div class="col-md-7"> 
     <table class="table">
        <thead>
          <h1>Movimientos Económicos</h1><br/>
            <tr>
                <th>Fecha</th>
                <th>TipoMovimiento</th>
                <th>Concepto</th>
                <th>Cantidad</th>                
            </tr>
        </thead>
        <tbody>
        <?php
          foreach($movimientos as $movimiento){ ?>
            <tr>
              <td><?php echo $movimiento['fecha'];?></td>
              <td><?php echo $movimiento['tipo'];?></td>
              <td><?php echo $movimiento['concepto'];?></td>
              <td><?php echo $movimiento['cantidad'];?></td>
              <td>           
              <form method="POST">
                <input type="hidden" name="fecha"  value="<?php echo $movimiento['fecha']; ?>">
                <input type="hidden" name="tipo" value="<?php echo $movimiento['tipo']; ?>">
                <input type="hidden" name="concepto" value="<?php echo $movimiento['concepto']; ?>">
                <input type="hidden" name="cantidad"  value="<?php echo $movimiento['cantidad']; ?>">                                
              </form>
              </td>
            </tr>     
        <?php } ?>         
        </tbody>
    </table>
</div>




<div class="col-md-7"> 
     <table class="table">
        <thead>
          <h1>Gastos Comunidad</h1><br/>
            <tr>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Cantidad</th> 
                <th>Total a descontar</th>                               
            </tr>
        </thead>
        <tbody>
        <?php
          foreach($gastos as $gasto){ ?>
            <tr>
              <td><?php echo $movimiento['fecha'];?></td>
              <td><?php echo $movimiento['concepto'];?></td>
              <td><?php echo $movimiento['cantidad'];?></td>
              <td>           
              <form method="POST">
                <input type="hidden" name="fecha"  value="<?php echo $movimiento['fecha']; ?>">
                <input type="hidden" name="concepto" value="<?php echo $movimiento['concepto']; ?>">
                <input type="hidden" name="cantidad"  value="<?php echo $movimiento['cantidad']; ?>">                                
              </form>
              </td>
            </tr>     
        <?php } ?>         
        </tbody>
    </table>
</div>

<div class="col-md-7"> 
     <table class="table">
        <thead>
          <h1>Ingresos Comunidad</h1><br/>
            <tr>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Cantidad</th>                
            </tr>
        </thead>
        <tbody>
        <?php
          foreach($ingresos as $ingreso){ ?>
            <tr>
              <td><?php echo $movimiento['fecha'];?></td>
              <td><?php echo $movimiento['concepto'];?></td>
              <td><?php echo $movimiento['cantidad'];?></td>
              <td>           
              <form method="POST">
                <input type="hidden" name="fecha"  value="<?php echo $movimiento['fecha']; ?>">
                <input type="hidden" name="concepto" value="<?php echo $movimiento['concepto']; ?>">
                <input type="hidden" name="cantidad"  value="<?php echo $movimiento['cantidad']; ?>">                                
              </form>
              </td>
            </tr>     
        <?php } ?>         
        </tbody>
    </table>
</div>



<?php include("../template/pie.php"); ?>
</body>
</html>




