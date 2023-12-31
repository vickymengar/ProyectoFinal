<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Rhythmhub</title>
    <link rel="stylesheet" href="../css/estilos.css"> 
    <link rel="icon" href="../img/nota-musical.png" type="icono">
    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
</head>

<body class="fondo3">

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

<!-- Contenido --->
<div class="container-md rounded mt-3 mb-5" id="container">
    <div class="row">
        <div class="col-12 text-center mt-5">  
            <h2 class="text-dark">Registrar nuevo artista</h2>
        </div>
    </div>
    <div class="row text-center mt-5">
        <div class="col-md-12 mt-3 mb-5">  
            <img src="../img/escucha.png" width="150" height="150" class="d-inline-block align"> 
        </div>
    </div> 
    <form action="../backend/artistas/insert.php" method="POST" enctype="multipart/form-data">
        <div class="row pad text-center">
            <div class="col-sm-4">
                <label for="nombre">Nombre</label><spam class="text-danger">*</spam>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                <label id="text-error-nombre" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label for="nom">Apellido paterno</label><spam class="text-danger">*</spam>
                <input type="text" name="app" class="form-control" id="app" placeholder="Apellido Paterno" required>
                <label id="text-error-app" class="text-danger"></label>
            </div>
            <div class="col-sm-4">
                <label for="app">Apellido materno</label>
                <input type="text" name="apm" class="form-control" id="apm" placeholder="Apellido Materno">
                <label id="text-error-apm" class="text-danger"></label>
            </div> 
            <div class="col-sm-4">
                <label for="app">Nacionalidad</label><spam class="text-danger">*</spam>
                <input type="text" name="nacionalidad" class="form-control" id="nacionalidad" placeholder="Nacionalidad" required>
                <label id="text-error-nacionalidad" class="text-danger"></label>
            </div> 
            <div class="col-sm-4">
                <label for="app">Apodo</label>
                <input type="text" name="apodo" class="form-control" id="apodo" placeholder="Apodo">
                <label id="text-error-apodo" class="text-danger"></label>
            </div> 
            <div class="col-sm-4">
                <label>Imagen del artista</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="imagen" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept="image/*">
                    <label class="custom-file-label" for="inputGroupFile01">Seleccionar archivo</label>
                </div>
            </div>
            <div class="col-sm-12">
                <label for="desc">Biografía del artista</label>
                <textarea class="form-control" name="descripcion" placeholder="Ingresa la biografía del artista aquí..." id="desc"></textarea>
                <label id="text-error-desc" class="text-danger"></label>
            </div>
        </div> 
        <!-- Botones -->
        <div class="row pad text-center">
            <div class="col-sm-12 mb-3">
                <button class="btn bg-registroartista text-light" type="submit" value="" onclick="validarart();">Registrar</button>
                <button class="btn bg-dark text-light" type="reset" value="" onclick="limpiarart();">Limpiar</button>
            </div>
        </div>
    </form>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/captura.js"></script>
</body>
</html>
