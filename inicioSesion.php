<?php include("template/cabecera.php");?>



<h1>Iniciar sesión</h1>
<form class="registro" action="admin/configuracion/controlador.php" method="POST">
<div class="form-group">
    <label for="usuario">Usuario</label>
    <input type="text" name="usuario"></input>
</div>
<div class="form-group">
    <label for="password">Contraseña</label>    
    <input type="password" name="password"></input>
</div>
<div class="form-group">
     <button type="submit" class="btn btn-primary" name="login">Acceder</button>
</div>
</form>     


<div> 
   <br/> <h1>Registre su comunidad de vecinos</h1>
</div>    

<form class="usuario_registro" action="admin/configuracion/controlador.php" method="POST">
    <div class="form-group">
        <label for="calle">Calle/Avda/Plaza...</label>
        <input type="text" name="calle" class="form-control" id="calle">
    </div>

    <div class="form-group">
        <label for="numero">Número</label>
        <input type="number" name="numero" class="form-control" id="numero">
    </div>

    <div class="form-group">
        <label for="poblacion">Población</label>
        <input type="text" name="poblacion" class="form-control" id="poblacion">
    </div>

    <div class="form-group">
        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" class="form-control" id="ciudad">
    </div>

    <div class="form-group">
        <label for="codigoPostal">Código Postal</label>
        <input type="number"  name="codigo_postal" class="form-control" id="codigoPostal">
    </div>

    <div class="form-group">
        <label for="usuario">Usuario</label>
        <input type="text" name="nombre" class="form-control" id="usuario">
    </div>
    
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" id="email">
    </div> 
    
    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="password">Contraseña</label>
          <input type="password" name="password" class="form-control" id="password">
      </div>

    <div class="form-group">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck">
        <label class="form-check-label" for="gridCheck">
          Acepto condiciones de acceso
        </label>
      </div>
    </div>
    <br/>
    <button type="submit" class="btn btn-primary" name="registro">Alta Usuario</button>

    <h2><br/>Condicciones de Acceso</h2>
    <br/>
    <p>
        Los datos introducidos solo apareceran a la hora de imprimir los informes solicitados en la página.        
    </p>
    <p>
        No se va a utilizar ningún dato guardado para otros usos que no se allan indicado en la línea anterior.
    </p>

   
  
</form>



  <?php include("template/pie.php");?>

  

    
    


