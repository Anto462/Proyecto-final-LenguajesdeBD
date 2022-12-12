<?php
/////////Nos conectamos
require_once "config.php";

// Variables a insertar y errores
$id_proveedor = $nombre = $email = $fiabilidad = $localizacion = $producto = "";
$id_proveedor_err = $nombre_err = $email_err = $fiabilidad_err = $localizacion_err = $producto_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /////////////VALIDACIONES
    $input_id_proveedor = trim($_POST["id_proveedor"]);
    if (empty($input_id_proveedor)) {
        $id_proveedor_err = "Ingrese un monto de id_proveedor";
    } elseif (!ctype_digit($input_id_proveedor)) {
        $id_proveedor_err = "Debe añadir un numero positivo o bien no esta disponible";
    } else {
        $id_proveedor = $input_id_proveedor;
    }
    
    $input_nombre = trim($_POST["nombre"]);
    if (empty($input_nombre)) {
        $nombre_err = "Ingrese un nombre.";
    } elseif (!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombre_err = "Nombre invalido";
    } else {
        $nombre = $input_nombre;
    }

    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Ingrese un email";
    } else {
        $email = $input_email;
    }

    $input_fiabilidad = trim($_POST["fiabilidad"]);
    if (empty($input_fiabilidad)) {
        $fiabilidad_err = "Ingrese una fiabilidad valida del 1-5";
    } elseif (!ctype_digit($input_fiabilidad)) {
        $fiabilidad_err = "Ingrese una fiabilidad valida del 1-5";
    } else {
        $fiabilidad = $input_fiabilidad;
    }

    $input_localizacion = trim($_POST["localizacion"]);
    if (empty($input_localizacion)) {
        $localizacion_err = "Ingrese un localizacion.";
    } elseif (!filter_var($input_localizacion, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $localizacion_err = "Localizacion invalida";
    } else {
        $localizacion = $input_localizacion;
    }

    $input_producto= trim($_POST["producto"]);
    if (empty($input_producto)) {
        $producto_err = "Ingrese un producto";
    } elseif (!filter_var($input_producto, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $producto_err = "Producto invalido";
    } else {
        $producto = $input_producto;
    }

    // //Verificacion errores
    if (empty($id_proveedor_err) && empty($localizacion_err) && empty($producto_err) && empty($nombre_err) && empty($email_err) && empty($fiabilidad_err)) {
        $sql = "INSERT INTO proveedor (id_proveedor,nombre, email, fiabilidad,localizacion,producto) VALUES (?,?,?,?,?,?)";

        if ($stmt = $link->prepare($sql)) {

            $stmt->bindParam(1, $param_id_proveedor, PDO::PARAM_STR);
            $stmt->bindParam(2, $param_nombre, PDO::PARAM_STR);
            $stmt->bindParam(3, $param_email, PDO::PARAM_STR);
            $stmt->bindParam(4, $param_fiabilidad, PDO::PARAM_STR);
            $stmt->bindParam(5, $param_localizacion, PDO::PARAM_STR);
            $stmt->bindParam(6, $param_producto, PDO::PARAM_STR);

            //Se colocan a los parametros los datos
            $param_id_proveedor = $id_proveedor;
            $param_nombre = $nombre;
            $param_email = $email;
            $param_fiabilidad = $fiabilidad;
            $param_localizacion = $localizacion;
            $param_producto = $producto;

            if ($stmt->execute()) {
                header("location: encontrar.php?opcion=1");
                exit();
                echo "INSERTADOS";
            } else {
                echo "NO INSERTADOS";
            }
        }
        $stmt->closeCursor();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/normalize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/styles.css">
    <title>Construnet</title>
    <link rel="icon" href="images/Cono-vial-2-923x1024.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <script defer src="js/script.js"></script>
</head>
<body>
<header th:fragment="header" class="header">  
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="index.html"> <img src="images/Installation.png" width="40" height="40" class="d-inline-block align-top" alt=""/>  CONSTRUNET</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active nav-izquierda" aria-current="page" href="index.html" ><img src="https://creazilla-store.fra1.digitaloceanspaces.com/emojis/56482/gear-emoji-clipart-md.png" width="25" height="25" class="d-inline-block align-top" alt=""/>  Inicio</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active nav-izquierda" href="sobre.html"><img src="https://creazilla-store.fra1.digitaloceanspaces.com/emojis/56482/gear-emoji-clipart-md.png" width="25" height="25" class="d-inline-block align-top" alt=""/>  Mas sobre nosotros</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active nav-izquierda" href=""><img src="https://creazilla-store.fra1.digitaloceanspaces.com/emojis/56482/gear-emoji-clipart-md.png" width="25" height="25" class="d-inline-block align-top" alt=""/>  Proyectos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active nav-izquierda" href="general.php"><img src="https://creazilla-store.fra1.digitaloceanspaces.com/emojis/56482/gear-emoji-clipart-md.png" width="25" height="25" class="d-inline-block align-top" alt=""/>  Encontrar</a>
                  </li>
                </ul>
              </div>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <div>
                    <li class="nav-item">
                        <a class="nav-link active nav-izquierda2" href=""><img src="images/img_462661.png" width="25" height="25" class="d-inline-block align-top" alt=""/> Login</a>
                      </li>
                    </div>
                    <div>
                      <li class="nav-item">
                        <a class="nav-link active nav-izquierda2" href=""><img src="images/pencil2.png" width="25" height="25" class="d-inline-block align-top" alt=""/> Registrarse</a>
                      </li>
                    </li>
                </div>
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <hr>
    <div class="boxsn">
    <h1 class="titulossn">Agrega un provedor</h1>
    </div>
    <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="centrar" style="color: whitesmoke;">
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
                        <br>
                        <input type="submit" class="btn btn-primary" value="Crear">
                        <a href="encontrar.php?opcion=1" class="btn btn-primary">Cancelar</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>


    <hr>
<footer>
<div class="footer-cont">
  <div>
    <h3 style="font-size: 35px; text-transform: capitalize;">Soporte: </h3>
    <p>Numero: +506 4030 1765</p>
    <p>Mail: Soporte@construnet.co.cr</p>
  </div>
  <div>
    <h3 style="font-size: 30px; text-transform: capitalize">SIGUENOS: </h3>
    <ul class="socialmedia">
      <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
      <li><a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a></li>
      <li><a href="https://www.instagram.com/?msclkid=b1784819abf211eca4613ea94873a212"><i class="fa fa-instagram"></i></a></li>
    </ul>
  </div>
  <p>&copy; 2022 Lenguajes de BD <Span>Proyecto final</Span></p>
  </div>
</footer>    
</body>
</html>