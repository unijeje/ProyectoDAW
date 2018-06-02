<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Usuarios");
navBar();
include_once("../servidor/bbdd.php");
$miconexion=connectDB();
include('../utilities/paginator.php');
include("../modelo/listadoUsuarios.php");

$listado = new ListaUsuario();

$filaCuentas = $listado->getListadoUsuarios();

$resPorTabla = $listado->numResultados/3;
?>