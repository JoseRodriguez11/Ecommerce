<?php

session_start();
include('server/connection.php');

if(!isset($_SESSION['inicio_sesion'])){
    header('location: login.php');
}
if(isset($_GET['inicio_sesion'])){
    if(isset($_SESSION['inicio_sesion'])){
        unset($_SESSION['inicio_sesion']);
        unset($_SESSION['usuario_correo']);
        unset($_SESSION['usuario_nombre']);
        header('location: login.php');
        exit;

    }
}

if(isset($_POST['cambiar_contrasena_btn'])){
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    $usuario_correo = $_SESSION['usuario_correo'];

    if($contrasena !== $confirmar_contrasena){
        header('location: cuenta.php?error=la contraseña no coincide');
    }
      //si la contraseña en menor a 6 caracteres 
    else if(strlen($contrasena)<6){
        header('location: cuenta.php?error=la contraseña debe tener mas de 6 caracteres');
    }

    else{
        $stmt = $conn -> prepare("UPDATE usuario SET usuario_contrasena=? WHERE usuario_correo=?");
        $stmt->bind_param('ss',md5($contrasena),$usuario_correo);

        if($stmt->execute()){
            header('location: cuenta.php?message= La Contraseña se cambio correctamente');
        }else{
            header('location: cuenta.php?message= La Contraseña No se pudo cambiar');
        }
    }


}


// obtener ordenes
if(isset($_SESSION['inicio_sesion'])){
        $usuario_id = $_SESSION['usuario_id'];
        $stmt =  $conn->prepare("SELECT * FROM pedidos WHERE usuario_id=?");
        $stmt -> bind_param('i',$usuario_id );

        $stmt->execute();

        $presentacion_productos = $stmt->get_result();


}

?>







<?php include('layouts/header.php')?>


    <!--cuenta-->
    <section class="my-5 py-5">
        <div class=" row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            
            <p class="text-center " style="color: green" ><?php if(isset($_GET['registro_exitoso'])) { echo $_GET['registro_exitoso'] ; } ?></p>
            <p class="text-center " style="color: green" ><?php if(isset($_GET['login_exitoso'])) { echo $_GET['login_exitoso'] ; } ?></p>
                <h3 class="font-weight-bolde">Informacion Sobre La Cuenta</h3>
                <hr class="mx-auto">
                <div class="info-cuenta">
                    <p>Name <span><?php if(isset($_SESSION['usuario_nombre'])) { echo $_SESSION['usuario_nombre']; }?></span></p>
                    <p>Correo <span><?php if (isset($_SESSION['usuario_correo'])) { echo $_SESSION['usuario_correo']; } ?></span></p>
                    <p><a href="#pedidos" id="pedidos-btn">Tus Pedidos</a></p>
                    <p><a href="cuenta.php?inicio_sesion=1" id="salir-btn">Salir</a></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 ">
                <form id="form-cuenta" method="POST" action="cuenta.php">
                    <p class="text-center " style="color: red" ><?php if(isset($_GET['error'])) { echo $_GET['error'] ; } ?></p>
                    <p class="text-center " style="color: green" ><?php if(isset($_GET['message'])) { echo $_GET['message'] ; } ?></p>
                    <h3>Cambiar contraseña</h3>
                    <hr class="mx-auto">
                    <div class="form-campos">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" id="confirmar-contrasena-cuenta" name="contrasena"
                            placeholder="Contraseña">
                    </div>
                    <div class="form-campos">
                        <label>Confirme Contraseña</label>
                        <input type="password" class="form-control" id="confirmar-contrasena-cuenta"
                            name="confirmar_contrasena" placeholder="Confirmar Contraseña">
                    </div>
                    <div class="form-campos">
                        <input type="submit" value="Cambiar contraseña" class="btn" id="cambiar-contrasena-btn" name="cambiar_contrasena_btn">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!--pedidos-->
    <section  id="pedidos" class="pedidos container my-5 py-3">
        <div class="container mt-2">
            <h2 class="font-weight-bolde text-center">Tus Pedidos</h2>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5 ">
            <tr>
                <th>Producto id</th>
                <th>Costo</th>
                <th>Estado Producto</th>
                <th>Fecha</th>
                <th>Detalles</th>
            </tr>
            
            
            <?php  while($row =  $presentacion_productos->fetch_assoc() ){ ?>

                    <tr>
                        <td>
                            <span><?php echo $row['pedido_id']; ?></span>
                             
                        </td>
                        <td>
                            <span><?php echo $row['pedido_costo']; ?></span>
                        </td>
                        <td>
                            <span><?php echo $row['pedido_estado']; ?></span>
                        </td>
                        <td>
                            <span><?php echo $row['pedido_fecha']; ?></span>
                        </td>
                        <td>
                            <form method="POST" action="detalles_pedido.php" >
                                <input type="hidden" value="<?php  echo $row['pedido_estado']; ?> " name="pedido_estado">
                                <input type="hidden" value="<?php  echo $row['pedido_id']; ?> " name="pedido_id">
                                <input class="btn detalles-pedido-btn" type="submit" value="Detalles" name="detalles_pedido_btn">
                            </form>
                        </td>
                
                    </tr>

            <?php } ?>



            
        </table>

    </section>

<?php include('layouts/footer.php')?>