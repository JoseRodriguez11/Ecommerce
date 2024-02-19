<?php 

session_start();

if( !empty($_SESSION['carro'])){


}else{
    header('location: carro.php');
}

?>

<?php include('layouts/header.php')?>

    <!--formulario pago-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
          <h2 class="form-weight-bold">Pago</h2>
          <hr class="mx-auto">
        </div>
        <div class="mx-auto container ">
          <form id="pago-form" method="POST" action="server/orden.php">

            <p class="text-center " style="color: red;">
              <?php if(isset($_GET['message'])) { echo $_GET['message'] ;} ?>
              <?php if(isset($_GET['message'])) { ?>

                <a class="btn btn-primary" href="login.php">Iniciar Sesion</a>

               <?php } ?>
            
            </p>

            <div class="form-campos pago-elementos-peque">
              <label>Nombre</label>
              <input type="text" class="form-control " id="pago-Nombre" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="form-campos pago-elementos-peque">
              <label>Correo</label>
              <input type="text" class="form-control " id="pago-correo" name="correo" placeholder="Correo" required>
            </div>
            <div class="form-campos pago-elementos-peque">
              <label>Celular</label>
              <input type="tel" class="form-control " id="pago-tel" name="celular" placeholder="Celular "
                required>
            </div>
            <div class="form-campos pago-elementos-peque">
              <label>Ciudad</label>
              <input type="text" class="form-control " id="pago_ciudad" name="ciudad"
                placeholder="Ciudad" required>
            </div>
            <div class="form-campos pago-elementos-larg">
                <label>Direccion</label>
                <input type="text" class="form-control " id="pago_direccion" name="direccion"
                  placeholder="Direccion" required>
              </div>
            <div class="form-campos pago-btn-container">
                <p>Cuenta total :$ <?php echo $_SESSION['total']; ?></p>
              <input type="submit" class="btn " id="pago-btn" name="realizar_pedido" value="Pedir">
            </div>

          </form>
    
        </div>
      </section>



<?php include('layouts/footer.php')?>