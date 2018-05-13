<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Añadir Staff");
navBar();
?>

<div id="registrado" class="col-6">
    <h2>Registrado correctamente</h2>
    <br>
</div>
<div id="registrarOtro" class="col-6">
    <input type="button" id="btnAgain" class="btn btn-primary col-3" value="Registrar otro" />
    <br>
</div>

<div id="registroError" class="col-6">
    <h2 class="text-danger">Error al añadir</h2>
    <p></p>
    <br>
</div>

<h1>Añadir Staff </h1>
<br>
<div id="guidelines" class="col-6">
<p> Si tiene alguna duda consulte la <a href="faq.php">FAQ</a></p>
<p> Antes de añadir consulte si ya existe en la base de datos </p>
</div>
<br>
<div id="registrar" class="row">
    <div class="col-12 ">
        <form name="formAddStaff" id="formAddStaff" method="get" action"#"> 
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control col-6" id="nombre" placeholder="Nombre completo" name="nombre">
        </div>
        <div class="form-group">
            <label for="nacionalidad">Nacionalidad:</label>
            <input type="text" class="form-control col-6" id="nacionalidad" placeholder="nacionalidad" name="nacionalidad">
        </div>
        <div class="form-group">
            <label for="desc">Descripción:</label>
            <textarea class="form-control col-6" id="desc" rows="5" placeholder="" name="desc"></textarea>
        </div>
        <div class="form-check form-check-inline">
            <label class="radio-inline">
                <input type="radio" checked="checked" value="Masculino" name="radioGenero"> Masculino
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="radio-inline">
                <input type="radio" value="Femenino" name="radioGenero"> Femenino
            </label>
        </div>
        <div class="form-group">
            <label for="enlace">Enlace de interés(wikipedia, twitter, etc):</label>
            <input type="text" class="form-control col-6" id="enlace" placeholder="https://en.wikipedia.org/wiki/Jason_Rubin" name="enlace">
        </div>

        <br>
        <input type="button" id="btnADD" class="btn btn-primary col-6" value="Añadir" />
        </form>
    </div>   
</div>
<script type="text/javascript">var user_id = <?php echo $_SESSION["id"] ?>;</script>
<script type="text/javascript" src="../js/addStaff.js"></script>
<?php
pie();
?>
