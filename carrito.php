<?php
session_start();
$mensaje = "";

if(isset($_POST['btnAccion'])){

    switch($_POST['btnAccion']){
        case 'Agregar': 

            if(is_numeric( openssl_decrypt($_POST['id'],cod,key))){
                $id =  openssl_decrypt($_POST['id'],cod,key);
                $mensaje.= "Ok id correcto".$id."<br>";
            } else {
                $mensaje.= "Upsss... id incorrecto".$id."<br>";
            }
            //  desencriptamos y validamos  nombre cantidad y precio 
            if(is_string(openssl_decrypt($_POST['nombre'],cod,key))){
                $nombre = openssl_decrypt($_POST['nombre'],cod,key);
                $mensaje.= "OK NOMBRE".$nombre."<br>";
            } else {
                $mensaje.= "Upss... algo pasa con el nombre"."<br>";
                break;
            }
            if(is_numeric(openssl_decrypt($_POST['cantidad'],cod,key))){
                $cantidad = openssl_decrypt($_POST['cantidad'],cod,key);
                $mensaje.= "OK CANTIDAD".$cantidad."<br>";
            }else {
                $mensaje.= "Upss... algo pasa con la cantidad"."<br>";
                break;
            }
            if(is_numeric(openssl_decrypt($_POST['precio'],cod,key))){
                $precio = openssl_decrypt($_POST['precio'],cod,key);
                $mensaje.= "OK PRECIO".$precio."<br>";
            } else {
                $mensaje.= "Upss... algo pasa con el precio"."<br>";
                break;
            }
            if(!isset($_SESSION['carrito'])){
                $producto=array(
                    'id'=>$id,
                    'nombre'=>$nombre,
                    'cantidad'=>$cantidad,
                    'precio'=>$precio
                );
                $_SESSION['carrito'][0]=$producto;
                $mensaje= "producto agregado al carrito";
            } else {

                $idProductos = array_column($_SESSION['carrito'],"id");
                if(in_array($id,$idProductos)){
                    echo "<script> alert('El prodcuto ya ha sido seleccionado...'); </script>";
                } else {
                    $numeroProductos=count($_SESSION['carrito']);
                    $producto=array(
                        'id'=>$id,
                        'nombre'=>$nombre,
                        'cantidad'=>$cantidad,
                        'precio'=>$precio
                    );
                    $_SESSION['carrito'][$numeroProductos]=$producto;
                    $mensaje= "producto agregado";
                }
            }
            // $mensaje= print_r($_SESSION,true);
            $mensaje= "producto agregado  al carrito";
            break;

            case "Eliminar":
                if(is_numeric( openssl_decrypt($_POST['id'],cod,key))){
                    $id =  openssl_decrypt($_POST['id'],cod,key);
                 
                    foreach($_SESSION['carrito'] as $indice=>$producto){
                        if($producto['id']==$id){
                            unset($_SESSION['carrito'][$indice]);
                            echo "<script>alert('Elemento borrado....')</script>";
                        }
                    }
                } else {
                    $mensaje.= "Upsss... id incorrecto".$id."<br>";
                }
                break;
    }

}









