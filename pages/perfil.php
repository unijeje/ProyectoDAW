<?php

include("../controller/perfil.php");

?>
<div class="row">

 <ul class="nav nav-pills flex-column col-lg-2 col-md-3 col-sm-12 mt-4" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="mostrarPerfil" data-toggle="pill" href="#perfil"><?php echo $perfil->usuario;?></a>
    </li>
    <?php
    if(!isset($_GET["id"]))
    {
        ?>   
        <li class="nav-item">
        <a class="nav-link" id="editarPerfil" data-toggle="pill" href="#editar">Configuración</a>
        </li>
        <?php
    }
    ?> 
    <li class="nav-item">
    <?php
     if(isset($_GET["id"]))
     {
         echo '<a class="nav-link" data-toggle="pill" href="#votos">Votos</a>';
     }
     else
     {
        echo '<a class="nav-link" data-toggle="pill" href="#votos">Mis votos</a>';
     }
      
    ?>
    </li>
    <li class="nav-item">
    <?php
     if(isset($_GET["id"]))
     {
        echo '<a class="nav-link" data-toggle="pill" href="#comentarios">Comentarios</a>';
     }
     else
     {
        echo '<a class="nav-link" data-toggle="pill" href="#comentarios">Mis comentarios</a>';
     }
    ?>
    </li>
    <?php
        if($administrador)
        {
            echo "<li class='nav-item'>";
            echo '<a class="nav-link" data-toggle="pill" href="#admin">Administrador</a>';
            echo "</li>";
        }
    ?>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content col-lg-9 col-md-8 col-12 ml-2">
    <div id="perfil" class="container tab-pane active"><br>
      <table class="table table-striped table-responsive">
        <tr>
            <td class="w-25">ID usuario</td> <td><?php echo $id;?> </td>
        </tr>
        <tr>
            <td class="w-25">Usuario</td> <td><?php echo $perfil->usuario;?> </td>
        </tr>
        <tr>
            <td>Registro</td> <td id="tablaCorreo"><?php echo $perfil->fecha;?></td>
        </tr>
        <?php
        if(!isset($_GET["id"]))
        {
        ?> 
        <tr>
            <td>Correo</td> <td><?php echo $perfil->email;?></td>
        </tr>
        <?php
        }
        ?> 
        <tr>
            <td>Juegos</td> <td><?php echo $perfil->numTotal; ?></td>
        </tr>
        <tr>
            <td>Comentarios</td> <td>nº de comentarios</td>
        </tr>
        <tr>
            <td>Revisiones</td> <td>nº de revisiones</td>
        </tr>
      </table>
    </div>
    
    <div id="editar" class="container tab-pane fade"><br>
    <div id="registrado">
        <h2>Datos editados correctamente</h2>
    </div>

    <div id="registroError" class="mb-3">
        <h2 class="mb-1">Ha habido un error al editar </h2>
        <p></p>
    </div>

      <form name="formEditarPerfil" id="formEditarPerfil">
        <div class="form-group row">
            <label class="col-lg-2 col-3 col-form-label" for="usuario">Usuario:</label>
            <div class="col-lg-6 col-8">
                <input disabled type="text" class="form-control" id="usuario" placeholder="Introduce nombre de usuario" name="usuario" value="<?php echo $perfil->usuario;?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-3 col-form-label" for="email">Email:</label>
            <div class="col-lg-6 col-8">
                <input type="text" class="form-control" id="email" placeholder="Introduce email" name="email" value="<?php echo $perfil->email;?>">
            </div>
        </div>
        <br>
        <p class="">Dejar en blanco para mantener la contraseña actual </p>
        <br>
        <div class="form-group row">
            <label class="col-lg-2 col-3 col-form-label labelDoble" for="passAntigua">Contraseña Actual:</label>
            <div class="col-lg-6 col-8">
                <input type="password" class="form-control" id="passAntigua" placeholder="Introduce contraseña" name="pass">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-3 col-form-label labelDoble" for="passNueva">Contraseña Nueva:</label>
            <div class="col-lg-6 col-8">
                <input type="password" class="form-control" id="passNueva" placeholder="Introduce contraseña" name="pass">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-2 col-3 col-form-label labelDoble" for="passNuevaRepetida">Confirmar Contraseña:</label>
            <div class="col-lg-6 col-8">
                <input type="password" class="form-control" id="passNuevaRepetida" placeholder="Introduce contraseña" name="pass">
            </div>
        </div>
        
        <input type="button" id="guardar" class="btn btn-primary col-lg-8 col-11 " value="Guardar" />
      </form>
      <br/>
      <br/>
      <form name="formEliminarPerfil" id="formEliminarPerfil">
        <input type="button" id="eliminar" class="btn btn-danger col-lg-8 col-11 " value="Eliminar cuenta" />
      </form>
    </div>

    <div id="votos" class="container tab-pane fade col-12"><br>
        <h3>Todos sus Juegos</h3>
        <div class="mt-4" style="max-width: 100%;">
        <?php
        if(!isset($_GET["id"]))
        {      
        echo '<table id="tablaPerfilJuego" class="table table-bordered table-dark" style="width:100%;">';
        }
        else
        {
        echo '<table id="tablaPerfilJuegoOtro" class="table table-bordered table-dark" style="width:100%;">';
        }
        ?>
            <thead>
            <tr><th>Cover</th><th class="tablaMinWidth">Título</th><th>Voto</th><th>Registro</th></tr>
            </thead>
        </table>
        </div>
    </div>
    <div id="comentarios" class="container tab-pane fade"><br>
    
      <table id="tablaComentarios" class="table table-hover table-responsive">
        <tr>
            <th id="mostrarHoraComentariosPerfil">Fecha</th><th id="mostrarHoraComentariosPerfil">Juego</th><th id="mostrarHoraComentariosPerfil">Comentario</th>
        </tr>

      </table>
    </div>
    <div id="admin" class="container tab-pane fade"><br>
        <form id="adminOption" name="adminOption">
            <div id="registradoA" class="col-9 mb-2">
            <h2>Datos editados correctamente</h2>
        </div>

        <div id="registroErrorA" class="mb-3 col-9">
            <h2 class="mb-1">Ha habido un error al editar </h2>
            <p></p>
        </div>
        <div class="form-group row">
            <label class="col-4" for="tipoCuenta">Asignar nivel de permisos: </label>
            <div class="col-5">
                <select class="form-control" id="tipoCuenta">
                    <?php
                        if($perfil->tipo == 1)
                        {
                            echo '<option selected="selected" value="1">Administrador</option>';
                            echo '<option value="2">Usuario</option>';
                        }
                        else
                        {
                            echo '<option value="1">Administrador</option>';
                            echo '<option selected="selected" value="2">Usuario</option>';
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-4" for="activoCuenta">Estado de la cuenta: </label>
            <div class="col-5">
                <select class=" form-control" id="activoCuenta">
                    <?php
                        if($perfil->activo == 1)
                        {
                            echo '<option selected="selected" value="1">Activado</option>';
                            echo '<option value="0">Desactivado</option>';
                        }
                        else
                        {
                            echo '<option value="1">Activado</option>';
                            echo '<option selected="selected" value="0">Desactivado</option>';
                        }
                    ?>
                </select>
            </div>
        </div>

         <input type="button" id="btnGuardarAdmin" class="btn btn-primary mt-3 col-9" value="Guardar" />
        </form>
    </div>

  </div>    
</div>


<div id="dialog-eliminar" title="Eliminar Cuenta">
    <p class="text-danger"><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>¿Está seguro de que quiere eliminar la cuenta? Esta acción es irreversible</p>
</div>
<script type="text/javascript" src="../utilities/datatables2.min.js"></script>
<script type="text/javascript">var user_id = <?php echo $id ?>;</script>
<script type="text/javascript" src="../js/perfil.js"></script>

<?php
$select=null;
$miconexion=null;
pie();
?>
