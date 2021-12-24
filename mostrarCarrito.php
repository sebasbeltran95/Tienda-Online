<?php
include 'global/config.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<h3>Lista del carrito</h3>
<?php  if(!empty($_SESSION['carrito'])) {?>
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th width="40%">Descripcion</th>
            <th width="15%" class="text-center">Cantidad</th>
            <th width="20%" class="text-center">Precio</th>
            <th width="20%" class="text-center">Total</th>
            <th width="5%">--</th>
        </tr>
        <?php $total=0;?>
        <?php foreach($_SESSION['carrito'] as $indice=>$producto){ ?>
        <tr>
            <td width="40%"><?php echo $producto['nombre'] ?></td>
            <td width="15%" class="text-center"><?php echo $producto['cantidad'] ?></td>
            <td width="20%" class="text-center">$<?php echo $producto['precio'] ?></td>
            <td width="20%" class="text-center">$<?php echo number_format($producto['precio']*$producto['cantidad'],2); ?></td>
            <td width="5%">
                <form action="" method="POST">
                    <input type="hidden"
                     name="id" 
                     id="id" 
                     value="<?php echo openssl_encrypt($producto['id'],cod,key);?>">
                    <button class="btn btn-danger" 
                    type="submit"
                     name="btnAccion" 
                     value="Eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php $total= $total+($producto['precio']*$producto['cantidad']);?>
        <?php }?>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="right"><h3>$<?php echo number_format($total,2); ?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
            <form action="pagar.php" method="POST">
                <div class="alert alert-success">
                    <div class="form-group">
                        <label for="my-input">Correo de contacto:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Correo Electronico" required>
                    </div>
                    <small id="emailHelp" class="form-text text-muted">
                        Los prodcutos se envairan a este correo...
                    </small>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit" value="proceder" name="btnAccion">Proceder a pagar >></button>
            </form>
            </td>
        </tr>
    </tbody>
</table>
<?php } else { ?>
    <div class="alert alert-success">
    No hay productos en el carrito....
    </div>
<?php }?>



<?php
include 'templates/pie.php';
?>
 