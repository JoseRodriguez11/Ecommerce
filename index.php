

<?php include('layouts/header.php')?>


  <!--inicio-->
  <section id="inicio">
    <div class="container">
      <span>
        <h5>NUEVOS PRODUCTOS</h5>
        <h1> Mejores Precios </h1>
        <p>Ofrecemos los mejores productos al mejor precio del mercado.</p>
      </span>
      <button>Comprar Ahora</button>
    </div>
  </section>

  <!--categoria -->
  <section class="my-1 py-1 col-lg-12  container  ">
    <div class="container text-center mt-5 py-5">
        <h3>CATEGORIAS</h3>
        <hr class="mx-auto">
    </div>

    <div class="galeria mt-3 py-3 ">
      <article class="card" >
          <figure>
              <img src="assets/imgs/foto_hombre.jpg" alt="Hombre" >
              <figcaption>
                <h3>Hombre</h3>
              </figcaption>
          </figure>
        </article>
        <article class="card">
          <figure>
              <img src="assets/imgs/foto_mujer.jpg"  alt="mujer" >
              <figcaption>
                <h3>Mujer</h3>
              </figcaption>
          </figure>

        </article>
        <article class="card">
          <figure>
              <img src="assets/imgs/foto_unixes.jpg"  alt="Unixes"  >
              <figcaption>
                <h3>Unixes</h3>
              </figcaption>
          </figure>
        </article>
    </div>
  </section>

  <!--nuevo-->
  <section id="nuevo" class="w-100">
    <div class="container text-center mt-5 py-5">
        <h3>PRODUCTOS NUEVOS</h3>
        <hr class="mx-auto">
        
     </div>
    <div class="row p-0 m-0">
      <!--uno-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/1.png" />
        <div class="detalles">
          <h2>Eros Parfum 100 ml</h2>
          <button class="text-uppercase">comprar</button>
        </div>
      </div>

      <!--dos-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/2.jpg" />
        <div class="detalles">
          <h2>Acqua Di Gio 125 ml</h2>
          <button class="text-uppercase">comprar</button>
        </div>
      </div>
      <!--tres-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/imgs/3.jpg" />
        <div class="detalles">
          <h2>Mochino Toy Boy 100 ml </h2>
          <button class="text-uppercase">comprar</button>
        </div>
      </div>
    </div>
  </section>



  <!--productosMasComunes-->
  <section id="productos" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>PRODUCTOS CON DESCUENTO</h3>
      <hr class="mx-auto">
      <p>Aprovecha y compra tu perfume favorito al mejor precio </p>
    </div>
    <div class="row mx-auto container-fluid">
    
    <?php include('server/get_presentacion_productos.php'); ?>

    <?php while($row = $presentacion_productos->fetch_assoc()){ ?>

      <div class="producto text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3 " src="assets/imgs/<?php echo $row['producto_imagen'];?>" />
        <div class="calificacion">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-nombre"><?php echo $row['producto_nombre'];?></h5>
        <h4 class="p-precio">$ <?php echo $row['producto_precio'];?></h4>
        <a href="<?php echo "unico_producto.php?producto_id=". $row['producto_id']; ?>"><button class="comprar-btn">Comprar</button></a>
      </div>

      <?php } ?>

      </div>
    </div>
  </section>

  <!--Banner-->
  <section id="banner" class="my-5 py-5">
    <div class="container">
      <h4>DESCUENTOS</h4>
      <h1>Aprovecha hasta un <br>20% de descuento <br> en algunos productos</h1>
      <button class="text-uppercase" >comprar ahora</button>
    </div>
  </section>

  
  <?php include('layouts/footer.php')?>