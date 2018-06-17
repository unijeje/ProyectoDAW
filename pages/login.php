<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Conectarse");
navBar();

?>

<div id="registrado" class="col-lg-6">
    <h2>Conectado correctamente</h2>
</div>

<div id="registroError" class="col-lg-6">
    <h2 class="text-center"></h2>
</div>
<br>
<div id="conectarse" class="row">
    <div class="col-lg-12 ">
        <h1>Conectarse </h1>
        <form name="formConectarse" id="formConectarse" method="get" action"#"> 
        <div class="form-group">
            <label class="offset-1 offset-lg-0" for="usuario">Usuario:</label>
            <input type="text" class="form-control col-lg-6 col-10 offset-1 offset-lg-0" id="usuario" placeholder="Introduce nombre de usuario" name="usuario">
        </div>
        <div class="form-group">
            <label class="offset-1 offset-lg-0" for="pass">Contraseña:</label>
            <input type="password" class="form-control col-lg-6 col-10 offset-1 offset-lg-0" id="pass" placeholder="Introduce contraseña" name="pass">
        </div>
        <div class="form-check">
        <label class="form-check-label offset-1 offset-lg-0">
            <input id="recordar" name="recordar" type="checkbox" class="form-check-input" value="">Conectar Automaticamente
        </label>
        </div>
        <br>
        <input type="button" id="btnConectar" class="btn btn-primary col-lg-6 col-10 offset-1 offset-lg-0" value="Conectarse" />
        </form>
    </div>   
</div>
<script type="text/javascript" src="../js/conectarse.js"></script>
<?php
pie();
?>