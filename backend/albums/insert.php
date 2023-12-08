<?php
include('../admin/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_artista = $_POST["artista"];
    $nombre_cancion = $_POST["nombre_cancion"];
    $nombre_album = $_POST["nombre_album"];

    // Verificación de canción duplicada en el álbum específico
    $consulta_existencia = "SELECT * FROM musica WHERE nombre_musica = ? AND nombre_album = ?";
    $stmt_existencia = mysqli_prepare($connect, $consulta_existencia);
    mysqli_stmt_bind_param($stmt_existencia, "ss", $nombre_cancion, $nombre_album);
    mysqli_stmt_execute($stmt_existencia);
    mysqli_stmt_store_result($stmt_existencia);

    // Verificación de álbum existente
    $consulta_existencia_album = "SELECT * FROM musica WHERE nombre_album = ?";
    $stmt_existencia_album = mysqli_prepare($connect, $consulta_existencia_album);
    mysqli_stmt_bind_param($stmt_existencia_album, "s", $nombre_album);
    mysqli_stmt_execute($stmt_existencia_album);
    mysqli_stmt_store_result($stmt_existencia_album);

    if (mysqli_stmt_num_rows($stmt_existencia) > 0 && mysqli_stmt_num_rows($stmt_existencia_album) > 0) {
        // Canción y/o álbum ya registrados
        echo '<script> alert("La canción y/o el álbum ya están registrados previamente"); </script>';
        echo '<script> history.go(-1); </script>';
        mysqli_close($connect);
    } else {
        // Resto del código para la inserción
        $genero_album = $_POST["genero_album"];
        $descripcion_album = $_POST["descripcion_album"];

        // Maneja la imagen (ajusta según tus necesidades)
        $imagen_album = $_POST["imagen_album"];

        $link_spotify = $_POST["link_spotify"];
        $link_apple = $_POST["link_apple"];

        // Prepara la consulta de inserción
        $insert_query = "INSERT INTO musica (nombre_musica, nombre_album, genero_album, descripcion_album, imagen_album, link_spotify, link_apple, id_artista) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($connect, $insert_query);
        mysqli_stmt_bind_param($stmt_insert, "sssssssi", $nombre_cancion, $nombre_album, $genero_album, $descripcion_album, $imagen_album, $link_spotify, $link_apple, $id_artista);
        $result = mysqli_stmt_execute($stmt_insert);

        if ($result) {
            echo '<script> alert("Canción registrada exitosamente"); </script>';
            echo '<script> window.location = "../../pages/album.php"; </script>';
        } else {
            echo '<script> alert("Error al registrar la canción"); </script>';
            echo '<script> window.location = "../../pages/album.php"; </script>';
        }

        // Cierra la conexión a la base de datos
        mysqli_close($connect);
    }
}
?>
