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
    <h1 class="titulossn">Proyectos en desarollo</h1>
    </div>
    <hr>
    <div class="main">
<?php
    // Me coencto
    require_once "config.php";

    // select
    $sql = "SELECT * FROM muestraant";
    //nos aseguramos hayan datos
    if ($result = $link->query($sql)) {
        if ($result->fetchColumn() > 0) { 
          echo "<p class='lead'><em>Listado de proyectos</em></p>";
        } else {
          echo "<p class='lead'><em>No se tiene registros</em></p>";
        }
    } else {
        echo "ERROR: No se pudo ejecutar $sql. ";
    }
echo "<a href='ingantepro.php?' class='btn btn-primary'> Añadir </a>";
echo "<hr>";
echo "<div style='background-color:  black; margin:5px ;' class='row row-cols-5 centrar'>";
//Se comienzan a colocar los usuarios
foreach ($link->query($sql) as $row) {
echo "<div style='margin:10px ;' class='card text-center text-white bg-dark mb-3' style='width: 18rem;'>";
echo "<img src='images/proyecto.jpg' class='card-img-top' alt='...'>";
echo "<div class='card-body'>";
echo "<h5 class='card-title'>" . $row['ID_ANTE_PROYECTO']."</h5>";
echo "<h6 class='card-subtitle mb-2 text-muted'>Localizacion:</h6>";
echo "<h6 class='card-subtitle mb-2 text-muted'>" . $row['LOCALIZACION'] .      "</h6>";
echo "<h6 class='card-subtitle mb-2 text-muted'>Presupuesto:</h6>";
echo "<h6 class='card-subtitle mb-2 text-muted'>" . $row['PRESUPUESTO'] .      "</h6>";
echo "<h6 class='card-subtitle mb-2 text-muted'>Duracion:</h6>";
echo "<h6 class='card-subtitle mb-2 text-muted'>" . $row['DURACIONAPROX'] .      "</h6>";
echo " <p class='card-text'>" . $row['DESCRIPCION'] .      "</p>";

echo "<a href='proyectovermas.php?id_ante_proyecto=" .  $row['ID_ANTE_PROYECTO'] .
    "' class='btn btn-primary'> Ver status </a>";
echo "  ";

echo "</div>";
echo "</div>";
}  
echo "</div>";
echo "</table>";
?>                    
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