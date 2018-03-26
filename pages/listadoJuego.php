<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Juegos");
navBar();
//include_once("../servidor/bbdd.php");

?>
<div id="registroError">
    <h2 class="text-danger">Ha habido un error en la busqueda </h2>
</div>
<div id="busqueda">
    <h1>Buscar Juego</h1>
    
    <div class="form-group row">
        <input type="text" class="form-control col-12" id="txtBusqueda" placeholder="Crash Bandicoot" name="txtBusqueda">
    </div>
    <div class="form-group row">
        <input type="button" id="btnFiltro" class="btn btn-primary col-2 offset-5 text-center my-3" value="Filtros" />
    </div>
</div>
<div style="max-width: 100%;">
<table id="tablaListadoJuego" class="table table-bordered table-dark" style="width:100%;">
<thead>
<tr><th class="w-75">Título</th><th>Lanzamiento</th></tr>
</thead>

</table>
</div>

<script type="text/javascript" src="../utilities/datatables2.min.js"></script>
<!--
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/cr-1.4.1/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
-->
<script type="text/javascript" src="../js/ListadoJuego.js"></script>
<?php
pie();
?>
