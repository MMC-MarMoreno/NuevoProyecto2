<?php include("../template/cabecera.php"); ?>
<?php include("../configuracion/conexion.php"); 

//SELECT `presupuestos`.*, `lineaspresu`.* FROM `presupuestos` 	LEFT JOIN `lineaspresu` ON `lineaspresu`.`id_presupuesto` = `presupuestos`.`id`;


 $accion=(isset($_POST['accion']))?$_POST['accion']:"";
 $concepto=(isset($_POST['concepto']))?$_POST['concepto']:"";
 $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
 $id_presu=(isset($_REQUEST['id_presu']))?$_REQUEST['id_presu']:"";
 $id_lineaPresu=(isset($_POST['id_lineaPresu']))?$_POST['id_lineaPresu']:"";
 

$error="";
    switch($accion){

        case "add":
          $stmt = mysqli_prepare ($conexion, "INSERT INTO lineasPresu (concepto,cantidad,id_presupuesto) VALUES (?, ?, ?);");
            mysqli_stmt_bind_param($stmt, 'sdi', $concepto, $cantidad, $id_presu); 
            try{ mysqli_stmt_execute($stmt);  } 
            catch(\Exception $ee)
            {
              $error= 'No se ha podido guardar la línea de presupesto'.$ee->getMessage();
            }
            
            break;

            
            case "borrar":
                  //die("borrando $id_movimiento");
                      $stmt = mysqli_prepare ($conexion, "DELETE FROM lineasPresu WHERE id=?");
                      mysqli_stmt_bind_param($stmt, 'i' , $id_lineaPresu);
                      mysqli_stmt_execute($stmt);
                      break;
        }
      //obtención de datos
      $sentenciaSQL= "SELECT * FROM `presupuestos` where id = $id_presu";
      $stmt = mysqli_query($conexion, $sentenciaSQL);
      $presupuesto = mysqli_fetch_assoc($stmt);

      $sentenciaSQL= "SELECT * FROM `lineasPresu` where id_presupuesto = $id_presu";
      $stmt = mysqli_query($conexion, $sentenciaSQL);
      $lineas = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        
   if ($error){
    
    
    ?>

    <p class='text-error'><?php echo $error;?></p>
    <?php
    }   
?>

<div class="col-md-3">
<div class="card">
<?php echo "Crear Presupuesto {$presupuesto['anio']}"; ?>
</div>
</div>


<div class="col-md-5">
<div class="card">
    <div class="card-header">
        Creación de Conceptos
    </div>
    <div class="card-body">
    <form method="POST">
      <div class="form-group">
        <input name="id_presu" id="id" type="hidden" value="<?php echo $id_presu; ?>">
      </div> 
      <div class="form-group">
        <input name="id_lineaPresu" id="id" type="hidden" value="<?php echo $id_lineaPresu; ?>">
      </div> 
      <div class="form-group">
        <label for="concepto">Introduce Concepto</label>
        <input name="concepto" id="concepto" type="int" value="<?php echo $concepto; ?>">
      </div>
      <div class="form-group">
        <label for="cantidad">Introduce la cantidad</label>
        <input name="cantidad" id="cantidad" type="decimal" value="<?php echo $cantidad; ?>">
      </div>         
          
      <div class="btn-group" role="group" aria-label="">
        <button type="submit" class="btn btn-success" name="accion" value="add">Añadir</button>
        <button type="submit" class="btn btn-info" name="accion" value="borrar">Borrar</button>
      </div>   
    </form> 
    </div>
    
</div>   
       
</div>
<br/>
<br/>
<div class="col-md-7"> 
  
    <table class="table">
        <thead>
            <tr>
                <th>Concepto</th>
                <th>Cantidad</th> 
                             
            </tr>
        </thead>
        <tbody>
        <?php
          foreach($lineas as $linea){ ?>
            <tr>
              <td><?php echo $linea['concepto'];?></td>
              <td><?php echo $linea['cantidad'];?></td>  
                          
              <td>           
              <form method="POST">
                <input type="hidden" name="id_presu"  value="<?php echo $linea['id_presupuesto']; ?>">
                <input type="hidden" name="id_lineaPresu"  value="<?php echo $linea['id']; ?>">
                <input type="hidden" name="concepto" value="<?php echo $linea['concepto']; ?>">   
                <input type="hidden" name="cantidad" value="<?php echo $linea['cantidad']; ?>">               
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