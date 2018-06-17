<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");
include('../utilities/paginator.php');
$id_plat=$_GET["id"];

include("../modelo/plataforma.php");

$plataforma = new Plataforma($id_plat);


if($plataforma->getNombre() == null || trim($plataforma->getNombre()) == "" )
{
    header("Location: notfound.php");
}


cabecera($plataforma->getNombre());
navBar();
?>