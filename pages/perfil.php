<?php
include("../utilities/utilities.php");
include_once("../servidor/bbdd.php");
iniciarSesion();
cabecera("VideoJuegos BBDD");

$miconexion=connectDB();

if(isset($_GET["id"]))
{
    $id=$_GET["id"];
    $sql="SELECT nombre, email, registro from cuentas where id=? ";
    $select=$miconexion->prepare($sql);
    $select->execute(array($id));
    $fila=$select->fetch();
    $usuario=$fila["nombre"];

}
else
{
    $usuario=$_SESSION["nombre"];
    $id= $_SESSION["id"];

    $sql="SELECT email, registro from cuentas where NOMBRE=?";
    $select=$miconexion->prepare($sql);
    $select->execute(array($usuario));
    $fila=$select->fetch();
    
}
$fila['registro']=fechaFormato($fila['registro']);


$sql="select count(nota) as total from votos where cuenta=?";
$select=$miconexion->prepare($sql);
$select->execute(array($id));
$filaNumVotos=$select->fetch();

navBar();
?>
<div class="row">

 <ul class="nav nav-pills flex-column col-2 mt-4" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="mostrarPerfil" data-toggle="pill" href="#perfil"><?php echo $usuario;?></a>
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
      <a class="nav-link" data-toggle="pill" href="#votos">Mis votos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="pill" href="#comentarios">Mis comentarios</a>
    </li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content col-8 ml-2">
    <div id="perfil" class="container tab-pane active"><br>
      <table class="table table-striped ">
        <tr>
            <td class="w-25">ID usuario</td> <td><?php echo $id;?> </td>
        </tr>
        <tr>
            <td class="w-25">Usuario</td> <td><?php echo $usuario;?> </td>
        </tr>
        <tr>
            <td>Registro</td> <td id="tablaCorreo"><?php echo $fila['registro'];?></td>
        </tr>
        <?php
        if(!isset($_GET["id"]))
        {
        ?> 
        <tr>
            <td>Correo</td> <td><?php echo $fila['email'];?></td>
        </tr>
        <?php
        }
        ?> 
        <tr>
            <td>Juegos</td> <td><?php echo $filaNumVotos["total"]; ?></td>
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
        <p class="">Dejar en blanco para mantener la contraseña actual </p>
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
      <br/>
      <br/>
      <form name="formEliminarPerfil" id="formEliminarPerfil">
        <input type="button" id="eliminar" class="btn btn-danger col-8" value="Eliminar cuenta" />
      </form>
    </div>

    <div id="votos" class="container tab-pane fade"><br>
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
            <tr><th>Cover</th><th class="w-50">Título</th><th>Voto</th><th>Registro</th></tr>
            </thead>
        </table>
        </div>
    </div>
    <div id="comentarios" class="container tab-pane fade"><br>
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
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
