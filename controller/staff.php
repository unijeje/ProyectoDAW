<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");
$id_staff=$_GET["id"];
include('../utilities/paginator.php');
include("../modelo/staff.php");

$staff = new Staff($id_staff);

if($staff->getNombre() == null || trim($staff->getNombre()) == "" )
{
    header("Location: notfound.php");
}


cabecera($staff->getNombre());
navBar();
?>