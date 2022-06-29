<?php include("../template/cabecera.php"); ?>
<?php include("../configuracion/conexion.php"); 

//SELECT `presupuestos`.*, `lineaspresu`.* FROM `presupuestos` 	LEFT JOIN `lineaspresu` ON `lineaspresu`.`id_presupuesto` = `presupuestos`.`id`;


 $id_comunidad =  $_SESSION['usuario']['id_comunidad'];
 $saldoAnioAnterior=(isset($_POST['saldoAnioAnterior']))?$_POST['saldoAnioAnterior']:"";
 $concepto=(isset($_POST['concepto']))?$_POST['concepto']:"";
 $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
 $importeTotal=(isset($_POST['importeTotal']))?$_POST['importeTotal']:"";
 $accion=(isset($_POST['accion']))?$_POST['accion']:"";


    
      //obtención de datos
      $sentenciaSQL= "SELECT `presupuestos`.`anio`, `presupuestos`.`saldoAnioAnterior`, `lineaspresu`.`concepto`, `lineaspresu`.`cantidad`, `presupuestos`.`importeTotal`  
      FROM `presupuestos` LEFT JOIN `lineaspresu` ON `lineaspresu`.`id_presupuesto` = `presupuestos`.`id`; where id_comunidad = $id_comunidad";
      $stmt = mysqli_query($conexion, $sentenciaSQL);
      $presupuestos = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

      
?>


<div class="col-md-5">
<div class="card">
    <div class="card-header">
        Creación de Presupuestos
    </div>
    <div class="card-body">
    <form method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <input name="id_presu" id="id" type="hidden" value="<?php echo $id_presu; ?>" readonly>
      </div> 
      <div class="form-group">
        <label for="fecha">Introduce Año</label>
        <input name="anio" id="anio" type="int" value="<?php echo $anio; ?>">
      </div>
      <div class="form-group">
        <label for="fecha">Introduce Saldo Ejercicio Anterior</label>
        <input name="saldoAnioAnterior" id="saldoAnioAnterior" type="decimal" value="<?php echo $saldoAnioAnterior; ?>">
      </div>    
      <div class="form-group">
        <label for="concepto">Concepto </label>
        <input name="concepto" type="text" value="<?php echo $concepto; ?>">
      </div>      
      <div class="form-group">
        <label for="cantidad">Cantidad €</label>
        <input name="cantidad" type="decimal" value="<?php echo $cantidad; ?>">
      </div>
      <div class="form-group">
        <input name="importeTotal" id="importeTotal" type="hidden" value="<?php echo $importeTotal; ?>" readonly>
      </div>       
      <div class="btn-group" role="group" aria-label="">
        <button type="submit" class="btn btn-success" name="accion" value="add">Añadir</button>
        <button type="submit" class="btn btn-warning" name="accion" value="modificar">Modificar</button>
        <button type="submit" class="btn btn-info" name="accion" value="borrar">Borrar</button>
      </div>   
    </form> 
    </div>
    
</div>


    
       
</div>
<div class="col-md-7"> 
  <a href="imprimirPresu.php">Informe PDF</a>
    <table class="table">
        <thead>
            <tr>
                <th>Ejercicio Año</th>
                <th>Saldo Año anterior</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Importe Total</th>
            </tr>
        </thead>
        <tbody>
        <?php
          foreach($presupuestos as $presupuesto){ ?>
            <tr>
              <td><?php echo $presupuesto['anio'];?></td>
              <td><?php echo $presupuesto['saldoAnioAnterior'];?></td>
              <td><?php echo $presupuesto['concepto'];?></td>
              <td><?php echo $presupuesto['cantidad'];?></td>
              <td><?php echo $presupuesto['importeTotal'];?></td>
              <td>           
              <form method="POST">
                <input type="hidden" name="id_presu" value="<?php echo $presupuesto['id']; ?>">
                <input type="hidden" name="anio"  value="<?php echo $presupuesto['anio']; ?>">
                <input type="hidden" name="saldoAnioAnterior" value="<?php echo $saldoAnioAnterior['tipo']; ?>">
                <input type="hidden" name="concepto" value="<?php echo $presupuesto['concepto']; ?>">
                <input type="hidden" name="cantidad"  value="<?php echo $presupuesto['cantidad']; ?>">
                <input type="hidden" name="$importeTotal"  value="<?php echo $presupuesto['importeTotal']; ?>">
                <input type="submit" name="accion" value="seleccionar" class="btn btn-primary"/>                
              </form>
              </td>
            </tr>     
        <?php } ?>         
        </tbody>
    </table>
</div>



    ?>

<?php include("../template/pie.php"); ?>