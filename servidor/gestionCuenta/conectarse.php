﻿<?php

include_once("../bbdd.php");

$oDatos=json_decode($_GET['datos']);
$usuario=$oDatos->nombre;
$pass=$oDatos->pass;

$miconexion=connectDB();

$sql="SELECT id, nombre, password, tipo, clave from cuentas where NOMBRE=? and ACTIVO=1";
$select=$miconexion->prepare($sql);
$select->execute(array($usuario));
$fila=$select->fetch(PDO::FETCH_ASSOC);

//$fila=consultaUnica($sql);


$tipo=$fila["tipo"];
$claveEncriptada=$fila["password"];
$nombre=$fila["nombre"];
$id=$fila["id"];
$clave=$fila["clave"];

if(isset($tipo))
{

    if(crypt($pass, $claveEncriptada)==$claveEncriptada)
    {
        $exito=true;
        $mensaje=$tipo;
        include("../../utilities/manejadorSesiones.php");
    }
    else
    {
        $exito=false;
        $mensaje="Contraseña Incorrecta";
    }

}
else
{
    $exito = false;
    $mensaje="No se ha encontrado el usuario";
}

$select=null;
$miconexion=null;
$respuesta=array($exito, $mensaje, $nombre, $id, $clave);

echo json_encode($respuesta); 

?>