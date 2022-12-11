<?php
// Process delete operation after confirmation
if (isset($_POST["id_proveedor"]) && !empty($_POST["id_proveedor"])) {
    // Include config file
    require_once "config.php";

    // Prepare a delete statement
    $sql = "DELETE FROM proveedor WHERE id_proveedor = ?";

    //if($stmt = mysqli_prepare($link, $sql)){
    if ($stmt = $link->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        //mysqli_stmt_bind_param($stmt, "i", $param_id);
        $stmt->bindParam(1, $param_id_proveedor, PDO::PARAM_INT);

        // Set parameters
        $param_id_proveedor = trim($_POST["id_proveedor"]);

        // Attempt to execute the prepared statement
        //if(mysqli_stmt_execute($stmt)){
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
                header("location: ex.php");
                exit();
                echo "Exito...";
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    //mysqli_stmt_close($stmt);
    $stmt->closeCursor(); //PDO close

    // Close connection
    //mysqli_close($link);
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["id_proveedor"]))) {
        // URL doesn't contain id parameter. Redirect to error page
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
                            <input type="hidden" name="id_proveedor" value="<?php echo trim($_GET["id_proveedor"]); ?>" />
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