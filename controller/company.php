<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");
include('../utilities/paginator.php');
$id_company=$_GET["id"];
include("../modelo/company.php");


$company = new Company($id_company);


if($company->getNombre() == null || trim($company->getNombre()) == "" )
{
    header("Location: notfound.php");
}


cabecera($company->getNombre());
navBar();

?>