<?php
include("utilities/utilities.php");
iniciarSesion();
cabeceraIndex("VideoJuegos BBDD");
navBarIndex();

$miconexion=connectDB();
include("modelo/index.php");
$datos = new Datos();


?>