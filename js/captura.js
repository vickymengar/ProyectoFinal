console.log("captura.js");

        function validarart() {
            let nombre = document.getElementById('nombre').value;
            let nom = document.getElementById('nom').value;
            let app = document.getElementById('app').value;
            let desc = document.getElementById('desc').value;
            console.log(nombre);
            console.log(nom);
            console.log(app);
            console.log(desc);

          // Agregar el resto de las variables que necesites validar

    if (nombre == '') {
        document.getElementById('text-error-nombre').innerHTML = ('El nombre es requerido');
    } else {
        document.getElementById('text-error-nombre').innerHTML = '';
    }

    if (nom == '') {
        document.getElementById('text-error-nom').innerHTML = ('El apellido paterno es requerido');
    } else {
        document.getElementById('text-error-nom').innerHTML = '';
    }

    if (app == '') {
        document.getElementById('text-error-app').innerHTML = ('El apellido materno es requerido');
    } else {
        document.getElementById('text-error-app').innerHTML = '';
    }
    if ( desc == '') {
        document.getElementById('text-error-desc').innerHTML = ('La descripción esta vacia');
    } else {
        document.getElementById('text-error-desc').innerHTML = '';
    }

        }

        function limpiarart(){
            // Limpiar mensajes de error
            document.getElementById('text-error-nombre').innerHTML = '';
            document.getElementById('text-error-nom').innerHTML = '';
            document.getElementById('text-error-app').innerHTML = '';
            document.getElementById('text-error-desc').innerHTML = '';
    
            // Limpiar valores de los campos
            document.getElementById('nombre').value = '';
            document.getElementById('nom').value = '';
            document.getElementById('app').value = '';
            document.getElementById('desc').value = '';
        }


function validaralb() {
    let artista = document.getElementById('artista').value;
    let titulo = document.getElementById('titulo_musica').value;
    let nombreAlbum = document.getElementById('album').value;
    let spotify = document.getElementById('Spotify').value;
    let apple = document.getElementById('Apple').value;
    let desc = document.getElementById('desc').value;

    // Agregar el resto de las variables que necesites validar

    if (artista == '') {
        document.getElementById('text-error-artist').innerHTML = 'Selecciona un artista';
    } else {
        document.getElementById('text-error-artist').innerHTML = '';
    }

    if (titulo == '') {
        document.getElementById('text-error-titulo_musica').innerHTML = 'El título de la música es requerido';
    } else {
        document.getElementById('text-error-titulo_musica').innerHTML = '';
    }

    if (nombreAlbum == '') {
        document.getElementById('text-error-album').innerHTML = 'El nombre del álbum es requerido';
    } else {
        document.getElementById('text-error-album').innerHTML = '';
    }

    if (spotify == '') {
        document.getElementById('text-error-spotify').innerHTML = 'El enlace de Spotify es requerido';
    } else {
        document.getElementById('text-error-spotify').innerHTML = '';
    }

    if (apple == '') {
        document.getElementById('text-error-Apple').innerHTML = 'El enlace de Apple es requerido';
    } else {
        document.getElementById('text-error-Apple').innerHTML = '';
    }

    if (desc == '') {
        document.getElementById('text-error-desc').innerHTML = 'La descripción del álbum es requerida';
    } else {
        document.getElementById('text-error-desc').innerHTML = '';
    }
}   

function limpiaralb() {
    // Limpiar mensajes de error
    document.getElementById('text-error-artist').innerHTML = '';
    document.getElementById('text-error-ap').innerHTML = '';
    document.getElementById('text-error-am').innerHTML = '';
    document.getElementById('text-error-spotify').innerHTML = '';
    document.getElementById('text-error-Apple').innerHTML = '';
    document.getElementById('text-error-desc').innerHTML = '';

    // Limpiar valores de los campos
    document.getElementById('artista').value = '';
    document.getElementById('ap').value = '';
    document.getElementById('am').value = '';
    document.getElementById('Spotify').value = '';
    document.getElementById('Apple').value = '';
    document.getElementById('desc').value = '';
}

function actualizaralb() {
    // Obtener datos del formulario
    var formData = $('form').serialize();

    // Enviar solicitud AJAX al servidor
    $.post('../backend/albums/actualizar.php', formData, function(response) {
        // Manejar la respuesta del servidor
        var data = JSON.parse(response);

        if (data.status === 'success') {
            alert(data.message);
            // Puedes realizar otras acciones después de una actualización exitosa
        } else {
            alert(data.message);
            // Puedes manejar errores o mostrar un mensaje de error al usuario
        }
    });
}
