<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Busqueda");
navBar();
include_once("../servidor/bbdd.php");
include('../utilities/paginator.php');
include("../modelo/busqueda.php");


if(isset($_GET["j"]))
{
    $busqueda = $_GET["j"];
    $tipo = "j";
}

else if(isset($_GET["c"]))
{
    $busqueda = $_GET["c"];
    $tipo = "c";
}
else if(isset($_GET["s"]))
{
    $busqueda = $_GET["s"];
    $tipo = "s";
}
else if(isset($_GET["p"]))
{
    $busqueda = $_GET["p"];
    $tipo = "p";
}
else if(isset($_GET["u"]))
{
    $busqueda = $_GET["u"];
    $tipo = "u";
}
else if(isset($_GET["a"]))
{
    $busqueda = $_GET["a"];
    $tipo = "a";
}


$listado = new Busqueda($tipo, $busqueda);

// echo "<pre>";
// print_r($listado->datos);
// echo "</pre>";

?>