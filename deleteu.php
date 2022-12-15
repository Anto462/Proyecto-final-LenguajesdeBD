<?php
if (isset($_POST["id_usuario"]) && !empty($_POST["id_usuario"])) {
    require_once "config.php";

    //Sentencia de de delete
    $sql = "DELETE FROM usuario WHERE id_usuario = ?";

    if ($stmt = $link->prepare($sql)) {
        $stmt->bindParam(1, $param_id_usuario, PDO::PARAM_INT);

        $param_id_usuario = trim($_POST["id_usuario"]);

        if ($stmt->execute()) {
                header("location: encontrar.php?opcion=2");
                exit();
                echo "Exito...";
        } else {
            echo "Error al eliminar";
        }
    }
    $stmt->closeCursor();
} else {
    if (empty(trim($_GET["id_usuario"]))) {
        echo "no existe";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Borrar Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Borrar Registro</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id_usuario" value="<?php echo trim($_GET["id_usuario"]); ?>" />
                            <p>Estas seguro de borrar este registro?</p><br>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="index.html" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>