<?php
include("../utilities/utilities.php");
iniciarSesion();

include_once("../servidor/bbdd.php");
$id_staff=$_GET["id"];
$sql="select nombre, nacionalidad, genero, descripcion, enlace from personas where id=".$id_staff;
$fila=consultaUnica($sql);
cabecera($fila["nombre"]);
navBar();
?>
<div id="tabs" style="background: none repeat scroll 0% 0% #dce2df;">
    <ul>
        <li><a href="#mainStaff"><?php echo $fila["nombre"];?></a></li>
        <li><a id="editarStaffBtn" href="#editingStaff">Editar</a></li>
        <li><a href="#revisionesStaff">Revisiones</a></li>
    </ul>
<div id="mainStaff">
    <div id="datosPersona" class="w-75 offset-1">
        <h2 class="text-center"><?php echo $fila["nombre"];?></h2>
        <p class="text-center">Nacionalidad: <?php echo $fila["nacionalidad"];?></p>
        <p class="text-center">Género: <?php echo $fila["genero"];?></p>
        <?php if ($fila["enlace"]!=null)
        echo '<p class="text-center">Enlace: '.$fila["enlace"].'</p>';
        ?>
        <p> <?php echo $fila["descripcion"];?> </p>
    </div>
    <h2 class="mt-5">Creditos</h2>
    <div id="creditosPersona" class="my-2">

    </div>
</div>
<div id="editingStaff">
    <div id="registrado">
        <h2>Editado correctamente</h2>
        <br>
    </div>
    <div id="registroError">
        <h2 class="text-danger">Error al añadir</h2>
        <br>
    </div>

    <h1>Editar <?php echo $fila["nombre"];?> </h1>
    <br>
    <div id="guidelines" class="col-8">
    <p> Si tiene alguna duda consulte la <a href="faq.php">FAQ</a></p>
    <p> Antes de añadir consulte si ya existe en la base de datos </p>
    </div>
    <br>
    <div id="registrar" class="row">
        <div class="col-12 ">
            <form name="formEditarStaff" id="formEditarStaff" method="get" action"#"> 
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control col-8" id="nombre" placeholder="Nombre completo" name="nombre" value="<?php echo $fila["nombre"];?>">
            </div>
            <div class="form-group">
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" class="form-control col-8" id="nacionalidad" placeholder="nacionalidad" name="nacionalidad" value="<?php echo $fila["nacionalidad"];?>">
            </div>
            <div class="form-group">
                <label for="desc">Descripción:</label>
                <textarea class="form-control col-8" id="desc" rows="5" placeholder="" name="desc" > <?php echo $fila["descripcion"];?></textarea>
            </div>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <?php
                    if ($fila["genero"]=="Masculino")
                    echo '<input type="radio" checked="checked" value="Masculino" name="radioGenero"> Masculino';
                    else
                    echo '<input type="radio" value="Masculino" name="radioGenero"> Masculino';
                    ?>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <?php
                    if ($fila["genero"]=="Femenino")
                    echo '<input type="radio" checked="checked" value="Femenino" name="radioGenero"> Femenino';
                    else
                    echo '<input type="radio" value="Femenino" name="radioGenero"> Femenino';
                    ?>
                </label>
            </div>
            <div class="form-group">
                <label for="enlace">Enlace de interés(wikipedia, twitter, etc):</label>
                <input type="text" class="form-control col-8" id="enlace" placeholder="https://en.wikipedia.org/wiki/Jason_Rubin" name="enlace" value="<?php echo $fila["enlace"];?>">
            </div>

            <br>
            <input type="button" id="btnEditar" class="btn btn-primary col-8" value="Guardar" />
            </form>
        </div>   
    </div>
</div>

<div id="revisionesStaff">
<p>Revisiones</p>
</div>

</div>

<script type="text/javascript">var staff_id = <?php echo $id_staff ?>;</script>
<script type="text/javascript" src="../js/staff.js"></script>
<?php
pie();
?>
