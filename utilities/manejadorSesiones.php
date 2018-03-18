<?php
session_cache_limiter();
session_name('login');
session_start();

$_SESSION["tipo"]=$tipo;
$_SESSION["nombre"]=$nombre;
$_SESSION["id"]=$id;

?>