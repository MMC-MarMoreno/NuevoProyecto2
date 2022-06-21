<?php
if($_POST){
    header('Location:inicio.php');
}
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
  <div class="container">
      <div class="row">
          <div class="col-md-4">              
          </div>

          <div class="col-md-4">
              <br/><br/>
              <div class="card">
                  <div class="card-header">
                      Accede a tu Comunidad
                  </div>
                  <div class="card-body">
                      <form method="POST">
                      <div class = "form-group">
                      <label>Correo Electrónico</label>
                      <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Añade tu email">
                      </div>
                      <div class="form-group">
                      <label>Contraseña</label>
                      <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Añade tu contraseña">
                      </div>
                      <button type="submit" class="btn btn-primary">Acceder</button>
                      </form>
                      
                      
                  </div>
                  
                </div>
              
            </div>          
      </div>
  </div> 


  </body>
</html>