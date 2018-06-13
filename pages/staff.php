<?php


include("../controller/staff.php");


?>
<div id="tabs" style="background: none repeat scroll 0% 0% #dce2df;">
    <ul>
        <li><a href="#mainStaff"><?php echo $staff->getNombre();?></a></li>
        <?php
        if(isset($_SESSION["tipo"]))
        {
        ?>
        <li><a id="editarStaffBtn" href="#editingStaff">Editar</a></li>
        <?php
        }
        ?>
        <li><a href="#revisionesStaff">Revisiones</a></li>
    </ul>
<div id="mainStaff">
    <div id="datosPersona" class="col-10 offset-1">
        <h2 class="text-center"><?php echo $staff->getNombre();?></h2>
        <p class="text-center">Nacionalidad: <?php echo $staff->getNacionalidad();?></p>
        <p class="text-center">Género: <?php echo $staff->getGenero();?></p>
        <?php if ($staff->getEnlace()!=null)
        echo '<p class="text-center">Enlace: '.$staff->getEnlace().'</p>';
        ?>
        <p> <?php echo $staff->getDescripcion();?> </p>
    </div>
    <h2 class="mt-5">Créditos</h2>
    <div id="accordion">
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapseJuego">
                Juegos
                </a>
            </div>
            <div id="collapseJuego" class="collapse show" data-parent="#accordion">
                <div class="card-body">
                    <table class="table borderless table-striped">
                    <tr>
                    <th class="w-75">Título</th><th>Lanzamiento</th><th>Rol</th><th>Comentario</th><th>Nota</th>
                    </tr>
                    <?php
                    foreach($staff->getJuegos() as $value)
                    {
                        echo "<tr>";
                            echo "<td><a href='juego.php?id=".$value['id']."'>".$value["titulo"]."</a></td><td>".$value["fecha"]."</td><td>".$value["rol"]."</td><td>".$value["comentario"]."</td><td>".$value["media"]."</td>";
                        echo "</tr>";  
                    }
                    echo "</table>";
                    echo $staff->pages->page_links('?', '&id='.$id_staff);
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
if(isset($_SESSION["tipo"]))
{
?>
<div id="editingStaff">
    <div id="registrado" class="col-8">
        <h2>Editado correctamente</h2>
        <br>
    </div>
    <div id="registroError" class="col-8">
        <h2 class="text-danger">Error al editar</h2>
        <br>
    </div>

    <h1>Editar <?php echo $staff->getNombre();?> </h1>
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
                <input type="text" class="form-control col-8" id="nombre" placeholder="Nombre completo" name="nombre" value="<?php echo $staff->getNombre();?>">
            </div>
            <div class="form-group">
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" class="form-control col-8" id="nacionalidad" placeholder="nacionalidad" name="nacionalidad" value="<?php echo $staff->getNacionalidad();?>">
            </div>
            <div class="form-group">
                <label for="desc">Descripción:</label>
                <textarea class="form-control col-8" id="desc" rows="5" placeholder="" name="desc" > <?php echo $staff->getDescripcion();?></textarea>
            </div>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <?php
                    if ($staff->getGenero()=="Masculino")
                    echo '<input type="radio" checked="checked" value="Masculino" name="radioGenero"> Masculino';
                    else
                    echo '<input type="radio" value="Masculino" name="radioGenero"> Masculino';
                    ?>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="radio-inline">
                    <?php
                    if ($staff->getGenero()=="Femenino")
                    echo '<input type="radio" checked="checked" value="Femenino" name="radioGenero"> Femenino';
                    else
                    echo '<input type="radio" value="Femenino" name="radioGenero"> Femenino';
                    ?>
                </label>
            </div>
            <div class="form-group">
                <label for="enlace">Enlace de interés(wikipedia, twitter, etc):</label>
                <input type="text" class="form-control col-8" id="enlace" placeholder="https://en.wikipedia.org/wiki/Jason_Rubin" name="enlace" value="<?php echo $staff->getEnlace();?>">
            </div>

            <br>
            <input type="button" id="btnEditar" class="btn btn-primary col-8" value="Guardar" />
            </form>
            <br><br>
            <?php
            if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="1") //si es administrador
            {
                if($staff->getActivo()==1)
                {
                    echo "<form id='borrarStaff' name='borrarStaff'>";
                    echo '<input type="button" id="eliminar" class="btn btn-danger col-8" value="Eliminar Persona" />';
                    echo "</form>";
                }
                else
                {
                    echo "<form id='activarStaff' name='activarStaff'>";
                    echo '<input type="button" id="activar" class="btn btn-success col-8" value="Reactivar Persona" />';
                    echo "</form>";                
                }
                
            }

            ?>
        </div>   
    </div>
</div>
<?php
}
?>
<div id="revisionesStaff">
    <h3 class="text-center">Revisiones</h3>
    <table class="table table-bordered" id="revisionesListado">
    <tr><th>ID REVISION</th><th>USUARIO</th><th>Descripción</th><th>Fecha</th></tr>
    </table>
</div>

</div>
<div id="dialog-eliminar" title="Eliminar <?php echo $staff->getNombre();?>">
    <p class="text-danger"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro de que quiere eliminar a esta persona?</p>
</div>
<script type="text/javascript">var staff_id = <?php echo $id_staff ?>;
var user_id= <?php echo isset($_SESSION["id"]) ? $_SESSION["id"] : -1 ;?>;</script>
<script type="text/javascript" src="../js/staff.js"></script>
<?php
$miconexion=null;
pie();
?>
