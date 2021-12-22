<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

    <div class="container">
        <div class="alert alert-success">
            pantalla de mensaje...
            <!-- <?php print_r($_POST); ?> -->
            <?php echo $mensaje; ?>
            <a href="#" class="badge badge-success">Ver Carrto</a>
        </div>
        <div class="row">
            <?php
            $sentencia=$pdo->prepare("SELECT * FROM `productos`");
            $sentencia->execute();
            $listaProdcutos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            // print_r($listaProdcutos);
            ?>
            <?php foreach($listaProdcutos as $productos){?>
                <div class="col-md-3">
                    <img title="<?php echo $productos['nombre'];?>" alt="<?php echo $productos['nombre'];?>" class="card-img-top" src="<?php echo $productos['imagen'];?>" data-toggle="popover" data-trigger="hover" data-content="<?php echo $productos['descripcion'];?>" height="371px">
                    <div class="card-body">
                        <span><?php echo $productos['nombre'];?></span>
                        <h5 class="card-title"><?php echo $productos['precio'];?></h5>
                        <p class="card-text">
                            contenidos
                        </p>
                        <form action="" method="POST" >
                            <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($productos['id'],cod,key);?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($productos['nombre'],cod,key);?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($productos['precio'],cod,key);?>">
                            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,cod,key);?>">
                            <button class="btn btn-primary" type="submit" name="btnAccion" value="Agregar">Agregar al carrito</button>
                        </form>
                       
                    </div>
                </div>
           <?php } ?>
        </div>
    </div>
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
            })
    </script>
<?php
include 'templates/pie.php';
?>
