<?php
require_once "config.php";
$nombre = $email = $fiabilidad = $localizacion = $producto = "";

//no permite vacios
if (isset($_POST["id_proveedor"]) && !empty($_POST["id_proveedor"])) {
    $id_proveedor = $_POST["id_proveedor"];

    $input_nombre = trim($_POST["nombre"]);
    $nombre = $input_nombre;
    
    $input_email = trim($_POST["email"]);
    $email = $input_email;

    $input_fiabilidad = trim($_POST["fiabilidad"]);
    $fiabilidad = $input_fiabilidad;

    $input_localizacion= trim($_POST["localizacion"]);
    $localizacion = $input_localizacion;

    $input_producto= trim($_POST["producto"]);
    $producto = $input_producto;


        $sql = "UPDATE proveedor SET nombre=?, email=?, fiabilidad=?, localizacion=?, producto=? WHERE id_proveedor=?";

        if ($stmt = $link->prepare($sql)) {
            $stmt->bindParam(1, $param_nombre, PDO::PARAM_STR);
            $stmt->bindParam(2, $param_email, PDO::PARAM_STR);
            $stmt->bindParam(3, $param_fiabilidad, PDO::PARAM_STR);
            $stmt->bindParam(4, $param_localizacion, PDO::PARAM_STR);
            $stmt->bindParam(5, $param_producto, PDO::PARAM_STR);
            $stmt->bindParam(6, $param_id_proveedor, PDO::PARAM_INT);

            $param_nombre = $nombre;
            $param_email = $email;
            $param_fiabilidad = $fiabilidad;
            $param_localizacion = $localizacion;
            $param_producto = $producto;
            $param_id_proveedor = $id_proveedor;


            if ($stmt->execute()) {
                header("location: encontrar.php?opcion=1");
                exit();
            } else {
                echo "ERRORRR";
            }
        

        $stmt->closeCursor();
    }

}else {
    if (isset($_GET["id_proveedor"]) && !empty(trim($_GET["id_proveedor"]))) {
        $id_proveedor =  trim($_GET["id_proveedor"]);
        $sql = "SELECT * FROM proveedor WHERE id_proveedor = ?";
        if ($stmt = $link->prepare($sql)) {
            $stmt->bindParam(1, $param_id_proveedor, PDO::PARAM_INT);
            $param_id_proveedor = $id_proveedor;
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                if (count($result) == 1) {
                    $row = $result[0];

                    $nombre = $row["NOMBRE"];
                    $email = $row["EMAIL"];
                    $fiabilidad = $row["FIABILIDAD"];
                    $localizacion = $row["LOCALIZACION"];
                    $producto = $row["PRODUCTO"];
                } else {
                    echo "ER1";
                }
            } else {
                echo "ER2";
            }
        }
        $stmt->closeCursor();
    } else {
        echo "ER3";
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
    <h1 class="titulossn">Actualiza un provedor</h1>
    </div>
    <hr>

        <div class="container" style="color: whitesmoke;">
            <div class="row">
            <div class="col-md-12">
                <div class="centrar" style="color: whitesmoke;">
                    </div>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    
                    <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>email</label>
                            <textarea name="email" class="form-control"><?php echo $email; ?></textarea>
                            <span class="help-block"></span>
                        </div>
                        <div class="">
                            <label>fiabilidad</label>
                            <input type="text" name="fiabilidad" class="form-control" value="<?php echo $fiabilidad; ?>">
                            <span class="help-block"></span>
                        </div>

                        <div class="">
                            <label>localizacion</label>
                            <input type="text" name="localizacion" class="form-control" value="<?php echo $localizacion; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="">
                            <label>producto</label>
                            <input type="text" name="producto" class="form-control" value="<?php echo $producto; ?>">
                            <span class="help-block"></span>
                        </div>
                        <br>

                        <input type="hidden" name="id_proveedor" value="<?php echo $id_proveedor; ?>" />
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                        <a href="encontrar.php?opcion=1" class="btn btn-primary">Cancelar</a>
                    </form>
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