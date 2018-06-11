<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Compañías");
navBar();
include_once("../servidor/bbdd.php");
include('../utilities/paginator.php');
include("../modelo/listadoCompany.php");

$listado = new ListaCompany();

$filaCompany = $listado->getListadoCompany();

// $resPorTabla = $listado->numResultados/3;

?>