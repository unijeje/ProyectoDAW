<?php
session_cache_limiter();
session_name('login');
session_start();

$oDatos=json_decode($_GET['datos']);
$nombre=$oDatos->nombre;
$tipo=$oDatos->tipo;

$_SESSION["tipo"]=$tipo;
$_SESSION["nombre"]=$nombre;

?>