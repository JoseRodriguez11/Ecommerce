<?php 

include('server/connection.php');
session_start();

if(isset($_SESSION['inicio_sesion'])){
  header('location: cuenta.php');
  exit;
}

if(isset($_POST['login_btn'])){

  $correo = $_POST['correo'];
  $contrasena = md5($_POST['contrasena']);

  $stmt = $conn->prepare("SELECT usuario_id,usuario_nombre,usuario_correo,usuario_contrasena FROM usuario WHERE usuario_correo=? AND usuario_contrasena=? LIMIT 1");
  $stmt->bind_param('ss',$correo,$contrasena);
  
  if($stmt->execute()){

    $stmt->bind_result($usuario_id,$usuario_nombre,$usuario_correo,$usuario_contrsena);
    $stmt->store_result();
    if($stmt->num_rows() == 1){

      $stmt->fetch();

      $_SESSION['usuario_id'] = $usuario_id;
      $_SESSION['usuario_nombre'] = $usuario_nombre;
      $_SESSION['usuario_correo'] = $usuario_correo;
      $_SESSION['inicio_sesion'] = true;

      header('location: cuenta.php?login_exitoso=Bienvenido');


    }else{
      header('location: login.php?error= contraseña o correo incorrecto');
    }

  }else{

    header('location: login.php?error= Algo salio mal');

  }

}


?>






<?php include('layouts/header.php')?>

    <!--login-->

    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Inicio de Sesion</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container ">
            <form id="login-form" method="POST" action="login.php" >
                <p style="color:red" class="text-center" ><?php if (isset($_GET['error'])) { echo $_GET['error']; } ?></p>
                
                <div class="form-campos">
                    <label >Correo</label>
                    <input type="text" class="form-control " id="login-correo" name="correo" placeholder="Correo" required>
                </div>
                <div class="form-campos">
                    <label >Contraseña</label>
                    <input type="password" class="form-control " id="login-contrasena" name="contrasena" placeholder="Contraseña" required>
                </div>
                <div class="form-campos">
                    <input type="submit" class="btn " id="login-btn" name="login_btn"value="Ingresar">
                </div>
                <div class="form-campos">
                    <a id="registro-url" class="btn" href="registro.php">No tengo cuenta . Registrarme </a>
                </div>
            </form>

        </div>
    </section>

<?php include('layouts/footer.php')?>