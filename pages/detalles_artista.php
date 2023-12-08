<?php
include('../backend/admin/conexion.php');

// Verificar si se ha proporcionado un ID de artista en la URL
$artista_id = isset($_GET['id']) ? $_GET['id'] : null;

// Verificar si se ha proporcionado un ID de artista válido
if ($artista_id) {
    // Consultar la base de datos para obtener los detalles del artista
    $consulta_artista = "SELECT * FROM artista WHERE id_artista = ?";
    $stmt_artista = mysqli_prepare($connect, $consulta_artista);
    mysqli_stmt_bind_param($stmt_artista, "i", $artista_id);
    mysqli_stmt_execute($stmt_artista);
    $result_artista = mysqli_stmt_get_result($stmt_artista);

    // Verificar si se encontraron detalles del artista
    if ($row_artista = mysqli_fetch_assoc($result_artista)) {
        // Almacena los detalles del artista en variables
        $nombre_artista = $row_artista['nombre_artista'];
        $apellido_paterno = $row_artista['apellido_Paterno'];
        $apellido_materno = $row_artista['apellido_Materno'];
        $nacionalidad_artista = $row_artista['nacionalidad_artista'];
        $apodo_artista = $row_artista['apodo_artista'];
        $biografia_artista = $row_artista['biografia_artista'];
        $imagen_artista = $row_artista['imagen_artista'];
    } else {
        // No se encontró ningún artista con el ID proporcionado
        echo "Artista no encontrado.";
        exit();
    }
} else {
    // No se proporcionó un ID de artista válido en la URL
    echo "ID de artista no proporcionado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>PLATAMIX</title>
    <link rel="stylesheet" href="../css/estilos.css"> 
    <link rel="icon" href="../img/logo.png" type="icono">
    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
</head>
<body>

<!-- Navegador --->
<nav class="navbar bg-personal-nav navbar-expand-lg navbar-light">
    <img src="../img/logo.png" width="50" height="50" class="d-inline-block align-top" alt="">
    <h5 class="navbar-brand">PlataMix</h5>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./album.php">Albumes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./artista.php">Artistas</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="GET" action="./resultado_busqueda.php">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" name="query">
            <button class="btn bg-personal my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </div>
</nav>
<br>
<!-- Contenido --->
<div class="container-fluid bg-light">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="text-dark">Detalles del artista</h2>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-12">
        <img src="../img/album/<?php echo $imagen_artista ? $imagen_artista : 'descargar.png'; ?>" width="150" height="150" class="d-inline-block align">
        </div>
    </div>
    <form action="../backend/artistas/update.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_artista" value="<?php echo $artista_id; ?>">
        <div class="row pad text-center">
            <div class="col-sm-4">
                <label for="nombre">Nombre</label><spam class="text-danger">*</spam>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre Artístico"
                    value="<?php echo $nombre_artista; ?>" required>
                <label id="text-error-nombre" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label for="nom">Apellido paterno</label><spam class="text-danger">*</spam>
                <input type="text" name="app" class="form-control" id="app" placeholder="Nombre"
                    value="<?php echo $apellido_paterno; ?>" required>
                <label id="text-error-app" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label for="app">Apellido materno</label>
                <input type="text" name="apm" class="form-control" id="apm" placeholder="Apellidos"
                    value="<?php echo $apellido_materno; ?>">
                <label id="text-error-apm" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label for="app">Nacionalidad</label><spam class="text-danger">*</spam>
                <input type="text" name="nacionalidad" class="form-control" id="nacionalidad" placeholder="Apellidos"
                    value="<?php echo $nacionalidad_artista; ?>" required>
                <label id="text-error-nacionalidad" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label for="app">Apodo</label>
                <input type="text" name="apodo" class="form-control" id="apodo" placeholder="Apellidos"
                    value="<?php echo $apodo_artista; ?>">
                <label id="text-error-apodo" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label>Imagen del artista</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="imagen" id="inputGroupFile01"
                        aria-describedby="inputGroupFileAddon01" accept="image/*">
                    <label class="custom-file-label" for="inputGroupFile01">Seleccionar archivo</label>
                </div>
            </div>
            <div class="col-sm-12">
                <label for="desc">Biografía del artista</label>
                <textarea class="form-control" name="descripcion" placeholder="Ingresa la biografía del artista aquí..."
                    id="desc" ><?php echo $biografia_artista; ?></textarea>
                <label id="text-error-desc" class="text-danger"></label>
            </div>
        </div>
        <!-- Botones -->
        <div class="row pad text-center">
            <div class="col-sm-12">
                <button class="btn bg-personal" type="submit" value="" onclick="actualizarart();">Actualizar</button>
                <button class="btn bg-danger text-light" type="submit" name="borrar" onclick="return confirm('¿Estás seguro de que deseas borrar este artista?');">Borrar</button>

            </div>
        </div>
    </form>
</div>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/formulario.js"></script>
</body>
</html>
