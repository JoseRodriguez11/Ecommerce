<?php 

include('server/connection.php');

if(isset($_POST['buscar'])){

  $categoria = $_POST['categoria'];
  $precio = $_POST['precio'];

  $stmt =  $conn->prepare("SELECT * FROM productos WHERE producto_categoria=? AND producto_precio<=?");

  $stmt-> bind_param('si',$categoria,$precio);
  $stmt->execute();
  
  $productos = $stmt->get_result();

}else{

  $stmt =  $conn->prepare("SELECT * FROM productos");

  $stmt->execute();
  
  $productos = $stmt->get_result();

}






?>










<?php include('layouts/header.php')?>
  <style>
    .productos img {
      width: 100%;
      height: auto;
      box-sizing: border-box;
      object-fit: cover;
    }

    .pagination a {
      color: black;
    }

    .pagination li:hover a {
      color: white;
      background-color: rgb(88, 124, 158);
    }
  </style>





  <div class="container">
    <div class="row">

      <!--clasificar producto-->
      <section id="search" class="my-5 py-5 col-lg-3 ">
        <div class="container mt-5 py-5">
          <h4>clasificar Productos</h4>
          <hr>
        </div>

        <form action="tienda.php " method="POST">
          <div class="row mx-auto container">
            <div class="col-lg-12 col-md-12 col-sm-12">

              <h4>Categoria</h4>
              <div class="form-check">
                <input class="form-check-input" value="hombre" type="radio" name="categoria" id="categoria_one">
                <label class="form-check-label" for="flexRadioDefault1">
                  hombre
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" value="mujer" type="radio" name="categoria" id="categoria_two" >
                <label class="form-check-label" for="flexRadioDefault2">
                  mujer
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" value="unixes" type="radio" name="categoria" id="categoria_two" >
                <label class="form-checklabel" for="flexRadioDefault2">
                  unixes
                </label>
              </div>

            </div>
          </div>


          <div class="row mx-auto container mt-5">
            <div class="col-lg-12 col-md-12 col-sm-12">

              <h4>Rango de Precio</h4>
              <input type="range" class="form-range w-50" name="precio" value="100" min="1" max="500" id="customRange2">
              <div class="w-50">
                <span style="float: left;">1</span>
                <span style="float: right;">500</span>

              </div>
            </div>

          </div>

          <div class="form-group my-3 mx-3">
            <input type="submit" name="buscar" value="buscar" class="btn btn-primary">
          </div>

        </form>

      </section>

      <!--productos-->
      <section id="productos" class="my-5 py-5 col-lg-9">
        <div class="container  mt-5 py-5">
          <h3>Nuestros Productos</h3>
          <hr>
          <p>Aqui puedes ver todos nuestro productos</p>
        </div>

        

        <div class="row mx-auto container ">
        <?php while($row = $productos->fetch_assoc()) { ?>
          <div onclick="window.location.href='<?php echo "unico_producto.php?producto_id=".$row['producto_id']; ?>';"
            class="producto text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3 " src="assets/imgs/<?php echo $row['producto_imagen']; ?>" />
            <div class="calificacion">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-nombre"><?php echo $row['producto_nombre']; ?></h5>
            <h4 class="p-precio">$<?php echo $row['producto_precio']; ?></h4>
            <a class="btn comprar-btn" href="<?php echo "unico_producto.php?producto_id=".$row['producto_id']; ?>">Comprar</a>
          </div>

          <?php } ?>
         

          <nav area-label="page navation page ">
            <ul class="pagination mt-5 ">
              <li class="page-item"><a class="page-link" href="#">previos</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
            </ul>
          </nav>
        </div>
      </section>

    </div>

  </div>

<?php include('layouts/footer.php')?>