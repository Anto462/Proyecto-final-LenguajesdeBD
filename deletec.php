<?php
if (isset($_POST["id_empresa"]) && !empty($_POST["id_empresa"])) {
    require_once "config.php";

    //Sentencia de de delete
    $sql = "DELETE FROM contratista WHERE id_empresa = ?";

    if ($stmt = $link->prepare($sql)) {
        $stmt->bindParam(1, $param_id_empresa, PDO::PARAM_INT);

        $param_id_empresa = trim($_POST["id_empresa"]);

        if ($stmt->execute()) {
                header("location: encontrar.php?opcion=3");
                exit();
                echo "Exito...";
        } else {
            echo "Error al eliminar";
        }
    }
    $stmt->closeCursor();
} else {
    if (empty(trim($_GET["id_empresa"]))) {
        echo "no existe";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="Css/normalize.css">
    <link rel="icon" href="images/Cono-vial-2-923x1024.png" type="image/x-icon">
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
                        <div class="alert alert-secondary fade in">
                            <input type="hidden" name="id_empresa" value="<?php echo trim($_GET["id_empresa"]); ?>" />
                            <p>Estas seguro de borrar este registro?</p><br>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="index.html" class="btn btn-primary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>