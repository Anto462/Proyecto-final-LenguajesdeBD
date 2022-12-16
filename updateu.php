<?php
require_once "config.php";
$nombre = $email = $apellido1 = $apellido2 = $roll = $contrasena = $email = $puntacion = $id_proveedor = "";

//no permite vacios
if (isset($_POST["id_usuario"]) && !empty($_POST["id_usuario"])) {
    $id_usuario = $_POST["id_usuario"];

    $input_nombre = trim($_POST["nombre"]);
    $nombre = $input_nombre;
    
    $input_email = trim($_POST["email"]);
    $email = $input_email;

    $input_apellido1 = trim($_POST["apellido1"]);
    $apellido1 = $input_apellido1;

    $input_apellido2= trim($_POST["apellido2"]);
    $apellido2 = $input_apellido2;

    $input_roll= trim($_POST["roll"]);
    $roll = $input_roll;
    
    $input_contrasena= trim($_POST["contrasena"]);
    $contrasena = $input_contrasena;

    $input_email= trim($_POST["email"]);
    $email = $input_email;

    $input_puntacion= trim($_POST["puntacion"]);
    $puntacion = $input_puntacion;

    $input_id_proveedor= trim($_POST["id_proveedor"]);
    $id_proveedor = $input_id_proveedor;


        $sql = "UPDATE usuario SET nombre=?, apellido1=?, apellido2=?, roll=?, contrasena=?, email=?, puntacion=?, id_proveedor=? WHERE id_usuario=?";

        if ($stmt = $link->prepare($sql)) {
            $stmt->bindParam(1, $param_nombre, PDO::PARAM_STR);
            $stmt->bindParam(2, $param_apellido1, PDO::PARAM_STR);
            $stmt->bindParam(3, $param_apellido2, PDO::PARAM_STR);
            $stmt->bindParam(4, $param_roll, PDO::PARAM_STR);
            $stmt->bindParam(5, $param_contrasena, PDO::PARAM_STR);
            $stmt->bindParam(6, $param_email, PDO::PARAM_STR);
            $stmt->bindParam(7, $param_puntacion, PDO::PARAM_STR);
            $stmt->bindParam(8, $param_id_proveedor, PDO::PARAM_STR);

            $stmt->bindParam(9, $param_id_usuario, PDO::PARAM_INT);

            $param_nombre = $nombre;
            $param_apellido1 = $apellido1;
            $param_apellido2 = $apellido2;
            $param_roll = $roll;
            $param_contrasena = $contrasena;
            $param_email = $email;
            $param_puntacion = $puntacion;
            $param_id_proveedor = $id_proveedor;

            $param_id_usuario = $id_usuario;


            if ($stmt->execute()) {
                header("location: encontrar.php?opcion=2");
                exit();
            } else {
                echo "ERRORRR";
            }
        

        $stmt->closeCursor();
    }

}else {
    if (isset($_GET["id_usuario"]) && !empty(trim($_GET["id_usuario"]))) {
        $id_usuario =  trim($_GET["id_usuario"]);
        $sql = "SELECT * FROM usuario WHERE id_usuario = ?";
        if ($stmt = $link->prepare($sql)) {
            $stmt->bindParam(1, $param_id_usuario, PDO::PARAM_INT);
            $param_id_usuario = $id_usuario;
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                if (count($result) == 1) {
                    $row = $result[0];

                    $nombre = $row["NOMBRE"];
                    $apellido1 = $row["APELLIDO1"];
                    $apellido2 = $row["APELLIDO2"];
                    $roll = $row["ROLL"];
                    $contrasena = $row["CONTRASENA"];
                    $email = $row["EMAIL"];
                    $puntacion = $row["PUNTACION"];
                    $id_proveedor = $row["ID_PROVEEDOR"];
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
                    <a class="nav-link active nav-izquierda" href="proyectos.php"><img src="https://creazilla-store.fra1.digitaloceanspaces.com/emojis/56482/gear-emoji-clipart-md.png" width="25" height="25" class="d-inline-block align-top" alt=""/>  Proyectos</a>
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
    <h1 class="titulossn">Actualiza un trabajador</h1>
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

                        <div class="">
                            <label>apellido1</label>
                            <input type="text" name="apellido1" class="form-control" value="<?php echo $apellido1; ?>">
                            <span class="help-block"></span>
                        </div>

                        <div class="">
                            <label>apellido2</label>
                            <input type="text" name="apellido2" class="form-control" value="<?php echo $apellido2; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="">
                            <label>roll</label>
                            <input type="text" name="roll" class="form-control" value="<?php echo $roll; ?>">
                            <span class="help-block"></span>
                        </div>
                        <br>

                        <div class="">
                            <label>contrasena</label>
                            <input type="text" name="contrasena" class="form-control" value="<?php echo $contrasena; ?>">
                            <span class="help-block"></span>
                        </div>
                        <br>
                        <div class="">
                            <label>email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"></span>
                        </div>
                        <br>
                        <div class="">
                            <label>puntacion</label>
                            <input type="text" name="puntacion" class="form-control" value="<?php echo $puntacion; ?>">
                            <span class="help-block"></span>
                        </div>
                        <br>
                        <div class="">
                            <label>id_proveedor</label>
                            <input type="text" name="id_proveedor" class="form-control" value="<?php echo $id_proveedor; ?>">
                            <span class="help-block"></span>
                        </div>
                        <br>

                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>" />
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                        <a href="encontrar.php?opcion=2" class="btn btn-primary">Cancelar</a>
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