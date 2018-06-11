<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");

if(isset($_GET["id"]))
{
    $id=$_GET["id"];
    
    if($_SESSION["tipo"] == 1)
    {
        $administrador=true;
    }
    else
    {
        $administrador = false;
    }
}
else if (isset($_SESSION["id"]))
{
    $usuario=$_SESSION["nombre"];
    $id= $_SESSION["id"];
    $administrador = false;  
}
else
{
    header('Location: login.php');
}

include("../modelo/perfil.php");

$perfil = new Perfil($id);

// echo $perfil->usuario."<br>";
// echo $perfil->fecha."<br>";
// echo $perfil->email."<br>";
// echo $perfil->numTotal."<br>";

cabecera($perfil->usuario);
navBar();



?>