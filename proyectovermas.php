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
    <h1 class="titulossn">Status del proyecto</h1>
    </div>
    <hr>
    <div class="main">
<?php
error_reporting(0);
$opcion = ($_GET['id_ante_proyecto']);
require_once "config.php";

$sql = "SELECT * FROM proyectos where id_ante_proyecto = $opcion";
if ($result = $link->query($sql)) {
    if ($result->fetchColumn() > 0) {
        echo "<table class='table table-light table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>id_proyecto</th>";
        echo "<th>localizacion</th>";
        echo "<th>valor</th>";
        echo "<th>tipo</th>";
        echo "<th>duracion</th>";
        echo "<th>descripcion</th>";
        echo "<th>planofinal</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        //while($row = mysqli_fetch_array($result)){
        foreach ($link->query($sql) as $row) {
            echo "<tr>";
            echo "<td>" . $row['ID_PROYECTO'] . "</td>";
            echo "<td>" . $row['LOCALIZACION'] . "</td>";
            echo "<td>" . $row['VALOR'] . "</td>";
            echo "<td>" . $row['TIPO'] . "</td>";
            echo "<td>" . $row['DURACION'] . "</td>";
            echo "<td>" . $row['DESCRIPCION'] . "</td>";
            echo "<td>" . $row['PLANOFINAL'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        $result->closeCursor();
    }
    echo "<p>Involucrados:<p>";
    $sql = "SELECT * FROM SOCIOSCOMERS where identi = $opcion";
    if ($result = $link->query($sql)) {
    if ($result->fetchColumn() > 0) {
        echo "<table class='table table-light table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Proyecto</th>";
        echo "<th>Usuario</th>";
        echo "<th>Socio comercial</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        //while($row = mysqli_fetch_array($result)){
        foreach ($link->query($sql) as $row) {
            echo "<tr>";
            echo "<td>" . $row['PROYECTO'] . "</td>";
            echo "<td>" . $row['USUARIO'] . "</td>";
            echo "<td>" . $row['SOCIO'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";

        echo "<a href='deletepry.php?id_ante_proyecto=" .  $row['IDENTI'] ."' class='btn btn-primary'> Eliminar </a>";
        echo "  ";
        echo "<a href='proyectos.php?' class='btn btn-primary'> Volver </a>";

        $result->closeCursor();
    }
    
}
    
}
?>
<hr>
                     
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