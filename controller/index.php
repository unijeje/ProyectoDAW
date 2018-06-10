<?php
include("utilities/utilities.php");
cabeceraIndex("VideoJuegos BBDD");
iniciarSesion();
navBarIndex();

$miconexion=connectDB();
include("modelo/index.php");
$datos = new Datos();




?>