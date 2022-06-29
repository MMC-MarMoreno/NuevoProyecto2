<?php include("conexion.php");

function usuario_comprobar_datos($nombre, $password) {
    global $conexion;
    $sql = "SELECT * FROM usuarios WHERE nombre='$nombre' AND password='$password'";
    $resultado = mysqli_query($conexion, $sql);    
    if(mysqli_num_rows($resultado)==1)
        return true;
    else
        return false;
  }
  // https://www.w3schools.com/php/func_mysqli_fetch_assoc.asp
  function usuario_obtener($nombre) {
  global $conexion;
    $sql = "SELECT * FROM usuarios WHERE nombre='$nombre'";
    $resultado = mysqli_query($conexion, $sql);
    if(!$resultado) return null;
    return mysqli_fetch_assoc($resultado);
  }
  //function usuario_borrar($nombre) {
  //  global $db;
    //$sql = "DELETE FROM usuarios WHERE nombre='$nombre'";
   // $resultado = mysqli_query($db, $sql);
   // return $resultado;
  //} 
  function usuario_registro($nombre, $password,$email, $calle, $numero, $poblacion, $ciudad, $codigo_postal) {
    global $conexion;
    $sql = "INSERT INTO comunidades VALUES(NULL,'$calle', '$numero', '$poblacion', '$ciudad', $codigo_postal)";
    $resultado = mysqli_query($conexion, $sql);
    if(!$resultado) return false;

    $id_comunidad= mysqli_insert_id($conexion);
    $sql = "INSERT INTO usuarios VALUES(NULL,'$nombre', '$password', '$email', $id_comunidad )";
    $resultado = mysqli_query($conexion, $sql);
    if(!$resultado) return false;
  
    
  
    return true;        
  }
  class ControladorUsuario{
    public function login($usuario,$password){
        // obtenemos los datos del formulario vía post
  
       // echo "usuario:".$usuario ."<br>";
       //  echo "password:".$password ."<br>";  
        if(usuario_comprobar_datos($usuario, $password))
        {
            session_start();
            $_SESSION['usuario'] = usuario_obtener($usuario);
            header("location:../index.php");
        }
        else {
            http_response_code(401);
            // die('Contraseña incorrecta');
            header("<location:index.php");
        }
    }
    public function registro($nombre, $password,$email, $calle, $numero, $poblacion, $ciudad, $codigo_postal){
      usuario_registro($nombre, $password, $email, $calle, $numero, $poblacion, $ciudad, $codigo_postal);
      
    }
    public function logout(){
        session_start();
        session_destroy();    
        header("location:index.php"); // HTTP
    }
  }
  print_r($_POST);
  $controlador = new ControladorUsuario();
  if(isset($_POST['login'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $controlador->login($usuario,$password);
  }
  if (isset($_POST['registro'])){
    $controlador->registro($_POST['nombre'],$_POST['password'],$_POST['email'], $_POST['calle'],$_POST['numero'],$_POST['poblacion'],$_POST['ciudad'],$_POST['codigo_postal']);
    $controlador->login ($_POST['nombre'],$_POST['password']); 
  }
  if (isset($_POST['logout'])){
    $controlador->logout();
  }
?>