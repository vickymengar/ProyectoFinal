<?php
// Incluye el archivo de conexión a la base de datos
include('../backend/admin/conexion.php');

// Obtener la lista de artistas desde la base de datos
$query_artistas = "SELECT id_artista, apodo_artista FROM artista"; // Modificado para seleccionar solo id_artista y apodo
$result_artistas = mysqli_query($connect, $query_artistas);
$artistas = mysqli_fetch_all($result_artistas, MYSQLI_ASSOC);

// Supongamos que pasas el ID del álbum como parámetro GET
$album_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($album_id) {
    // Obtener información del álbum específico si se proporciona un ID
    $select = "SELECT * FROM musica WHERE id_album = $album_id";
    $query = mysqli_query($connect, $select);
    $album = mysqli_fetch_assoc($query);

} 
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

<body class="fondo2">


<!-- Navegador --->
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
                Albumes</a>
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


<!-- Contenido -->
<div class="container-md rounded mt-3 mb-5" id="container">
    <div class="row">
        <div class="col-12 text-center mt-5">
            <h2 class="text-dark">Registrar un álbum nuevo</h2>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-12 mt-5 mb-5">
            <img src="../img/album.png" width="150" height="150" class="d-inline-block align">
        </div>
    </div>
    <form action="../backend/albums/insert.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_album" value="<?php echo $album_id; ?>">
        <div class="row pad text-center">
            <div class="col-sm-4">
                <label for="artista">Artista</label><spam class="text-danger">*</spam>
                <select name="artista" id="artista" class="form-control" required>
                    <option value="">Selecciona un artista</option>
                    <?php
                    foreach ($artistas as $artista) {
                        $apodo_artista = $artista['apodo_artista'];
                        echo "<option value='{$artista['id_artista']}'>$apodo_artista</option>";
                    }
                    ?>
                </select>
                <label id="text-error-artist" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label for="nombre_cancion">Nombre de la canción</label><spam class="text-danger">*</spam>
                <input type="text" name="nombre_cancion" class="form-control" id="nombre_cancion" placeholder="Nombre de la canción" required>
                <label id="text-error-cancion" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label for="nombre_album">Nombre del álbum</label><spam class="text-danger">*</spam>
                <input type="text" name="nombre_album" class="form-control" id="nombre_album" placeholder="Nombre del Álbum" required>
                <label id="text-error-album" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label for="genero_album">Género del álbum</label><spam class="text-danger">*</spam>
                <input type="text" name="genero_album" class="form-control" id="genero_album" placeholder="Género del Álbum" required>
                <label id="text-error-genero" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label for="imagen_album">Imagen del álbum</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="imagen_album" id="imagen_album" aria-describedby="inputGroupFileAddon01" accept="image/*">
                    <label class="custom-file-label" for="imagen_album">Seleccionar archivo</label>
                </div>
            </div>
            <div class="col-sm-4">
                <label for="link_spotify">Link de Spotify</label><spam class="text-danger">*</spam>
                <input type="text" name="link_spotify" class="form-control" id="link_spotify" placeholder="Link Spotify" required>
                <label id="text-error-spotify" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label for="link_apple">Link de Apple</label><spam class="text-danger">*</spam>
                <input type="text" name="link_apple" class="form-control" id="link_apple" placeholder="Link Apple" required>
                <label id="text-error-Apple" class="text-danger"></label>
            </div>
            <div class="col-sm-8">
                <label for="descripcion_album">Descripción del álbum</label>
                <textarea class="form-control" name="descripcion_album" id="descripcion_album" placeholder="Ingresa la descripción del álbum aquí..."></textarea>
                <label id="text-error-desc" class="text-danger"></label>
            </div>
            </div>
            <!-- Botones -->
            <div class="row pad">
                <div class="col-md-12 text-center mb-3">
                    <button class="btn bg-registroalbum text-light" type="submit" value="" onclick="validarart();">Registrar</button>
                    <button class="btn bg-dark text-light" type="reset" value="" onclick="limpiarart();">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/captura.js"></script>
</body>

</html>
