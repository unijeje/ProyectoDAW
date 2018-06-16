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
        <input type="button" id="btnFiltro" class="btn btn-primary col-lg-3 col-12 offset-lg-5 offset-0 text-center my-3" value="Filtros" />
    </div>
    
    <div id="capaFiltro" class="col-lg-8 col-12 offset-lg-2 offset-0">
        <form name="formEditarJuego" id="formEditarJuego" class="my-3">
            <label class="col-4 offset-1" for="generos">Seleccione los generos:</label>
            <label class="col-4 offset-2" for="fecha">Fecha:</label>
            <div class="form-group row col-12">
                <div class="col-4 offset-1">   
                    <select multiple class="form-control mb-3" size="4" id="generos" name="generos">
                        <option value="t">Todos</option>
                    </select>
                </div>
                <div class="offset-1 col-6">
                    <div class="row h-50">
                        <div class="form-group row">
                            <label class="col-4" for="fechaMin">Posterior a: </label>
                            <input type="text" class="form-control col-7 mb-3 fecha" id="fechaMin" placeholder="Lanzamiento despues de..." name="fechaMin"/>
                        </div>
                        <div class="form-group row">
                            <label class="col-4" for="fechaMax">Anterior a: </label>
                            <input type="text" class="form-control col-7 mb-3 fecha" id="fechaMax" placeholder="Lanzamiento antes de..." name="fechaMax"/>
                        </div>
                    </div>
                </div>
            </div>
            <label class="col-lg-4 col-4 offset-1" for="generos">Seleccione la duración:</label>
            <label class="col-lg-4 col-5 offset-1" for="plataformas">Seleccione las plataformas:</label>
            <div class="form-group row col-12">
                <select size="4" multiple class="form-control col-4 offset-1"  id="duracion" name="duracion"><option value="t">Todos</option></select>
                <select size="4" multiple class="form-control col-6 offset-1"  id="plataformas" name="plataformas"><option value="t">Todos</option></select>
            </div>
            <input type="button" id="btnFiltroAvanz" class="btn btn-primary col-4 offset-4 text-center my-3" value="Buscar" />
        </form>
    </div>

</div>

<div class="mb-3" style="max-width: 100%;">
<table id="tablaListadoJuego" class="table table-bordered table-dark" style="width:100%;">
    <thead>
    <tr><th class="w-75">Título</th><th>Lanzamiento</th><th>Rating</th></tr>
    </thead>

</table>
</div>

<script type="text/javascript" src="../utilities/datatables2.min.js"></script>
<script type="text/javascript" src="../js/ListadoJuego.js"></script>
<?php
pie();
?>
