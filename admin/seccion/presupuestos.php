<?php include("../template/cabecera.php"); ?>
<?php include("../configuracion/conexion.php"); 

//SELECT `presupuestos`.*, `lineaspresu`.* FROM `presupuestos` 	LEFT JOIN `lineaspresu` ON `lineaspresu`.`id_presupuesto` = `presupuestos`.`id`;


 $id_comunidad =  $_SESSION['usuario']['id_comunidad'];
 $saldoAnioAnterior=(isset($_POST['saldoAnioAnterior']))?$_POST['saldoAnioAnterior']:"";
 $anio=(isset($_POST['anio']))?$_POST['anio']:"";
 $importeTotal=(isset($_POST['importeTotal']))?$_POST['importeTotal']:"";
 $accion=(isset($_POST['accion']))?$_POST['accion']:"";
 $id_presu=(isset($_POST['id_presu']))?$_POST['id_presu']:"";
 

$error="";
    switch($accion){

        case "add":
          $stmt = mysqli_prepare ($conexion, "INSERT INTO presupuestos (saldoAnioAnterior,anio,importeTotal,id_comunidad) VALUES (?, ?, ?, ?);");
            mysqli_stmt_bind_param($stmt, 'didi', $saldoAnioAnterior, $anio, $importeTotal, $id_comunidad ); 
            try{ mysqli_stmt_execute($stmt);  } 
            catch(\Exception $ee)
            {
              $error= 'No se ha podido guardar el presupuesto';
            }
            
            break;

            case "modificar":
             
                $stmt = mysqli_prepare ($conexion, "UPDATE presupuestos SET saldoAnioAnterior = ? WHERE id=?");
                
                mysqli_stmt_bind_param($stmt, 'di', $saldoAnioAnterior, $id_comunidad );             
                
                mysqli_stmt_execute($stmt);
                break;

            case "borrar":
                  //die("borrando $id_movimiento");
                      $stmt = mysqli_prepare ($conexion, "DELETE FROM presupuestos WHERE id=?");
                      mysqli_stmt_bind_param($stmt, 'i' , $id_presu);
                      mysqli_stmt_execute($stmt);
                      break;
            case "ver":
              header("location:lineasPresu.php?id_presu=$id_presu");
              exit;

           
        }
      //obtención de datos
      $sentenciaSQL= "SELECT * FROM `presupuestos` where id_comunidad = $id_comunidad";
      $stmt = mysqli_query($conexion, $sentenciaSQL);
      $presupuestos = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        
   if ($error){
    
    
    ?>

    <p class='text-error'><?php echo $error;?></p>
    <?php
    }   
?>


<div class="col-md-5">
<div class="card">
    <div class="card-header">
        Creación de Presupuestos
    </div>
    <div class="card-body">
    <form method="POST">
      <div class="form-group">
        <input name="id_presu" id="id" type="hidden" value="<?php echo $id_presu; ?>">
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
                <th>Saldo Actual</th>               
            </tr>
        </thead>
        <tbody>
        <?php
          foreach($presupuestos as $presupuesto){ ?>
            <tr>
              <td><?php echo $presupuesto['anio'];?></td>
              <td><?php echo $presupuesto['saldoAnioAnterior'];?></td>  
              <td><?php echo $presupuesto['importeTotal'];?></td>             
              <td>           
              <form method="POST">
                <input type="hidden" name="id_presu"  value="<?php echo $presupuesto['id']; ?>">
                <input type="hidden" name="anio"  value="<?php echo $presupuesto['anio']; ?>">
                <input type="hidden" name="saldoAnioAnterior" value="<?php echo $presupuesto['saldoAnioAnterior']; ?>">   
                <input type="hidden" name="importeTotal" value="<?php echo $presupuesto['importeTotal']; ?>">               
                <input type="submit" name="accion" value="seleccionar" class="btn btn-primary"/> 
                <input type="submit" name="accion" value="ver" class="btn btn-secondary"/>                
              </form>
              </td>
            </tr>     
        <?php } ?>         
        </tbody>
    </table>
</div>



    ?>

<?php include("../template/pie.php"); ?>