<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Añadir Plataforma");
navBar();
?>

<div id="registrado" class="col-6">
    <h2>Añadido correctamente</h2>
    <br>
</div>
<div id="registrarOtro" class="col-6">
    <input type="button" id="btnAgain" class="btn btn-primary col-3" value="Registrar otro" />
    <br>
</div>

<div id="registroError" class="col-6" >
    <h2 class="text-danger">Error al añadir</h2>
    <br>
</div>

<h1>Añadir Juego </h1>
<br>
<div id="guidelines" class="col-6">
<p> Si tiene alguna duda consulte la <a href="faq.php">FAQ</a></p>
<p> Antes de añadir consulte si ya existe en la base de datos </p>
</div>
<br>
<div id="registrar" class="row">
    <div class="col-12 ">
        <form name="formAddJuego" id="formAddJuego" method="get" action"#"> 
        <div class="form-group">
            <label for="nombre">Título: *</label>
            <input type="text" class="form-control col-6" id="nombre" placeholder="Nombre completo" name="nombre">
        </div>
        <div class="form-group">
            <label for="company">Compañía: *</label>
            <input type="text" class="form-control col-6 companies" id="company" placeholder="Nombre completo" name="company">
        </div>

        <div class="text-center col-6">
            <input type="button" id="btnCompany" class="btn btn-primary col-6" value="Añadir Otra Compañía" />
            
        </div>
        <div class="form-group">
            <label for="sinopsis">Sinopsis:</label>
            <textarea class="form-control col-6" id="sinopsis" rows="5" placeholder="" name="sinopsis"></textarea>
        </div>

        <div class="form-group">
            <label for="enlace">Enlace de interés(Página oficial, wikipedia, etc):</label>
            <input type="text" class="form-control col-6" id="enlace" placeholder="https://www.crashbandicoot.com/es" name="enlace">
        </div>
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="text" class="form-control col-6" id="fecha" placeholder="yy-mm-dd" name="fecha">
        </div>
        <br>
        <input type="button" id="btnADD" class="btn btn-primary col-6 mb-5" value="Añadir" />
        </form>
    </div>   
</div>
<script type="text/javascript">var user_id = <?php echo $_SESSION["id"] ?>;</script>
<script type="text/javascript" src="../js/addJuego.js"></script>
<?php
pie();
?>
