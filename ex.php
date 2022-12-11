

<?php
///////////////////////////////////////////////////////////////////////////////////////////////
//////ESTE ESPACIO ESTA SIENDO USADO COMO AMBIENTE DE PRUEBAS, ACTUALMENTE SE HA PROBADO:
// INSERTAR CON FORM EXITOSO
// MOSTRAR EXITOSO
/////////////////////////////////////////////////////////////////////////////////////////////

///define('DB_SERVER', '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)
///(HOST=127.0.0.1)(PORT=1521))(CONNECT_DATA=(SERVICE_NAME=orcl)))');
///define('DB_USERNAME', 'Anto462');
///define('DB_PASSWORD', 'anto462');
//define('DB_NAME', 'XE');
//Oracle database
///try {
   /// $link = new PDO("oci:dbname=" . DB_SERVER, DB_USERNAME, DB_PASSWORD);
    ///if($link){
        ///echo 'Conexion Exitosa...';
    ///}
///} catch (PDOException $e) {
    ///echo ($e->getMessage());
///}
?>

<?php
/////////INSERCION CON FORM
// Incluimos el archivo config.php
require_once "config.php";

// Definimos variables e inicializamos vacio
$id_proveedor = $nombre = $email = $fiabilidad = $localizacion = $producto = "";
$id_proveedor_err = $nombre_err = $email_err = $fiabilidad_err = $localizacion_err = $producto_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validacion fiabilidad
    $input_id_proveedor = trim($_POST["id_proveedor"]);
    if (empty($input_id_proveedor)) {
        $id_proveedor_err = "Ingresa un monto de id_proveedor";
    } elseif (!ctype_digit($input_id_proveedor)) {
        $id_proveedor_err = "Ingresa un valor positivo.";
    } else {
        $id_proveedor = $input_id_proveedor;
    }
    // Validacion nombre
    $input_nombre = trim($_POST["nombre"]);
    if (empty($input_nombre)) {
        $nombre_err = "Por favor ingresa un nombre.";
    } elseif (!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombre_err = "Ingresa un nombre valido.";
    } else {
        $nombre = $input_nombre;
    }

    // Validacion email
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Por favor ingresa una email.";
    } else {
        $email = $input_email;
    }

    // Validacion fiabilidad
    $input_fiabilidad = trim($_POST["fiabilidad"]);
    if (empty($input_fiabilidad)) {
        $fiabilidad_err = "Ingresa un monto de fiabilidad";
    } elseif (!ctype_digit($input_fiabilidad)) {
        $fiabilidad_err = "Ingresa un valor positivo.";
    } else {
        $fiabilidad = $input_fiabilidad;
    }
    // Validacion localizacion
    $input_localizacion = trim($_POST["localizacion"]);
    if (empty($input_localizacion)) {
        $localizacion_err = "Por favor ingresa un localizacion.";
    } elseif (!filter_var($input_localizacion, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $localizacion_err = "Ingresa un localizacion valido.";
    } else {
        $localizacion = $input_localizacion;
    }
    // Validacion producto
    $input_producto= trim($_POST["producto"]);
    if (empty($input_producto)) {
        $producto_err = "Por favor ingresa un producto.";
    } elseif (!filter_var($input_producto, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $producto_err = "Ingresa un producto valido.";
    } else {
        $producto = $input_producto;
    }

    // Revisamos errores antes de continuar
    if (empty($id_proveedor_err) && empty($localizacion_err) && empty($producto_err) && empty($nombre_err) && empty($email_err) && empty($fiabilidad_err)) {
        // preparamos la sentancia INSERT
        $sql = "INSERT INTO proveedor (id_proveedor,nombre, email, fiabilidad,localizacion,producto) VALUES (?, ?, ?,?,?,?)";

        if ($stmt = $link->prepare($sql)) {

            // Se hace el bindeo de variables para la sentencia
            $stmt->bindParam(1, $param_id_proveedor, PDO::PARAM_STR);
            $stmt->bindParam(2, $param_nombre, PDO::PARAM_STR);
            $stmt->bindParam(3, $param_email, PDO::PARAM_STR);
            $stmt->bindParam(4, $param_fiabilidad, PDO::PARAM_STR);
            $stmt->bindParam(5, $param_localizacion, PDO::PARAM_STR);
            $stmt->bindParam(6, $param_producto, PDO::PARAM_STR);

            // settear variables
            $param_id_proveedor = $id_proveedor;
            $param_nombre = $nombre;
            $param_email = $email;
            $param_fiabilidad = $fiabilidad;
            $param_localizacion = $localizacion;
            $param_producto = $producto;

            // Intentando ejecutar la declaración preparada
            if ($stmt->execute()) {
                // Registros creados con éxito. Redirigiendo a la página de destino
                //header("location: index.php");
                //exit();
                echo "Exito...";
            } else {
                echo "Paso algo, intente mas tarde...";
            }
        }

        // Cerrando sentencia
        $stmt->closeCursor(); //PDO close
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Crear Registro</h2>
                    </div>
                    <p>Ingreso de proveedor</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($id_proveedor_err)) ? 'has-error' : ''; ?>">
                            <label>id_proveedor</label>
                            <input type="text" name="id_proveedor" class="form-control" value="<?php echo $id_proveedor; ?>">
                            <span class="help-block"><?php echo $id_proveedor_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>email</label>
                            <textarea name="email" class="form-control"><?php echo $email; ?></textarea>
                            <span class="help-block"><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($fiabilidad_err)) ? 'has-error' : ''; ?>">
                            <label>fiabilidad</label>
                            <input type="text" name="fiabilidad" class="form-control" value="<?php echo $fiabilidad; ?>">
                            <span class="help-block"><?php echo $fiabilidad_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($localizacion_err)) ? 'has-error' : ''; ?>">
                            <label>localizacion</label>
                            <input type="text" name="localizacion" class="form-control" value="<?php echo $localizacion; ?>">
                            <span class="help-block"><?php echo $localizacion_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($producto_err)) ? 'has-error' : ''; ?>">
                            <label>producto</label>
                            <input type="text" name="producto" class="form-control" value="<?php echo $producto; ?>">
                            <span class="help-block"><?php echo $producto_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Crear">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h1>Prueba mostrar</h1>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Detalles de Empleados</h2>
                        <a href="create.php" class="btn btn-success pull-right">Agregar nuevo Empleado</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM proveedor";
                    //if($result = mysqli_query($link, $sql)){
                    if ($result = $link->query($sql)) {
                        //if(mysqli_num_rows($result) > 0){
                        if ($result->fetchColumn() > 0) {
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>id_proveedor</th>";
                            echo "<th>nombre</th>";
                            echo "<th>email</th>";
                            echo "<th>fiabilidad</th>";
                            echo "<th>localizacion</th>";
                            echo "<th>producto</th>";
                            echo "<th>Acciones</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            //while($row = mysqli_fetch_array($result)){
                            foreach ($link->query($sql) as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['ID_PROVEEDOR'] . "</td>";
                                echo "<td>" . $row['NOMBRE'] . "</td>";
                                echo "<td>" . $row['EMAIL'] . "</td>";
                                echo "<td>" . $row['FIABILIDAD'] . "</td>";
                                echo "<td>" . $row['LOCALIZACION'] . "</td>";
                                echo "<td>" . $row['PRODUCTO'] . "</td>";
                                echo "<td>";
                                echo "<a href='read.php?id=" . $row['ID_PROVEEDOR'] . "' title='Ver Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                echo "<a href='update.php?id=" . $row['ID_PROVEEDOR'] . "' title='Actualizar Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                echo "<a href='exdelete.php?id_proveedor=" . $row['ID_PROVEEDOR'] . "' title='Borrar Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            //mysqli_free_result($result);
                            $result->closeCursor(); //PDO close
                        } else {
                            echo "<p class='lead'><em>No hay registros que mostrar.</em></p>";
                        }
                    } else {
                        echo "ERROR: No se pudo ejecutar $sql. ";
                    }

                    // Close connection
                    //mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>


