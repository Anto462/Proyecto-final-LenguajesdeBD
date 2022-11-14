<?php
//Dejo aca el como se conecta php a una bd, debe ser parecido en oracle pero se debe investigar
function conectar(){
    $host="--";
    $user="--";
    $pass="---";

    $bd="----";
    $con=mysqli_connect($host,$user,$pass);

    mysqli_select_db($con,$bd);
    return $con;


}
?>