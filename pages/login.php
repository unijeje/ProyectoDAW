<?php

include("../utilities/utilities.php");
cabecera("Conectarse");
iniciarSesion();
navBar();

?>

<div id="registrado" class="col-6">
    <h2>Conectado correctamente</h2>
</div>

<div id="registroError" class="col-6">
    <h2 class="text-center"></h2>
</div>
<br>
<div id="conectarse" class="row">
    <div class="col-12 ">
        <h1>Conectarse </h1>
        <form name="formConectarse" id="formConectarse" method="get" action"#"> 
        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" class="form-control col-6" id="usuario" placeholder="Introduce nombre de usuario" name="usuario">
        </div>
        <div class="form-group">
            <label for="pass">Contraseña:</label>
            <input type="password" class="form-control col-6" id="pass" placeholder="Introduce contraseña" name="pass">
        </div>
        <div class="form-check">
        <label class="form-check-label">
            <input id="recordar" name="recordar" type="checkbox" class="form-check-input" value="">Conectar Automaticamente
        </label>
        </div>
        <br>
        <input type="button" id="btnConectar" class="btn btn-primary col-6" value="Conectarse" />
        </form>
    </div>   
</div>
<script type="text/javascript" src="../js/conectarse.js"></script>
<?php
pie();
?>