<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Registrarse");
navBar();
?>

<div id="registrado">
    <h2>Su cuenta se ha creado correctamente</h2>
    <a href="login.php"> Conectarse </a>
</div>

<div id="registroError">
    <h2 class="text-danger">Ha habido un error al registrar la cuenta </h2>
</div>
<br>
<div id="formCrearCuenta" class="row">
    <div class="col-12 ">
        <h1>Crear Cuenta </h1>
        <form name="altaCuenta" id="altaCuenta"> 
        <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control col-6" id="usuario" placeholder="Introduce nombre de usuario" name="usuario">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control col-6" id="email" placeholder="Introduce email" name="email">
            </div>
            <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input type="password" class="form-control col-6" id="pass" placeholder="Introduce contraseña" name="pass">
            </div>
            <div class="form-group">
                <label for="pass2">Repite Cotnraseña:</label>
                <input type="password" class="form-control col-6" id="pass2" placeholder="Introduce contraseña" name="pass2">
            </div>
            <br>
            <input type="button" id="crear" class="btn btn-primary col-6" value="Crear" />
        </form>
    </div>   
</div>



<script type="text/javascript" src="../js/registrarse.js"></script>

<?php
pie();
?>

