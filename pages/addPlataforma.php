<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Añadir Plataforma");
navBar();
?>

<div id="registrado"  class="col-lg-8 col-12">
    <h2>Registrado correctamente</h2>
    <br>
</div>
<div id="registrarOtro"  class="col-lg-8 col-12 mt-3">
    <span></span><br><br>
    <input type="button" id="btnAgain" class="btn btn-primary col-3" value="Registrar otro" />
    <br>
</div>

<div id="registroError"  class="col-lg-8 col-12 my-3">
    <h2 class="text-danger">Error al añadir</h2>
    <p></p>
    <br>
</div>

<h1>Añadir Plataforma </h1>
<br>
<div id="guidelines" class="col-lg-8 col-12">
<p> Si tiene alguna duda consulte la <a href="faq.php">FAQ</a></p>
<p> Antes de añadir consulte si ya existe en la base de datos </p>
</div>
<br>
<div id="registrar" class="row mb-5">
    <div class="col-12 ">
        <form name="formAddPlat" id="formAddPlat" method="get" action"#"> 
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control col-lg-8 col-12" id="nombre" placeholder="Nombre completo" name="nombre">
        </div>
        <div class="form-group">
            <label for="company">Compañía:</label>
            <input type="text" class="form-control col-lg-8 col-12" id="company" placeholder="Sony" name="company">
            <input type="hidden" id="company-name">
        </div>
        <div class="form-group">
            <label for="desc">Descripción:</label>
            <textarea class="form-control col-lg-8 col-12" id="desc" rows="5" placeholder="" name="desc"></textarea>
        </div>

        <div class="form-group">
            <label for="esp">Especificaciones:</label>
            <textarea class="form-control col-lg-8 col-12" id="esp" rows="5" placeholder="" name="esp"></textarea>
        </div>
        <div class="form-group">
            <label for="fecha">Año:</label>
            <input type="text" class="form-control col-lg-8 col-12" id="fecha" placeholder="1984" name="fecha">
        </div>
        <br>
        <input type="button" id="btnADD" class="btn btn-primary col-lg-8 col-12 mb-5" value="Añadir" />
        </form>
    </div>   
</div>
<script type="text/javascript">var user_id = <?php echo $_SESSION["id"] ?>;</script>
<script type="text/javascript" src="../js/addPlat.js"></script>
<?php
pie();
?>
