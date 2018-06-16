<?php

include("../controller/plataforma.php");


?>
<div id="tabs" style="background: none repeat scroll 0% 0% #dce2df;">
    <ul>
        <li><a href="#mainPlat"><?php echo $plataforma->getNombre();?></a></li>
        <?php
        if(isset($_SESSION["tipo"]))
        {
        ?>
        <li><a id="editarPlatBtn" href="#editingPlat">Editar</a></li>
        <?php
        }
        ?>
        <li><a href="#revisionesPlataforma">Revisiones</a></li>
    </ul>
<div id="mainPlat">
    <div id="accordion">
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapseInfo">
                Información de <?php echo $plataforma->getNombre();?>
                </a>
            </div>
            <div id="collapseInfo" class="collapse show" data-parent="#accordion">
                <div class="card-body">
                    <div id="datosCompany" class="col-lg-10 offset-lg-1 col-12">
                        <h2 class="text-center"><?php echo $plataforma->getNombre();?></h2>
                        <p class="text-center">Compañía: <?php echo $plataforma->getCompany();?></p>
                        <p class="text-center">Lanzamiento: <?php echo $plataforma->getFecha();?></p>
                        <p> <?php echo $plataforma->getDescripcion();?> </p>
                        <h3>Especificaciones</h3>
                        <p> <?php echo $plataforma->getEspecificaciones();?> </p>
                    </div>
                </div>
            </div>
        </div>

    <h2 class="mt-5">Lista de juegos</h2>
    
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
                    <th class="w-75">Título</th><th>Lanzamiento</th><th>Nota</th>
                    </tr>
                    <?php
                    foreach($plataforma->getJuegos() as $value)
                    {
                        echo "<tr>";
                            echo "<td><a href='juego.php?id=".$value['id']."'>".$value["titulo"]."</a></td><td>".$value["fecha"]."</td><td>".$value["media"]."</td>";
                        echo "</tr>";
                    }
                    echo '</table>';
                    echo $plataforma->pages->page_links('?', '&id='.$id_plat);
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
<div id="editingPlat">
    <div id="registrado" class="col-lg-8 col-12">
        <h2>Editado correctamente</h2>
        <br>
    </div>
    <div id="registroError" class="col-lg-8 col-12">
        <h2 class="text-danger">Error al editar</h2>
        <p></p>
        <br>
    </div>

    <h1>Editar <?php echo $plataforma->getNombre();?> </h1>
    <br>
    <div id="guidelines" class="col-lg-8 col-12">
    <p> Si tiene alguna duda consulte la <a href="faq.php">FAQ</a></p>
    <p> Antes de añadir consulte si ya existe en la base de datos </p>
    </div>
    <br>
    <div id="registrar" class="row">
        <div class="col-12 ">
            <form name="formEditarPlat" id="formEditarPlat" method="get" action"#"> 
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control col-lg-8 col-12" id="nombre" placeholder="Nombre completo" name="nombre" value="<?php echo $plataforma->getNombre();?>"/>
        </div>
        <div class="form-group">
            <label for="company">Compañía:</label>
            <input type="text" class="form-control col-lg-8 col-12" id="company" placeholder="Sony" name="company" value="<?php echo $plataforma->getCompany();?>"/>
            <input type="hidden" id="company-name">
        </div>
        <div class="form-group">
            <label for="desc">Descripción:</label>
            <textarea class="form-control col-lg-8 col-12" id="desc" rows="5" placeholder="" name="desc"><?php echo $plataforma->getDescripcion();?></textarea>
        </div>

        <div class="form-group">
            <label for="esp">Especificaciones:</label>
            <textarea class="form-control col-lg-8 col-12" id="esp" rows="5" placeholder="" name="esp"><?php echo $plataforma->getEspecificaciones();?></textarea>
        </div>
        <div class="form-group">
            <label for="fecha">Año:</label>
            <input type="text" class="form-control col-lg-8 col-12" id="fecha" placeholder="1984" name="fecha" value="<?php echo $plataforma->getFecha();?>"/>
        </div>
        <br>

        <br>
        <input type="button" id="btnEditar" class="btn btn-primary col-lg-8 col-12" value="Guardar" />
        </form>
        <br><br>
        <?php
        if(isset($_SESSION["tipo"]) && $_SESSION["tipo"]=="1") //si es administrador
        {
            if($plataforma->getActivo()==1)
            {
                echo "<form id='borrarPlat' name='borrarPlat'>";
                echo '<input type="button" id="eliminar" class="btn btn-danger col-lg-8 col-12" value="Eliminar Plataforma" />';
                echo "</form>";
            }
            else
            {
                echo "<form id='activarPlat' name='activarPlat'>";
                echo '<input type="button" id="activar" class="btn btn-success col-lg-8 col-12" value="Reactivar Plataforma" />';
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
<div id="revisionesPlataforma">
    <h3 class="text-center">Revisiones</h3>
    <table class="table table-bordered" id="revisionesListado">
    <tr><th>ID REVISION</th><th>USUARIO</th><th>Descripción</th><th>Fecha</th></tr>
    </table>
</div>

</div>
<div id="dialog-eliminar" title="Eliminar <?php echo $plataforma->getNombre();?>">
    <p class="text-danger"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro de que quiere eliminar a esta plataforma?</p>
</div>
<script type="text/javascript">
var plat_id = <?php echo $id_plat ?>;
var user_id= <?php echo isset($_SESSION["id"]) ? $_SESSION["id"] : -1 ;?>;
</script>
<script type="text/javascript" src="../js/plataforma.js"></script>
<?php
$miconexion=null;
pie();
?>
