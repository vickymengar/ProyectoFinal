<?php
// Incluir el archivo de conexión a la base de datos
include('./backend/admin/conexion.php');

// Consulta SQL para obtener información de álbumes y artistas
$selecte = "SELECT musica.*, artista.apodo_artista, artista.nombre_artista
FROM musica
INNER JOIN artista ON musica.id_artista = artista.id_artista";

// Ejecutar la consulta
$query = mysqli_query($connect, $selecte);

// Inicializar un array para almacenar la información de los álbumes
$albumes = array();

// Recorrer los resultados de la consulta y almacenarlos en el array $albumes
while ($album = mysqli_fetch_assoc($query)) {
    $albumes[] = $album;
}

// Obtener el ID del álbum de la variable GET
$album_id = isset($_GET['id']) ? $_GET['id'] : null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Rhythmhub</title>
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="icon" href="./img/nota-musical.png" type="icono">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body class="fondo1">

<!-- Navegador --->
<nav class="navbar bg-personal-nav navbar-expand-lg navbar-light">
    <div class="d-flex align-items-center">
        <img src="./img/nota-musical.png" width="50" height="50" class="d-inline-block align-top mr-2" alt="">
        <h5 class="navbar-brand mb-0">Rhythmhub</h5>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="./index.php">
                    <img src="./img/tienda-de-musica.gif" width="30" height="30" class="d-inline-block align-top mr-2" alt="">
                    Inicio
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="./pages/album.php">
                    <img src="./img/discos-compactos.gif" width="30" height="30" class="d-inline-block align-top mr-2" alt="">
                    Albumes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="./pages/artista.php">
                    <img src="./img/ventilador.gif" width="30" height="30" class="d-inline-block align-top mr-2" alt="">
                    Artistas
                </a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="GET" action="./pages/resultado_busqueda.php">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" name="query">
            <button class="btn bg-personal my-2 my-sm-0" type="submit" id="btnsearch">Buscar</button>
        </form>
    </div>
</nav>
<br>

<br>

<!-- Banner --->
<div class="container-fluid text-center">
    <!-- Imagen del banner -->
    <img src="" class="w-25" alt="imagen1">
    <br>
    <!-- Título del banner -->
    <h1>Sinfonía de sonidos, un repositorio de emociones</h1>
</div>
<br>
<!-- Contenido --->
<div class="container-fluid">
    <?php if ($album_id) { ?>
        <!-- Sección para el caso de visualización de un álbum específico -->
    <?php } else { ?>
        <!-- Sección para la lista de todos los álbumes -->
        <h1 class="bg-dark text-center text-light mb-3">Checa nuestro repositorio</h1>
        <div class="row">
            <?php foreach ($albumes as $album) { ?>
                <div class="col-md-6">
                    <!-- Tarjeta de presentación de un álbum -->
                    <div class="card bg-secondary mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4 text-center">
                            <!-- Imagen del álbum -->
                            <img src="./img/album/<?php echo $album['imagen_album'] ? $album['imagen_album'] : 'descargar.png'; ?>" class="mx-auto" alt="Imagen del álbum">

                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <!-- Nombre de la canción -->
                                    <h3 class="card-title text-light"><?php echo $album['nombre_musica']; ?></h3>
                                    <!-- Apodo del artista -->
                                    <h5 class="card-text text-light"><?php echo $album['apodo_artista']; ?></h5>
                                    <!-- Nombre del álbum -->
                                    <p class="card-text text-light"><?php echo $album['nombre_album']; ?></p>
                                    <!-- Enlaces a plataformas de música -->
                                    <a href="<?php echo $album['link_spotify']; ?>" class="btn btn-success">Spotify</a>
                                    <a href="<?php echo $album['link_apple']; ?>"
                                        class="btn text-danger btn-light">Apple Music</a>
                                    <!-- Enlace para ver detalles del álbum -->
                                    <a href="./pages/detalles_album.php?id=<?php echo $album['id_album']; ?>"
                                        class="btn btn-dark">Detalles Álbum</a>
                                    <!-- Nuevo botón para ver detalles del artista -->
                                    <a href="./pages/detalles_artista.php?id=<?php echo $album['id_artista']; ?>"
                                        class="btn btn-dark">Detalles Artista</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>


<!-- Incluir scripts JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/captura.js"></script>
</body>

</html>
