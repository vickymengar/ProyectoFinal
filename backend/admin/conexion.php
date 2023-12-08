<?php
$SERVER = 'localhost';

$USER = 'musicadmin';

$PASSWORD = 'musicadmin123';

$DB =  'music';

$connect = mysqli_connect($SERVER,$USER,$PASSWORD,$DB);

if(!$connect){
    die("Error al conectarse con la Base de Datos".mysqli_connect_error());
    exit();
}

mysqli_query($connect,'SET NAMES "utf8"');

