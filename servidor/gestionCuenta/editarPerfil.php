<?php

include_once("../bbdd.php");
$sql="SELECT email, registro from cuentas where NOMBRE='$usuario'";
$fila=consultaUnica($sql);
?>