<?php

include_once("bbdd.php");

$oDatos=json_decode($_GET['datos']);
$usuario=$oDatos->nombre;
$pass=$oDatos->pass;

$sql="SELECT nombre, password, tipo from cuentas where NOMBRE='$usuario'";

$resultset=ejecutaConsulta($sql);

$fila=$resultset->fetch(PDO::FETCH_ASSOC);

$tipo=$fila["tipo"];
$claveEncriptada=$fila["password"];
$nombre=$fila["nombre"];

if(isset($tipo))
{

    if(crypt($pass, $claveEncriptada)==$claveEncriptada)
    {
        $exito=true;
        $mensaje=$tipo;
        include("../utilities/manejadorSesiones.php");
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

$respuesta=array($exito, $mensaje, $nombre);

echo json_encode($respuesta); 

?>