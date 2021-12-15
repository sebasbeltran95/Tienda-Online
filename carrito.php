<?php

$mensaje = "";

if(isset($_POST['btnAccion'])){

    switch($_POST['btnAccion']){
        case 'Agregar': 

            if(is_numeric( openssl_decrypt($_POST['id'],cod,key))){
                $id =  openssl_decrypt($_POST['id'],cod,key);
                $mensaje = "Ok id correcto".$id;
            } else {
                $mensaje = "Upsss... id incorrecto".$id;
            }
            break;
    }

}









