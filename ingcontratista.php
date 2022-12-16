<?php
require_once "config.php";

$id_empresa = $nombre = $puntacion = $email = $contrasena = $valor = $id_proveedor = $id_usuario = "";
$id_empresa_err = $nombre_err = $puntacion_err = $email_err = $contrasena_err = $valor_err = $id_proveedor_err = $id_usuario_err ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validacion
    $input_id_empresa = trim($_POST["id_empresa"]);
    if (empty($input_id_empresa)) {
        $id_empresa_err = "Ingresa un monto de id_empresa";
    } elseif (!ctype_digit($input_id_empresa)) {
        $id_empresa_err = "Ingresa un valor positivo.";
    } else {
        $id_empresa = $input_id_empresa;
    }

    $input_nombre = trim($_POST["nombre"]);
    if (empty($input_nombre)) {
        $nombre_err = "Por favor ingresa un nombre.";
    } elseif (!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombre_err = "Ingresa un nombre valido.";
    } else {
        $nombre = $input_nombre;
    }

    $input_puntacion = trim($_POST["puntacion"]);
    if (empty($input_puntacion)) {
        $puntacion_err = "Por favor ingresa una puntacion.";
    } else {
        $puntacion = $input_puntacion;
    }

    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Por favor ingresa una email.";
    } else {
        $email = $input_email;
    }
   
    $input_contrasena = trim($_POST["contrasena"]);
    if (empty($input_contrasena)) {
        $contrasena_err = "Ingresa un monto de contrasena";
    } else {
        $contrasena = $input_contrasena;
    }
   
    $input_valor = trim($_POST["valor"]);
    if (empty($input_valor)) {
        $valor_err = "Ingresa un monto de valor";
    } elseif (!ctype_digit($input_valor)) {
        $valor_err = "Ingresa un valor positivo.";
    } else {
        $valor = $input_valor;
    }

    $input_id_proveedor = trim($_POST["id_proveedor"]);
    if (empty($input_id_proveedor)) {
        $id_proveedor_err = "Ingresa un monto de id_proveedor";
    } elseif (!ctype_digit($input_id_proveedor)) {
        $id_proveedor_err = "Ingresa un valor positivo.";
    } else {
        $id_proveedor = $input_id_proveedor;
    }

    $input_id_usuario = trim($_POST["id_usuario"]);
    if (empty($input_id_usuario)) {
        $id_usuario_err = "Ingresa un monto de id_usuario";
    } elseif (!ctype_digit($input_id_usuario)) {
        $id_usuario_err = "Ingresa un valor positivo.";
    } else {
        $id_usuario = $input_id_usuario;
    }

    
    if (empty($id_empresa_err) && empty($contrasena_err) && empty($valor_err) && empty($nombre_err) && empty($puntacion_err) && empty($email_err) && empty($id_proveedor_err) && empty($id_usuario_err))  {
        
        $sql = "INSERT INTO Contratista (id_empresa,nombre, puntacion, email,contrasena,valor,id_proveedor,id_usuario) VALUES (?,?,?,?,?,?,?,?)";

        if ($stmt = $link->prepare($sql)) {

            $stmt->bindParam(1, $param_id_empresa, PDO::PARAM_STR);
            $stmt->bindParam(2, $param_nombre, PDO::PARAM_STR);
            $stmt->bindParam(3, $param_puntacion, PDO::PARAM_STR);
            $stmt->bindParam(4, $param_email, PDO::PARAM_STR);
            $stmt->bindParam(5, $param_contrasena, PDO::PARAM_STR);
            $stmt->bindParam(6, $param_valor, PDO::PARAM_STR);
            $stmt->bindParam(7, $param_id_proveedor, PDO::PARAM_STR);
            $stmt->bindParam(8, $param_id_usuario, PDO::PARAM_STR);

            $param_id_empresa = $id_empresa;
            $param_nombre = $nombre;
            $param_email = $puntacion;
            $param_email = $email;
            $param_contrasena = $contrasena;
            $param_valor = $valor;
            $param_id_proveedor = $id_proveedor;
            $param_id_usuario = $id_usuario;

            if ($stmt->execute()) {
                header("location: encontrar.php?opcion=3");
                exit();
                echo "Exito...";
            } else {
                echo "Paso algo, intente mas tarde...";
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
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controlls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
    <h1 class="titulossn">Agrega una empresa o contratista</h1>
    </div>
    <hr>
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="centrar" style="color: whitesmoke;">
                    <p>Informaciom:</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($id_empresa_err)) ? 'has-error' : ''; ?>">
                            <label>id_empresa</label>
                            <input type="text" name="id_empresa" class="form-control" value="<?php echo $id_empresa; ?>">
                            <span class="help-block"><?php echo $id_empresa_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($puntacion_err)) ? 'has-error' : ''; ?>">
                            <label>puntacion</label>
                            <textarea name="puntacion" class="form-control"><?php echo $puntacion; ?></textarea>
                            <span class="help-block"><?php echo $puntacion_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($contrasena_err)) ? 'has-error' : ''; ?>">
                            <label>contrasena</label>
                            <input type="text" name="contrasena" class="form-control" value="<?php echo $contrasena; ?>">
                            <span class="help-block"><?php echo $contrasena_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($valor_err)) ? 'has-error' : ''; ?>">
                            <label>valor</label>
                            <input type="text" name="valor" class="form-control" value="<?php echo $valor; ?>">
                            <span class="help-block"><?php echo $valor_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($id_proveedor_err)) ? 'has-error' : ''; ?>">
                            <label>id_proveedor</label>
                            <input type="text" name="id_proveedor" class="form-control" value="<?php echo $id_proveedor; ?>">
                            <span class="help-block"><?php echo $id_proveedor_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($id_usuario_err)) ? 'has-error' : ''; ?>">
                            <label>id_usuario</label>
                            <input type="text" name="id_usuario" class="form-control" value="<?php echo $id_usuario; ?>">
                            <span class="help-block"><?php echo $id_usuario_err; ?></span>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Crear">
                        <a href="encontrar.php?opcion=3" class="btn btn-primary">Cancelar</a>
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