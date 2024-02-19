<?php 

session_start();

include('server/connection.php');

if(isset($_SESSION['inicio_sesion'])){
  header('location: cuenta.php');
  exit;
}


if(isset($_POST['registrar'])){

  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $contrasena = $_POST['contrasena'];
  $confirmarContrasena = $_POST['confirmarContrasena'];

  //si las contraseñas no coinciden 
  if($contrasena !== $confirmarContrasena){
    header('location: registro.php?error=la contraseña no coincide');
  }
  //si la contraseña en menor a 6 caracteres 
  else if(strlen($contrasena)<6){
    header('location: registro.php?error=la contraseña debe tener mas de 6 caracteres');
  }

  // si los datos ingresados son adecuados 
  else{

    $stmt1 = $conn->prepare("SELECT count(*) FROM usuario WHERE usuario_correo=? ");
    $stmt1->bind_param('s',$correo);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    //si el usuario ya existe 
    if($num_rows != 0){
      header('location: registro.php?error=El usuario se encuentra registrado ');
    
    }else{
      // se crea nuevo usuario
      $stmt = $conn->prepare("INSERT INTO usuario (usuario_nombre,usuario_correo,usuario_contrasena)
      VALUES (?,?,?);");
      $stmt -> bind_param('sss',$nombre,$correo,md5($contrasena));

      //si la cuenta se creo correctamente
      if($stmt->execute()){
        $usuario_id = $stmt->insert_id;
        $_SESSION['usuario_id'] = $usuario_id;
        $_SESSION['usuario_correo'] = $correo;
        $_SESSION['usuario_nombre'] = $nombre;
        $_SESSION['inicio_sesion'] = true;
        header('location: cuenta.php?registro_exitoso= Registro Exitoso');

      }else{
        header('location: registro.php?error= NO se pudo crear una cuenta');
      }
    }
  }

}




?>






<?php include('layouts/header.php')?>

  <!--registro-->
  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Registro</h2>
      <hr class="mx-auto">
    </div>
    <div class="mx-auto container ">
      <form id="registro-form" method="POST" action="registro.php">
        <p style="color: red"><?php if(isset($_GET['error'])) { echo $_GET['error']; }  ?></p>
        <div class="form-campos">
          <label>Nombre</label>
          <input type="text" class="form-control " id="registro-Nombre" name="nombre" placeholder="Nombre" required>
        </div>
        <div class="form-campos">
          <label>Correo</label>
          <input type="text" class="form-control " id="registro-correo" name="correo" placeholder="Correo" required>
        </div>
        <div class="form-campos">
          <label>Contraseña</label>
          <input type="password" class="form-control " id="registro-contrasena" name="contrasena" placeholder="Contraseña"
            required>
        </div>
        <div class="form-campos">
          <label>Confirmar Contraseña</label>
          <input type="password" class="form-control " id="registro-confirmar-contrasena" name="confirmarContrasena"
            placeholder="Confirmar Contraseña" required>
        </div>
        <div class="form-campos">
          <input type="submit" class="btn " id="registro-btn" value="Registrar" name="registrar">
        </div>
        <div class="form-campos">
          <a id="login-url" class="btn" href="login.php">ya tengo una cuenta </a>
        </div>
      </form>

    </div>
  </section>

<?php include('layouts/footer.php')?>