
<?php 

session_start();
if(isset($_POST['agregar_al_carro'])){
  // se agrega un nuevo producto
  if(isset($_SESSION['carro'])){

    $productos_array_ids = array_column($_SESSION['carro'],"producto_id");
    //se verfica si el producto esta agregado o no 
    if( !in_array($_POST['producto_id'], $productos_array_ids)){

      $producto_id = $_POST['producto_id'];

      $producto_array = array(
        'producto_id' => $_POST['producto_id'],
        'producto_nombre' => $_POST['producto_nombre'],
        'producto_imagen' => $_POST['producto_imagen'],
        'producto_precio' => $_POST['producto_precio'],
        'producto_cantidad' => $_POST['producto_cantidad']
      );
  
      $_SESSION['carro'][$producto_id] = $producto_array;

      //el producto esta agregado
    }else{
      
      echo '<script>alert("El producto ya esta en tu carro de compras");</script>';
      
    }

    //se agrega el perimer producto 
  }else{

    $producto_id = $_POST['producto_id'];
    $producto_nombre = $_POST['producto_nombre'];
    $producto_imagen = $_POST['producto_imagen'];
    $producto_precio = $_POST['producto_precio'];
    $producto_cantidad = $_POST['producto_cantidad'];

    $producto_array = array(
      'producto_id' => $producto_id,
      'producto_nombre' => $producto_nombre,
      'producto_imagen' => $producto_imagen,
      'producto_precio' => $producto_precio,
      'producto_cantidad' => $producto_cantidad
    );

    $_SESSION['carro'][$producto_id] = $producto_array;
    
    
  }




  caculoToltalCarro(); //calculo total del precio de los productos






  // se boora un producto
}else if(isset($_POST['borrar_producto'])){

  $producto_id = $_POST['producto_id'];
  unset($_SESSION['carro'][$producto_id]);
  
  caculoToltalCarro(); //cacular precio total de los productos 

}else if( isset($_POST['editar_cantidad']) ){

  //se obtine la cantidad del producto del form
  $producto_id = $_POST['producto_id'];
  $producto_cantidad = $_POST['producto_cantidad'];

  //se obtine el producto del array desde la session
  $producto_array = $_SESSION['carro'][$producto_id];

  //se actualiza la cantidad 
  $producto_array['producto_cantidad'] = $producto_cantidad;

  //se guarda de nuevo en elarray con la nueeva cantidad 
  $_SESSION['carro'][$producto_id] = $producto_array;

  caculoToltalCarro(); // calcular precio total de los productos 

}else{
  //header('location: index.php');
}

function caculoToltalCarro(){
  $total =0;
  foreach($_SESSION['carro'] as $key => $value){
    $producto =$_SESSION['carro'][$key];

    $precio = $producto['producto_precio'];
    $cantidad = $producto['producto_cantidad'];

    $total += $precio * $cantidad;

  }
  $_SESSION['total'] = $total;
}

?>




<?php include('layouts/header.php')?>
  


    <!--carroCompras-->
    <section class="carroCompras container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Tu Carro De Compras</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5 ">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>subtotal</th>
            </tr>

            <?php foreach($_SESSION['carro'] as $key => $value){ ?>

            <tr>
                <td>
                    <div class="info-producto">
                        <img src="assets/imgs/<?php echo $value['producto_imagen']; ?>" >
                        <div>
                            <p><?php echo $value['producto_nombre']; ?></p>
                            <small><span>$</span><?php echo $value['producto_precio']; ?></small>
                            <br>
                            <form method="POST" action="carro.php">
                              <input type="hidden" name="producto_id" value="<?php echo $value['producto_id']; ?>"/>
                              <input type="submit" name="borrar_producto"  class="borrar-btn" value="borrar"/>
                            </form>
                            
                        </div>
                    </div>
                </td>
                <td>
                
                    <form method="POST" action="carro.php">
                      <input type="hidden" name="producto_id" value="<?php echo $value['producto_id']; ?>"/>
                      <input type="number"  name="producto_cantidad" value="<?php echo $value['producto_cantidad']; ?>" />
                      <input type="submit" class="editar-btn" value="editar" name="editar_cantidad">
                    </form>
                    
                </td>
                <td>
                    <span>$</span>
                    <span class="precio-producto"><?php echo $value['producto_precio'] * $value['producto_cantidad'];?></span>
                </td>
            </tr>

            <?php } ?>
        </table>
        
        <div class="carro-total">
            <table>
                <tr>
                    <td>Total</td>
                    <td>$ <?php echo $_SESSION['total']; ?></td>
                </tr>
            </table>
        </div>
        <div class="pagar-container">
              <form  method="POST" action="pago.php">
                <input type="submit" class="btn pagar-btn"  value="Realizar Compra"  name="pago">
              </form>
        </div>
    </section>


<?php include('layouts/footer.php')?>