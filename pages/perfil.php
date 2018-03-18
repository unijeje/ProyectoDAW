<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("VideoJuegos BBDD");
navBar();
$usuario=$_SESSION["nombre"];
$id= $_SESSION["id"];
include("../servidor/editarPerfil.php");
?>
<div class="row">

 <ul class="nav nav-pills flex-column col-2 mt-4" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="mostrarPerfil" data-toggle="pill" href="#perfil"><?php echo $_SESSION["nombre"];?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="editarPerfil" data-toggle="pill" href="#editar">Editar</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#menu2">Menu 2</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content col-8 ml-2">
    <div id="perfil" class="container tab-pane active"><br>
      <table class="table table-striped ">
        <tr>
            <td class="w-25">ID usuario</td> <td><?php echo $_SESSION["id"];?> </td>
        </tr>
        <tr>
            <td class="w-25">Usuario</td> <td><?php echo $_SESSION["nombre"];?> </td>
        </tr>
        <tr>
            <td>Registro</td> <td id="tablaCorreo"><?php echo $fila['registro'];?></td>
        </tr>
        <tr>
            <td>Correo</td> <td><?php echo $fila['email'];?></td>
        </tr>
        <tr>
            <td>Juegos</td> <td>nº de juegos</td>
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

    <div id="registroError">
        <h2 class="text-danger">Ha habido un error al editar </h2>
    </div>

      <form name="formEditarPerfil" id="formEditarPerfil">
        <div class="form-group row">
            <label class="col-2 col-form-label" for="usuario">Usuario:</label>
            <div class="col-6">
                <input disabled type="text" class="form-control" id="usuario" placeholder="Introduce nombre de usuario" name="usuario" value="<?php echo $usuario;?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label" for="email">Email:</label>
            <div class="col-6">
                <input type="text" class="form-control" id="email" placeholder="Introduce email" name="email" value="<?php echo $fila['email'];?>">
            </div>
        </div>
        <br>
        <p class="ml-5">Dejar en blanco para mantener la contraseña actual </p>
        <br>
        <div class="form-group row">
            <label class="col-2 col-form-label labelDoble" for="passAntigua">Contraseña Actual:</label>
            <div class="col-6">
                <input type="password" class="form-control" id="passAntigua" placeholder="Introduce contraseña" name="pass">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label labelDoble" for="passNueva">Contraseña Nueva:</label>
            <div class="col-6">
                <input type="password" class="form-control" id="passNueva" placeholder="Introduce contraseña" name="pass">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-2 col-form-label labelDoble" for="passNuevaRepetida">Confirmar Contraseña:</label>
            <div class="col-6">
                <input type="password" class="form-control" id="passNuevaRepetida" placeholder="Introduce contraseña" name="pass">
            </div>
        </div>
        
        <input type="button" id="guardar" class="btn btn-primary col-8" value="Guardar" />
      </form>
    </div>

    <div id="menu2" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>    
</div>
<script type="text/javascript">var user_id = <?php echo $id ?>;</script>
<script type="text/javascript" src="../js/perfil.js"></script>

<?php
pie();
?>
