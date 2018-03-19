<?php
include("../utilities/utilities.php");
iniciarSesion();
cabecera("Añadir Staff");
navBar();
include_once("../servidor/bbdd.php");
$limit=9;

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit; 

/*3 Filas dividir limit entre 3 y hacer 3 tablas */
$resPorTabla=$limit/3;

$sql="SELECT id, nombre from personas order by nombre LIMIT $start_from, $limit";
$resultset=ejecutaConsulta($sql);
?>
<div id="busqueda">
    <h1>Buscar Staff</h1>
    
    <div class="form-group row">
            <input type="text" class="form-control col-10" id="busqueda" placeholder="" name="busqueda">
            <input type="button" id="btnADD" class="btn btn-primary col-1 ml-2" value="Busqueda" />
        
    </div>
</div>

<div id="listado" class="col-12">
    <?php
        $i=0;
        echo '<div class="list-inline text-center col-12">';
        while($fila=$resultset->fetch(PDO::FETCH_ASSOC))
        {
            if($i==$resPorTabla)
            {
                echo '</div>';
                echo '<div class="list-inline text-center col-12">';
                echo "<br>";
                $i=0;
            }
            $idActual=$fila["id"];
            echo '<li class="list-inline-item"><a href="staff.php?id='.$idActual.'" class="list-group-item list-group-item-action">'.$fila["nombre"].'</a></li>';
            $i++;
            
        }

        echo '</div>';

    
    
    ?>
    
    <br>
    <?php
    $resultset=null;
    $sqlCount="Select count(id) as num from personas";
    $fila=consultaUnica($sqlCount);
    $numRes=$fila["num"];
    $numPag=ceil($numRes / $limit);
    $pagLink = "<nav><ul class='pagination'>";  
    for ($i=1; $i<=$numPag; $i++) {  
                    $pagLink .= "<li class='page-item'><a  class='page-link' href='listadoStaff.php?page=".$i."'>".$i."</a></li>";  
    };  
    echo $pagLink . "</ul></nav>";

    ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
    $('.pagination').pagination({
            items: <?php echo $numRes;?>,
            itemsOnPage: <?php echo $limit;?>,
            cssStyle: 'compact-theme',
            currentPage : <?php echo $page;?>,
            hrefTextPrefix : 'listadoStaff.php?page='
        });
        });
</script>
<script type="text/javascript" src="../utilities/jquery.simplePagination.js"></script>
<?php
pie();
?>
