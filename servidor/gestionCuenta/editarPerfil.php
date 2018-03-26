<?php

include_once("../bbdd2.php");
//$sql="SELECT email, registro from cuentas where NOMBRE=?";
$fila = DB::run("SELECT email, registro from cuentas where NOMBRE=?", [$id])->fetch();

?>