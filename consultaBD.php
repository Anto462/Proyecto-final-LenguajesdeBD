<?php
//Aqui dejo como php hace consultas a una bd, igual se debe verificar con la conexion a oracle
require_once 'conexion.php';

function ConsultaSQL($elQuery)

{
    $conn = conectar();

    if (!$conn->set_charset("utf8")){
        printf("Error cargando el conjunto de caracteres utf8: %s\n", $conn->error);

    } else {

    }

$queryDelvuelto = $conn-> query($elQuery);

return $queryDelvuelto;

}

?>