<?php include("../template/cabecera.php"); ?>
<?php include("../configuracion/conexion.php"); ?>
<?php include("../configuracion/adjuntos.php"); ?>

<?php
 print_r($_FILES);
 $id_comunidad =  $_SESSION['usuario']['id_comunidad'];
 $id_movimiento=(isset($_POST['id_movimiento']))?$_POST['id_movimiento']:"";
 $tipo=(isset($_POST['tipo']))?$_POST['tipo']:"";        
 $fecha=(isset($_POST['fecha']))?$_POST['fecha']:"";       
 $concepto=(isset($_POST['concepto']))?$_POST['concepto']:"";
 $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
 if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_FILES['adjunto'])){
      $adjunto= $_FILES['adjunto']['size'] != 0 ? adjuntar_archivo("adjunto"): "";
    }else{
      $adjunto=(isset($_POST['adjunto']))?$_POST['adjunto']:"";
    }
   
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";


    switch($accion){

        case "add":
          if (strcmp($adjunto,"") !=0){
            $stmt = mysqli_prepare ($conexion, "INSERT INTO movimientos (tipo,fecha,concepto,cantidad,adjunto,id_comunidad) VALUES (?, ?, ?, ?, ?, ?);");
            mysqli_stmt_bind_param($stmt, 'sssdsi', $tipo, $fecha, $concepto, $cantidad, $adjunto, $id_comunidad ); 
          }else{
            $stmt = mysqli_prepare ($conexion, "INSERT INTO movimientos (tipo,fecha,concepto,cantidad,id_comunidad) VALUES (?, ?, ?, ?, ?);");
            mysqli_stmt_bind_param($stmt, 'sssdi', $tipo, $fecha, $concepto, $cantidad, $id_comunidad ); 
          }
            mysqli_stmt_execute($stmt);          
            break;

        case "modificar":
          if (strcmp($adjunto,"") !=0){
            $stmt = mysqli_prepare ($conexion, "UPDATE movimientos SET tipo = ?, fecha = ?, concepto = ?, cantidad= ?, adjunto=? WHERE id=?");
            
            mysqli_stmt_bind_param($stmt, 'sssdsi', $tipo, $fecha, $concepto, $cantidad, $adjunto, $id_movimiento );
          }
          else{
            $stmt = mysqli_prepare ($conexion, "UPDATE movimientos SET tipo = ?, fecha = ?, concepto = ?, cantidad= ? WHERE id=?");
            
            mysqli_stmt_bind_param($stmt, 'sssdi', $tipo, $fecha, $concepto, $cantidad, $id_movimiento );
          }  
            
            mysqli_stmt_execute($stmt);

         
        
            break;
        case "cancelar":
             
              break;
       

        case "borrar":
          //die("borrando $id_movimiento");
              $stmt = mysqli_prepare ($conexion, "DELETE FROM movimientos WHERE id=?");
              mysqli_stmt_bind_param($stmt, 'i' , $id_movimiento);
              mysqli_stmt_execute($stmt);
              break;
    }
  }
      //seleccionar:
      $sentenciaSQL= "select * from movimientos where id_comunidad = $id_comunidad";
      $stmt = mysqli_query($conexion, $sentenciaSQL);
      $movimientos = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

      
?>




<div class="col-md-5">

<div class="card">
    <div class="card-header">
        Movimientos Económicos
    </div>
    <div class="card-body">
    <form method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <input name="id_movimiento" id="id" type="hidden" value="<?php echo $id_movimiento; ?>" readonly>
      </div> 
      <div class="form-group">
        <label for="fecha">Fecha Movimiento</label>
        <input name="fecha" id="fecha" type="fetch" value="<?php echo $fecha; ?>">
      </div>  
      Tipo de Movimiento: <br/> 
      <div class="form-check" >
        <input class="form-check-input" name="tipo" id="tipo" type="radio"  value="ingreso" <?php if($tipo=="Ingreso") echo "checked"; ?>>
        <label for="tipo">Ingreso</label> <br/>
        <input class="form-check-input" name="tipo" id="tipo" type="radio" value="gasto" <?php if($tipo=="Gasto") echo "checked"; ?>>
        <label for="tipo">Gasto</label>
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
        <label for="adjunto">Adjuntar Recibo/Factura</label>
        
        <input name="nombre_fichero" type="hidden" value="<?php echo $adjunto; ?>">
        <input name="adjunto" type="file" value="<?php echo $adjunto; ?>">
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
  <a href="informes.php">Informe PDF</a>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>TipoMovimiento</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Accion</th>
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
                <input type="hidden" name="id_movimiento" value="<?php echo $movimiento['id']; ?>">
                <input type="hidden" name="fecha"  value="<?php echo $movimiento['fecha']; ?>">
                <input type="hidden" name="tipo" value="<?php echo $movimiento['tipo']; ?>">
                <input type="hidden" name="concepto" value="<?php echo $movimiento['concepto']; ?>">
                <input type="hidden" name="cantidad"  value="<?php echo $movimiento['cantidad']; ?>">
                <input type="hidden" name="$adjunto"  value="<?php echo $movimiento['adjunto']; ?>">
                <input type="submit" name="accion" value="seleccionar" class="btn btn-primary"/>                
              </form>
              </td>
            </tr>     
        <?php } ?>         
        </tbody>
    </table>
</div>


<?php include("../template/pie.php"); ?>