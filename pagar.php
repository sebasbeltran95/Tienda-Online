<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<?php 

if($_POST){
    $total = 0;
    $sid = session_id();
    $correo = $_POST['email'];

    foreach($_SESSION['carrito'] as $indice=>$producto){
        $total = $total + ($producto['precio']*$producto['cantidad']);
    }

    $sentencia=$pdo->prepare("INSERT INTO ventas
     (claveTransaccion, paypalDatos, correo, total, estado) 
     VALUES (:claveTransaccion, '', :correo, :total, 'pendiente')");
    
    $sentencia->bindParam(':claveTransaccion',$sid, PDO::PARAM_STR);
    $sentencia->bindParam(':correo',$correo, PDO::PARAM_STR);
    $sentencia->bindParam(':total',$total, PDO::PARAM_STR);

    $sentencia->execute();
    $idVenta=$pdo->lastInsertId();

    foreach($_SESSION['carrito'] as $indice=>$producto){

        $sentencia=$pdo->prepare("INSERT INTO detalleventa 
        (idventa, idproducto, preciounitario, cantidad, descargado)
         VALUES (:idventa, :idproducto, :preciounitario, :cantidad, '0')");

        $sentencia->bindParam(':idventa',$idVenta, PDO::PARAM_INT);
        $sentencia->bindParam(':idproducto',$producto['id'], PDO::PARAM_INT);
        $sentencia->bindParam(':preciounitario',$producto['precio'], PDO::PARAM_STR);
        $sentencia->bindParam(':cantidad',$producto['cantidad'], PDO::PARAM_INT);

        $sentencia->execute();

    }
    echo "<h3>".$total."</h3>";
}
?>
<div class="jumbotron">
    <h1 class="display-4 text-center">!Paso Final¡</h1>
    <hr class="my-4">
    <p class="lead text-center">
        Estas a punto de pagar con PayPal la cantidad de:
        <h4 class="text-center"> $<?php echo number_format($total,2); ?> COP </h4>
    </p>
    <p>
        Los productos podran ser descargados una vez que se procese el pago
        <strong>(Para aclaraciones: sebastian199502@hotmail.com)</strong>
    </p>

</div>




<?php
include 'templates/pie.php';
?>
