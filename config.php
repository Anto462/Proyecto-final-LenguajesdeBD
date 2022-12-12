<?php
define('DB_SERVER', '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)
(HOST=127.0.0.1)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=orcl)))');
define('DB_USERNAME', 'Anto462');
define('DB_PASSWORD', 'anto462');

//Nos conectamos
try {
    $link = new PDO("oci:dbname=" . DB_SERVER, DB_USERNAME, DB_PASSWORD);
    if($link){
       // echo 'Conexion Exitosa';
    }
} catch (PDOException $e) {
    echo ($e->getMessage());
}
?>