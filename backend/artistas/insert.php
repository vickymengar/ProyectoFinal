<?php
// Incluir el archivo de conexión
include('../admin/conexion.php');

// Obtener los datos del formulario
$nombre = $_POST["nombre"];
$app = $_POST["app"];
$apm = $_POST["apm"];
$nacionalidad = $_POST["nacionalidad"];
$apodo = $_POST["apodo"];
$descripcion = $_POST["descripcion"];

// Manejo de la carga de la imagen
$nombre_imagen = '';
if(isset($_FILES['imagen'])){
    $errors= array();
    $nombre_imagen = $_FILES['imagen']['name'];
    $file_size = $_FILES['imagen']['size'];
    $file_tmp = $_FILES['imagen']['tmp_name'];
    $file_type = $_FILES['imagen']['type'];
    $file_ext = strtolower(end(explode('.',$_FILES['imagen']['name'])));
    
    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions) === false){
        $errors[]="Extensión no permitida, elige una imagen JPEG o PNG.";
    }
    
    if($file_size > 2097152){
        $errors[]='El tamaño del archivo debe ser menor a 2 MB';
    }
    
    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"../../img/album/".$nombre_imagen);
        echo "Imagen subida con éxito";
    }else{
        print_r($errors);
    }
}

// Verificar si el artista ya está registrado
$consulta_existencia = "SELECT * FROM artista WHERE nombre_artista = '$nombre'";
$resultado_existencia = mysqli_query($connect, $consulta_existencia);

if (mysqli_num_rows($resultado_existencia) > 0) {
    // El artista ya está registrado, muestra un mensaje de error
    echo '<script> alert("El artista ya está registrado"); </script>';
    echo '<script> window.location = "../../pages/artista.php"; </script>';
    mysqli_close($connect);
} else {
    // El artista no está registrado, procede a insertar en la base de datos
    $insert = "INSERT INTO artista (nombre_artista, apellido_Paterno, apellido_Materno, nacionalidad_artista, apodo_artista, biografia_artista, imagen_artista) VALUES ('$nombre', '$app', '$apm', '$nacionalidad', '$apodo', '$descripcion','$nombre_imagen')";
    $query = mysqli_query($connect, $insert);

    if (!$query) {
        echo '<script> alert("Error al registrar el artista"); </script>';
    } else {
        echo '<script> alert("Artista registrado exitosamente"); </script>';
    }

    echo '<script> window.location = "../../pages/artista.php"; </script>';
    mysqli_close($connect);
}
?>
