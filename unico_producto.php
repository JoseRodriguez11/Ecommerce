<?php 

include('server/connection.php');

if(isset($_GET['producto_id'])){

    $producto_id = $_GET['producto_id'];

    $stmt =  $conn->prepare("SELECT * FROM productos WHERE producto_id = ? ");
    $stmt->bind_param("i",$producto_id);
    $stmt->execute();

    $producto = $stmt->get_result();


}else{
    header('location: index.php');
}
?>


<?php include('layouts/header.php')?>

    <!--vista de un producto-->
    <section class="container unico-producto my-5 pt-5">
        <div class="row mt-5">

        <?php while($row = $producto->fetch_assoc()){ ?>

        

            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row ['producto_imagen']; ?>" id="imagenPrincipal">
                <div class="galeria">
                    <div class="img-producto">
                        <img src="assets/imgs/<?php echo $row ['producto_imagen1']; ?> " width="100%" class="img-producto-small">
                    </div>
                    <div class="img-producto">
                        <img src="assets/imgs/<?php echo $row ['producto_imagen2']; ?> " width="100%" class="img-producto-small">
                    </div>
                    <div class="img-producto">
                        <img src="assets/imgs/<?php echo $row ['producto_imagen3']; ?>" width="100%" class="img-producto-small">
                    </div>
                </div>
            </div>

            

            <div class="col-lg-6 col-md-12 col-12">
                <h6 >Perfume/<?php echo $row ['producto_categoria']; ?></h6>
                <h3 class="py-4"><?php echo $row ['producto_nombre']; ?></h3>
                <h2>$<?php echo $row ['producto_precio']; ?></h2>

                <form method="POST" action="carro.php" >
                    <input type="hidden" name="producto_id" value="<?php echo $row ['producto_id']; ?>"/>
                    <input type="hidden" name="producto_imagen" value="<?php echo $row ['producto_imagen']; ?>"/>
                    <input type="hidden" name="producto_nombre" value="<?php echo $row ['producto_nombre']; ?>"/>
                    <input type="hidden" name="producto_precio" value="<?php echo $row ['producto_precio']; ?>"/>

                    <input type="number" name="producto_cantidad" value="1">
                    <button class="carro-btn" type="submit" name="agregar_al_carro">Agregar al Carro</button>
                </form>
               
                <h4 class="mt-5 mb-5">Detalles </h4>
                <span>
                    <?php echo $row ['producto_descripcion']; ?>
                </span>
            </div>
        
            <?php } ?>
        </div>
    </section>

    <!--productos relacionados-->
    <section id="productos-relacionado" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Productos Relacionados</h3>
            <hr class="mx-auto">
        </div>
        <div class="row mx-auto container-fluid">
            <div class="producto text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3 " src="assets/imgs/producto1.jpg" />
                <div class="calificacion">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-nombre">Nautica</h5>
                <h4 class="p-precio">$150.0</h4>
                <button class="comprar-btn">Comprar</button>
            </div>
            <div class="producto text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3 " src="assets/imgs/producto2.jpg" />
                <div class="calificacion">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-nombre">Bad Boy By Carolina Herrera</h5>
                <h4 class="p-precio">$150.0</h4>
                <button class="comprar-btn">Comprar</button>
            </div>
            <div class="producto text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3 " src="assets/imgs/producto3.jpg" />
                <div class="calificacion">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-nombre">Versace Dreamer</h5>
                <h4 class="p-precio">$150.0</h4>
                <button class="comprar-btn">Comprar</button>
            </div>
            <div class="producto text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3 " src="assets/imgs/producto4.jpg" />
                <div class="calificacion">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-nombre">Club de Nuit Intense</h5>
                <h4 class="p-precio">$150.0</h4>
                <button class="comprar-btn">Comprar</button>
            </div>
        </div>
    </section>

    <script>
        var imagenprincipal = document.getElementById("imagenPrincipal");
        var imagenseleccionada = document.getElementsByClassName("img-producto-small");

        for (let i = 0; i <= 3; i++) {
            imagenseleccionada[i].onclick = function () {
                imagenprincipal.src = imagenseleccionada[i].src;
            }
        }

    </script>
    
<?php include('layouts/footer.php')?>