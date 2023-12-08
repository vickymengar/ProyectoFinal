<?php
include('../admin/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['borrar'])) {
        // Si se hizo clic en el botón de borrar
        $id_artista = $_POST['id_artista'];

        // Realiza la operación de borrado en la base de datos
        $delete_query = "DELETE FROM artista WHERE id_artista = " . intval($id_artista);
        $result = mysqli_query($connect, $delete_query);

        if ($result) {
            echo '<script> alert("Artista eliminado correctamente"); </script>';
            echo '<script> window.location = "../../index.php"; </script>';
        } else {
            echo '<script> alert("Error al eliminar el artista"); </script>';
            echo '<script> window.location = "../../index.php"; </script>';
        }
    } else {
        // Si no se hizo clic en el botón de borrar, procede con la actualización
        // Recibir datos del formulario
        $id_artista = $_POST['id_artista'];
        $nombre_artista = $_POST['nombre'];
        $apellido_Paterno = $_POST['app'];
        $apellido_Materno = $_POST['apm'];
        $nacionalidad_artista = $_POST['nacionalidad'];
        $apodo_artista = $_POST['apodo'];
        $biografia_artista = $_POST['descripcion'];
        $imagen_artista = $_POST['imagen'];

        // Puedes realizar validaciones adicionales aquí si es necesario

        // Actualizar la información en la base de datos
        $update_query = "UPDATE artista SET
            nombre_artista = '$nombre_artista',
            apellido_Paterno = '$apellido_Paterno',
            apellido_Materno = '$apellido_Materno',
            nacionalidad_artista = '$nacionalidad_artista',
            apodo_artista = '$apodo_artista',
            biografia_artista = '$biografia_artista',
            imagen_artista = '$imagen_artista'
            WHERE id_artista = " . intval($id_artista);

        $result = mysqli_query($connect, $update_query);

        if ($result) {
            echo '<script> alert("Artista actualizado correctamente"); </script>';
            echo '<script> window.location = "../../index.php"; </script>';
        } else {
            echo '<script> alert("Error al actualizar el artista"); </script>';
            echo '<script> window.location = "../../index.php"; </script>';
        }
    }
} else {
    echo '<script> alert("No está permitido esto"); </script>';
    echo '<script> window.location = "../../index.php"; </script>';
}

mysqli_close($connect);
?>
