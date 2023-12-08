DROP DATABASE IF EXISTS music;
CREATE DATABASE IF NOT EXISTS music DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE music;

GRANT ALL PRIVILEGES ON music.* TO 'musicadmin'@'localhost' IDENTIFIED BY 'musicadmin123';


CREATE TABLE artista (
    id_artista INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_artista VARCHAR(50) NOT NULL,    
    apellido_Paterno VARCHAR(50) NOT NULL,
    apellido_Materno VARCHAR(50) NULL,
    nacionalidad_artista VARCHAR(50) NOT NULL,
    apodo_artista VARCHAR(50) NULL,
    biografia_artista TEXT NULL,
    imagen_artista VARCHAR(100) NULL
)ENGINE=InnoDB;

CREATE TABLE musica (
    id_album INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_musica VARCHAR(250) NOT NULL,
    nombre_album VARCHAR(250) NOT NULL,
    genero_album VARCHAR(45) NOT NULL,
    descripcion_album TEXT NULL,
    imagen_album VARCHAR(100) NULL,
    link_spotify VARCHAR(100) NOT NULL,
    link_apple VARCHAR(100) NOT NULL,
    id_artista INT(11) NOT NULL,
    FOREIGN KEY(id_artista) REFERENCES artista (id_artista) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB;
