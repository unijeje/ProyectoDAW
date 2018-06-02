<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Personas");
navBar();
include_once("../servidor/bbdd.php");
$miconexion=connectDB();
include('../utilities/paginator.php');
include("../modelo/listadoStaff.php");

$listado = new ListaStaff();

$filaStaff = $listado->getListadoPersonas();

$resPorTabla = $listado->numResultados/3;
?>