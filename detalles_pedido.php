<?php 
include('server/connection.php');

if(isset($_POST['detalles_pedido_btn']) && isset($_POST['pedido_id'])){

    $pedido_id = $_POST['pedido_id'];
    $pedido_estado = $_POST['pedido_estado'];
    
    

    $stmt = $conn->prepare("SELECT *FROM pedido_items WHERE pedido_id = ? ");

    $stmt->bind_param('i',$pedido_id);

    $stmt->execute();

    $detalles_pedido = $stmt->get_result();

}else{

    header('location: cuenta.php');
    exit;

}




?>








<?php include('layouts/header.php')?>


    <!--detalles pedidos-->
    <section  id="pedidos" class="pedidos container my-5 py-3">
        <div class="container mt-5">
            <h2 class="font-weight-bolde text-center">Detalles Pedidos</h2>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5 mx-auto ">
            <tr>
                <th>producto</th>
                <th>Precio</th>
                <th>Cantidad</th>

            </tr>

            <?php while($row = $detalles_pedido -> fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <div class="informacion-producto">
                                <img src="assets/imgs/<?php echo $row['producto_imagen']; ?>" >
                                <div>
                                    <p class="mt-3"><?php echo $row['producto_nombre']; ?></p>
                                </div>

                            </div>
                        </td>

                        <td>
                            <span>$<?php echo $row['producto_precio']?></span>
                        </td>
                        <td>
                            <span><?php echo $row['producto_cantidad']?></span>
                            
                        </td>
                
                    </tr>

            <?php } ?>


            
            
        </table>
        
      
        <?php if(trim($pedido_estado) == "Sin pagar") { ?>

            <form style="float: right;" method="POST" action="informacion_pago.php" >
                <input  type="submit" class="btn btn-primary" value="Pagar Ahora"/>
                
            </form>
            
        <?php } ?>


    </section>

<?php include('layouts/footer.php')?>