<?php
include('../backend/admin/conexion.php');

$consulta = "SELECT musica.*, artista.apodo_artista, artista.nombre_artista
            FROM musica
            INNER JOIN artista ON musica.id_artista = artista.id_artista";

// Obtener el término de búsqueda de la variable GET
$query = isset($_GET['query']) ? $_GET['query'] : null;

if ($query) {
    // Añadir condiciones de búsqueda a la consulta
    $consulta .= " WHERE nombre_musica LIKE '%$query%'
                OR apodo_artista LIKE '%$query%'
                OR nombre_album LIKE '%$query%'";
}

$resultadoConsulta = mysqli_query($connect, $consulta);

$canciones = array();

while ($cancion = mysqli_fetch_assoc($resultadoConsulta)) {
    $canciones[] = $cancion;
}

$idAlbum = isset($_GET['id']) ? $_GET['id'] : null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Rhythmhub</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="icon" href="../img/nota-musical.png" type="icono">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body class="fondo4">

<nav class="navbar bg-personal-nav navbar-expand-lg navbar-light">
    <div class="d-flex align-items-center">
        <img src="../img/nota-musical.png" width="50" height="50" class="d-inline-block align-top" alt="">
        <h5 class="navbar-brand mb-0 ml-2">Rhythmhub</h5>
   </div>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="../index.php">
                <img src="../img/tienda-de-musica.gif" width="30" height="30" class="d-inline-block align-top mr-2" alt="">
                Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="./album.php">
                <img src="../img/discos-compactos.gif" width="30" height="30" class="d-inline-block align-top mr-2" alt="">
                Álbumes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="./artista.php">
                <img src="../img/ventilador.gif" width="30" height="30" class="d-inline-block align-top mr-2" alt="">
                Artistas</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="GET" action="./resultado_busqueda.php">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" name="query">
            <button class="btn bg-personal my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </div>
</nav>
<br>

<div class="container-fluid rounded mt-3 mb-5" id="container" >
    <?php if ($idAlbum) { ?>
        <!-- Sección para el caso de visualización de un álbum específico -->
    <?php } else { ?>
        <br>
        <h1 class="bg-light rounded text-center text-dark mb-3 p-3">Resultados de búsqueda</h1>
        <?php if (empty($canciones)) { ?>
            <p class="text-center text-danger">No se encontraron resultados para la búsqueda.</p>
        <?php } else { ?>
            <div class="row">
                <?php foreach ($canciones as $cancion) { ?>
                    <div class="col-md-6">
                        <div class="card bg-secondary mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="../img/album/<?php echo $cancion['imagen_album']; ?>" class="card-img"
                                        alt="Imagen del álbum">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h3 class="card-title text-light"><?php echo $cancion['nombre_musica']; ?></h3>
                                        <h5 class="card-text text-light"><?php echo $cancion['apodo_artista']; ?></h5>
                                        <p class="card-text text-light"><?php echo $cancion['nombre_album']; ?></p>
                                        <a href="<?php echo $cancion['link_spotify']; ?>" class="btn btn-success">Spotify</a>
                                        <a href="<?php echo $cancion['link_apple']; ?>"
                                        class="btn text-danger btn-light">Apple Music</a>
                                        <a href="./detalles_album.php?id=<?php echo $cancion['id_album']; ?>"
                                        class="btn btn-dark">Detalles Álbum</a>
                                        <a href="./detalles_artista.php?id=<?php echo $cancion['id_artista']; ?>"
                                        class="btn btn-dark">Detalles Artista</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    <?php } ?>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/formulario.js"></script>
</body>

</html>
