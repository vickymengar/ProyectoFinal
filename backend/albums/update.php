<?php
include('../admin/conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['borrar'])) {
        // Si se hizo clic en el botón de borrar
        $id_album = $_POST['id_album'];

        // Realiza la operación de borrado en la base de datos
        $delete_query = "DELETE FROM musica WHERE id_album = " . intval($id_album);
        $result = mysqli_query($connect, $delete_query);

        if ($result) {
            echo '<script> alert("Álbum eliminado correctamente"); </script>';
            echo '<script> window.location = "../../index.php"; </script>';
        } else {
            echo '<script> alert("Error al eliminar el álbum"); </script>';
            echo '<script> window.location = "../../index.php"; </script>';
        }
    } else {
        // Si no se hizo clic en el botón de borrar, procede con la actualización
        // Resto del código para la actualización...

        // Recibir datos del formulario
        $id_album = $_POST['id_album'];
        $id_artista = $_POST['artista'];
        $nombre_cancion = $_POST['nombre_cancion'];
        $nombre_album = $_POST['nombre_album'];
        $genero_album = $_POST['genero_album'];
        $link_spotify = $_POST['link_spotify'];
        $link_apple = $_POST['link_apple'];
        $imagen_album = $_POST['imagen_album'];
        $descripcion_album = $_POST['descripcion_album'];

        // Puedes realizar validaciones adicionales aquí si es necesario

        // Actualizar la información en la base de datos
        $update_query = "UPDATE musica SET
            id_artista = '$id_artista',
            nombre_musica = '$nombre_cancion',
            nombre_album = '$nombre_album',
            genero_album = '$genero_album',
            imagen_album = '$imagen_album',
            link_spotify = '$link_spotify',
            link_apple = '$link_apple',
            descripcion_album = '$descripcion_album'
            WHERE id_album = " . intval($id_album);

        $result = mysqli_query($connect, $update_query);

        if ($result) {
            echo '<script> alert("Álbum actualizado correctamente"); </script>';
            echo '<script> window.location = "../../index.php"; </script>';
        } else {
            echo '<script> alert("Error al actualizar el álbum"); </script>';
            echo '<script> window.location = "../../index.php"; </script>';
        }
    }
} else {
    echo '<script> alert("No está permitido esto"); </script>';
    echo '<script> window.location = "../../index.php"; </script>';
}

mysqli_close($connect);
?>