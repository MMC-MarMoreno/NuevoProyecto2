<?php include("../template/cabecera.php"); ?>


<?php
    include("../configuracion/conexion.php");
    //$id = $_SESSION['usuario']['id_comunidad'];
    $tipo=(isset($_POST['tipo']))?$_POST['tipo']:"";    
    $fecha=(isset($_POST['fecha']))?$_POST['fecha']:"";    
    $concepto=(isset($_POST['concepto']))?$_POST['concepto']:"";
    $cantidad=(isset($_POST['cantidad']))?$_POST['cantidad']:"";
    $adjunto=(isset($FILES['adjunto']['name']))?$FILES['archivo']['name']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";


    switch($accion){

        case "add":
            //INSERT INTO `movimientos` (`id`, `tipo`, `fecha`, `concepto`, `cantidad`, `adjunto`, `id_comunidad`)
            $sentenciaSQL= $conexion->prepare("INSERT INTO movimientos (fecha,tipo,concepto,cantidad,adjunto,id_comunidad) VALUES ('$fecha', '$tipo', '$concepto', '$cantidad', '$adjunto', $id);");
            //$sentenciaSQL->bind_param(':tipo',$tipo);
            //$sentenciaSQL->bind_param(':fecha',$fecha);
            //$sentenciaSQL->bind_param(':concepto',$concepto);
            //$sentenciaSQL->bind_param(':cantidad',$cantidad);
            //$sentenciaSQL->bind_param(':adjunto',$adjunto);
            $sentenciaSQL->execute();           
            break;

        case "modificar":
            echo "Pulsado botón modificar";
            break;
        case "borrar":
            echo "Pulsado botón borrar";
            break;
    }

    function buscar_movimientos($id){
      $sentenciaSQL= $conexion->prepare("select * from movimientos where id_comunidad = $id");
      $sentenciaSQL->execute();
      $resultado = mysqli_query($conexion, $sentenciaSQL);
      if(!$resultado) return null;
      return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
  }

?>

<div class="col-md-5">

<div class="card">
    <div class="card-header">
        Movimientos Económicos
    </div>
    <div class="card-body">
    <form method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label>Fecha Movimiento</label>
        <input name="fecha" id="fecha" type="fetch">
      </div>  
      Tipo de Movimiento: <br/> 
      <div class="form-check" >
        <input class="form-check-input" name="tipo" id="tipo" type="radio"  value="ingreso">
        <label>Ingreso</label> <br/>
        <input class="form-check-input" name="tipo" id="tipo" type="radio" value="gasto">
        <label>Gasto</label>
      </div>      
      <div class="form-group">
        <label id="concepto">Concepto </label>
        <input name="concepto" type="text">
      </div>      
      <div class="form-group">
        <label id="cantidad">Cantidad €</label>
        <input name="cantidad" type="decimal">
      </div>  
      <div class="form-group">
        <label id="adjunto">Adjuntar Recibo/Factura</label>
        <input name="adjunto" type="file">
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
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
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
                
              Seleccionar | Borrar

              <form method="$_POST">
                <input type="text" name="accion" id="accion" value="<?php echo $movimiento['id']; ?>">

                <input type="button" value="submit" name="accion" value="borrar" class="btn btn-danger"/>


              </form>


              </td>


            </tr>     
        <?php } ?>         
        </tbody>
    </table>
</div>


<?php include("../template/pie.php"); ?>