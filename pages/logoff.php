﻿<?php

include("../utilities/utilities.php");
iniciarSesion();
unset($_SESSION['tipo']);
unset($_SESSION['nombre']);
session_destroy();

cabecera("VideoJuegos BBDD");
navBar();
?>

<script type="text/javascript">
    $(document).ready(function() {
        document.cookie = "tipo=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "nombre=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    });

</script>

<?php


//header("Location: ../index.php");


echo "<h2>Ha salido de sesión</h2>";

pie();
?>