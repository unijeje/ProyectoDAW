<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Plataformas");
navBar();
include_once("../servidor/bbdd.php");
include('../utilities/paginator.php');
include("../modelo/listadoPlat.php");

$listado = new ListaPlataforma();

$filaPlataforma = $listado->getListadoPlataforma();

$resPorTabla = $listado->numResultados/3;


?>