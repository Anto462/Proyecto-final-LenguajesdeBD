<?php
/////////Nos conectamos
require_once "config.php";

// Variables a insertar y errores
$Localizacion = $descripcion = $presupuesto = $duracionaprox = $id_usuario = $id_empresa = "";
$Localizacion_err = $descripcion_err = $presupuesto_err = $duracionaprox_err = $id_usuario_err = $id_empresa_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /////////////VALIDACIONES
    $input_Localizacion = trim($_POST["Localizacion"]);
    if (empty($input_Localizacion)) {
        $Localizacion_err = "Ingrese un Localizacion.";
    } elseif (!filter_var($input_Localizacion, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $Localizacion_err = "Localizacion invalido";
    } else {
        $Localizacion = $input_Localizacion;
    }

    $input_descripcion = trim($_POST["descripcion"]);
    if (empty($input_descripcion)) {
        $descripcion_err = "Ingrese un descripcion";
    } else {
        $descripcion = $input_descripcion;
    }

    $input_presupuesto= trim($_POST["presupuesto"]);
    if (empty($input_presupuesto)) {
        $presupuesto_err = "Ingrese un presupuesto";
    } else {
        $presupuesto = $input_presupuesto;
    }

    $input_duracionaprox= trim($_POST["duracionaprox"]);
    if (empty($input_duracionaprox)) {
        $duracionaprox_err = "Ingrese un duracionaprox";
    } else {
        $duracionaprox = $input_duracionaprox;
    }

    $input_id_usuario= trim($_POST["id_usuario"]);
    if (empty($input_id_usuario)) {
        $id_usuario_err = "Ingrese un id_usuario";
    } else {
        $id_usuario = $input_id_usuario;
    }

    $input_id_empresa = trim($_POST["id_empresa"]);
    if (empty($input_id_empresa)) {
        $id_empresa_err = "Ingrese un id_empresa";
    } else {
        $id_empresa = $input_id_empresa;
    }

    // //Verificacion errores
    if (empty($duracionaprox_err) && empty($id_usuario_err) && empty($Localizacion_err) &&
     empty($descripcion_err) && empty($presupuesto_err) && empty($id_empresa_err)) {
        $sql = "INSERT INTO Anteproyecto (Localizacion,descripcion,presupuesto,duracionaprox,id_usuario,id_empresa) VALUES (?,?,?,?,?,?)";

        if ($stmt = $link->prepare($sql)) {

            $stmt->bindParam(1, $param_Localizacion, PDO::PARAM_STR);
            $stmt->bindParam(2, $param_descripcion, PDO::PARAM_STR);
            $stmt->bindParam(3, $param_presupuesto, PDO::PARAM_STR);
            $stmt->bindParam(4, $param_duracionaprox, PDO::PARAM_STR);
            $stmt->bindParam(5, $param_id_usuario, PDO::PARAM_STR);
            $stmt->bindParam(6, $param_id_empresa, PDO::PARAM_STR);
            
            //Se colocan a los parametros los datos
            $param_Localizacion = $Localizacion;
            $param_descripcion = $descripcion;
            $param_presupuesto = $presupuesto;
            $param_duracionaprox = $duracionaprox;
            $param_id_usuario = $id_usuario;
            $param_id_empresa = $id_empresa;
           

            if ($stmt->execute()) {
                header("location: proyectos.php");
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
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-contduracionaproxs="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
    <h1 class="titulossn">Agrega un Ante Proyecto</h1>
    </div>
    <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="centrar" style="color: whitesmoke;">
                    <p>Informacion:</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group <?php echo (!empty($Localizacion_err)) ? 'has-error' : ''; ?>">
                            <label>Localizacion</label>
                            <input type="text" name="Localizacion" class="form-control" value="<?php echo $Localizacion; ?>">
                            <span class="help-block"><?php echo $Localizacion_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                            <label>descripcion</label>
                            <textarea name="descripcion" class="form-control"><?php echo $descripcion; ?></textarea>
                            <span class="help-block"><?php echo $descripcion_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($presupuesto_err)) ? 'has-error' : ''; ?>">
                            <label>presupuesto</label>
                            <input type="text" name="presupuesto" class="form-control" value="<?php echo $presupuesto; ?>">
                            <span class="help-block"><?php echo $presupuesto_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($duracionaprox_err)) ? 'has-error' : ''; ?>">
                            <label>duracionaprox</label>
                            <input type="text" name="duracionaprox" class="form-control" value="<?php echo $duracionaprox; ?>">
                            <span class="help-block"><?php echo $duracionaprox_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($id_usuario_err)) ? 'has-error' : ''; ?>">
                            <label>id_usuario</label>
                            <input type="text" name="id_usuario" class="form-control" value="<?php echo $id_usuario; ?>">
                            <span class="help-block"><?php echo $id_usuario_err; ?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($id_empresa_err)) ? 'has-error' : ''; ?>">
                            <label>id_empresa</label>
                            <input type="text" name="id_empresa" class="form-control" value="<?php echo $id_empresa; ?>">
                            <span class="help-block"><?php echo $id_empresa_err; ?></span>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Crear">
                        <a href="proyectos.php" class="btn btn-primary">Cancelar</a>
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