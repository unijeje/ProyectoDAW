<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");
include('../utilities/paginator.php');
$id_plat=$_GET["id"];

include("../modelo/plataforma.php");

$plataforma = new Plataforma($id_plat);

cabecera($plataforma->getNombre());
navBar();
?>