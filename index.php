<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Tienda</title>
    <link rel="icon" type="image/png" href="img/favicon.jpg">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- bootstrap  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<!-- barra de navegacion -->
<section class="container-fluid bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="d-flex flex-grow-1">
                    <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
                    <a class="navbar-brand d-none d-lg-inline-block fuente" href="index.html" style="color: white; font-size: 2em;">
                        Tienda
                    </a>
                    <a class="navbar-brand-two mx-auto d-lg-none d-inline-block fuente" href="index.html" style="color: white; font-size: 2em;">
                        Tienda
                    </a>
                    <div class="w-100 text-right">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="collapse navbar-collapse flex-grow-1 text-right" id="myNavbar">
                    <ul class="navbar-nav ml-auto flex-nowrap">
                        <li class="nav-item">
                            <a href="index.html" class="nav-link text-white m-2 menu-item nav-active">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white m-2 menu-item">Carrito</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>
    <!-- barra de navegacion -->
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
                    <img class="card-img-top" src="<?php echo $productos['imagen'];?>" alt="">
                    <div class="card-body">
                        <span><?php echo $productos['nombre'];?></span>
                        <h5 class="card-title"><?php echo $productos['precio'];?></h5>
                        <p class="card-text">
                            contenidos
                        </p>
                        <form action="" method="POST" >
                            <input type="text" name="id" id="id" value="<?php echo openssl_encrypt($productos['id'],cod,key);?>">
                            <input type="text" name="nombre" id="nombre" value="<?php echo openssl_encrypt($productos['nombre'],cod,key);?>">
                            <input type="text" name="precio" id="precio" value="<?php echo openssl_encrypt($productos['precio'],cod,key);?>">
                            <input type="text" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,cod,key);?>">
                            <button class="btn btn-primary" type="submit" name="btnAccion" value="Agregar"  data-toggle="popover" data-trigger="hover" data-content="<?php echo $productos['descripcion'];?>">Agregar al carrito</button>
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
</body>
</html>
