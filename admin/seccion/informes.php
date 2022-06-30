<?php
ob_start();
session_start();
?>



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
<?php include("../configuracion/conexion.php");

$anio= $_GET['anio'] ?? date("Y");
echo 'anio'.$anio;
$id_comunidad =  $_SESSION['usuario']['id_comunidad'];
$sentenciaSQL= "select * from movimientos where id_comunidad = $id_comunidad and YEAR(fecha)=$anio" ;
echo $sentenciaSQL;
$stmt = mysqli_query($conexion, $sentenciaSQL);
$movimientos = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

// $sentencia2SQL= "SELECT `movimientos`.`tipo`, `movimientos`.`cantidad` FROM `movimientos` WHERE `movimientos`.`tipo` = 'Gasto'; id_comunidad = $id_comunidad";
// $stmt2 = mysqli_query($conexion, $sentencia2SQL);
// $gastos = mysqli_fetch_all($stmt2, MYSQLI_ASSOC);

// $sentencia3SQL= "SELECT `movimientos`.`tipo`, `movimientos`.`cantidad` FROM `movimientos` WHERE `movimientos`.`tipo` = 'Ingreso'; id_comunidad = $id_comunidad";
// $stmt3 = mysqli_query($conexion, $sentencia3SQL);
// $ingresos = mysqli_fetch_all($stmt2, MYSQLI_ASSOC);

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
            </tr>     
        <?php } ?>         
        </tbody>
    </table>
</div>




<div class="col-md-7"> 
     <table class="table">
        <thead>
          <h1>Ingreso anuales</h1><br/>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Concepto</th>
                <th>Cantidad</th> 

            </tr>
        </thead>
        <tbody>
        <?php
          $totalIngreso=0;
          foreach($movimientos as $movimiento){
            if($movimiento['tipo']=="Ingreso"){
            $totalIngreso += $movimiento['cantidad'];
          
            ?>
            <tr>
            <td><?php  echo $movimiento['fecha'];?></td>
              <td><?php  echo $movimiento['tipo'];?></td>
              <td><?php echo $movimiento['concepto'];?></td>
              <td><?php echo $movimiento['cantidad'];?></td>              
            </tr>     
        <?php }
        }
        ?> 
        <tr>
          <td colspan="3">Total Ingresos</td>
          <td><?php echo $totalIngreso; ?></td>
        </tr>        
        </tbody>
    </table>
</div>


<div class="col-md-7"> 
     <table class="table">
        <thead>
          <h1>Gastos</h1><br/>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Concepto</th>
                <th>Cantidad</th> 

            </tr>
        </thead>
        <tbody>
        <?php
          $totalGasto=0;
          foreach($movimientos as $movimiento){
            if($movimiento['tipo']=="Gasto"){
            $totalGasto += $movimiento['cantidad'];
          
            ?>
            <tr>
            <td><?php  echo $movimiento['fecha'];?></td>
              <td><?php  echo $movimiento['tipo'];?></td>
              <td><?php echo $movimiento['concepto'];?></td>
              <td><?php echo $movimiento['cantidad'];?></td>              
            </tr>     
        <?php }
        }
        ?> 
        <tr>
          <td colspan="3">Total Gastos</td>
          <td><?php echo $totalGasto; ?></td>
        </tr>        
        </tbody>
    </table>
</div>



<?php include("../template/pie.php"); ?>
</body>
</html>

<?php
$html=ob_get_clean();

require_once '../libreria/dompdf_2-0-0/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options); 

$dompdf->loadHtml("$html");
$dompdf->setPaper('letter');
//$dompdf->setPaper('A4', 'landscape');

$dompdf->render();
$dompdf->stream("resumen_.pdf", array("attachment" => true));
?>


