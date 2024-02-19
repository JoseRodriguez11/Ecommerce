<?php 

session_start();

?>

<?php include('layouts/header.php')?>

    <!--formulario pago-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
          <h2 class="form-weight-bold">Pago</h2>
          <hr class="mx-auto">
        </div>
        <div class="mx-auto container text-center">
            <p><?php if (isset($_GET['pedido_estado'])) {echo $_GET['pedido_estado'];} ?></p>
            <p>Pago total: $ <?php if (isset($_SESSION['total'])) {echo $_SESSION['total'];} ?></p>
            
            <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
              <input type="submit" class="btn btn-primary" value="Pagar Ahora">
            <?php } ?>

            <?php if(isset($_SESSION['total']) && $_GET['pedido_estado'] == "Sin pagar") { ?>
              <input type="submit" class="btn btn-primary" value="Pagar Ahora">
            <?php } ?>
        </div>
      </section>


<?php include('layouts/footer.php')?>