<?php

include("../controller/busqueda.php");


if($tipo!="a")
{
    
?>


<?php
switch($tipo)
{
    case "j":
    echo '<table class="table borderless table-striped">';
    echo '<tr>';
    echo '    <th class="w-75">Título</th><th>Fecha</th><th>Nota</th>';
    echo '</tr>';
    foreach($listado->datos as $value)
    {
        echo "<tr>";
            echo "<td><a href='juego.php?id=".$value['ID']."'>".$value["TITULO"]."</a></td><td>".$value["FECHA"]."</td><td>".$value["MEDIA"]."</td>";
        echo "</tr>";
        
    }
    break;
    case "s":
    echo '<table class="table borderless table-striped">';
    echo '<tr>';
    echo '    <th class="w-50">Nombre</th><th>Nacionalidad</th><th>Género</th>';
    echo '</tr>';
    foreach($listado->datos as $value)
    {
        echo "<tr>";
            echo "<td><a href='staff.php?id=".$value['ID']."'>".$value["NOMBRE"]."</a></td><td>".$value["NACIONALIDAD"]."</td><td>".$value["GENERO"]."</td>";
        echo "</tr>";
        
    }
    break;
    
    case "c":
    echo '<table class="table borderless table-striped">';
    echo '<tr>';
    echo '    <th class="w-50">Nombre</th><th>País</th><th>FECHA</th>';
    echo '</tr>';
    foreach($listado->datos as $value)
    {
        echo "<tr>";
            echo "<td><a href='company.php?id=".$value['ID']."'>".$value["NOMBRE"]."</a></td><td>".$value["PAIS"]."</td><td>".$value["FECHA"]."</td>";
        echo "</tr>";
        
    }
    break;

    case "p":
    echo '<table class="table borderless table-striped">';
    echo '<tr>';
    echo '    <th class="w-50">Nombre</th><th>COMPANY</th><th>FECHA</th>';
    echo '</tr>';
    foreach($listado->datos as $value)
    {
        echo "<tr>";
            echo "<td><a href='plataforma.php?id=".$value['ID']."'>".$value["NOMBRE"]."</a></td><td><a href='company.php?id=".$value['COMPANY_ID']."'>".$value["COMPANY"]."</a></td><td>".$value["FECHA"]."</td>";
        echo "</tr>";
        
    }
    break;

    case "u":
    echo '<table class="table borderless table-striped">';
    echo '<tr>';
    echo '    <th class="w-75">Usuario</th><th>Registro</th>';
    echo '</tr>';
    foreach($listado->datos as $value)
    {
        echo "<tr>";
            echo "<td><a href='plataforma.php?id=".$value['ID']."'>".$value["NOMBRE"]."</a></td><td>".$value["REGISTRO"]."</td>";
        echo "</tr>";
        
    }
    
}
echo '</table>';


}
else
{
    $juegos = [];
    $plat = [];
    $company = [];
    $staff = [];

    foreach($listado->datos as $value)
    {
        if($value["tabla"]=="juego")
        {
            $juegos[]=$value;
        }
        else if($value["tabla"]=="plataforma")
        {
            $plat[]=$value;
        }
        else if($value["tabla"]=="staff")
        {
            $staff[]=$value;
        }
        else if($value["tabla"]=="company")
        {
            $company[]=$value;
        }
    }
     echo '<div id="accordion">';
        
    if(count($juegos)>0)
    {
        ?>
        <div class="card blackLinkColor">
            <div class="card-header">
                <p class="text-center .display-3"><a class="card-link " data-toggle="collapse" href="#collapseJuego">
                JUEGOS
                </a></p>
            </div>
            <div id="collapseJuego" class="collapse show" data-parent="#accordion">
                <div class="card-body">
            <?php
                    echo '<table class="table borderless table-striped my-3">';
                    echo '<tr>';
                    echo '    <th class="w-75">Título</th><th>Fecha</th><th>Nota</th>';
                    echo '</tr>';
                    foreach($juegos as $key=>$value)
                    {
                        echo "<tr>";
                        echo "<td><a href='juego.php?id=".$value['ID']."'>".$value["TITULO"]."</a></td><td>".$value["DATO1"]."</td><td>".$value["DATO2"]."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                </div>
            </div>
        </div>
    <?php
    }

    if(count($plat)>0)
    {
        ?>
        <div class="card blackLinkColor my-3">
            <div class="card-header">
                <p class="text-center .display-3"><a class="card-link " data-toggle="collapse" href="#collapsePlat">
                PLATAFORMAS
                </a></p>
            </div>
            <div id="collapsePlat" class="collapse show" data-parent="#accordion">
                <div class="card-body">
            <?php
                    echo '<table class="table borderless table-striped my-3">';
                    // echo '<tr>';
                    // echo '    <th colspan="3" class="text-center"> PLATAFORMAS </th>';
                    // echo '</tr>';
                    echo '<tr>';
                    echo '    <th class="w-50">Nombre</th><th>COMPANY</th><th>FECHA</th>';
                    echo '</tr>';
                    foreach($plat as $value)
                    {
                        echo "<tr>";
                            echo "<td><a href='plataforma.php?id=".$value['ID']."'>".$value["TITULO"]."</a></td><td><a href='company.php?id=".$value['DATO3']."'>".$value["DATO2"]."</a></td><td>".$value["DATO1"]."</td>";
                        echo "</tr>";
                        
                    }
                    echo "</table>";
                    ?>
                </div>
            </div>
        </div>
    <?php

    }

    if(count($company)>0)
    {
        ?>
        <div class="card blackLinkColor my-3">
            <div class="card-header">
                <p class="text-center .display-3"><a class="card-link " data-toggle="collapse" href="#collapseCompany">
                COMPAÑÍAS
                </a></p>
            </div>
            <div id="collapseCompany" class="collapse show" data-parent="#accordion">
                <div class="card-body">
            <?php
                    echo '<table class="table borderless table-striped my-3">';
                    echo '<tr>';
                    echo '    <th class="w-50">Nombre</th><th>País</th><th>FECHA</th>';
                    echo '</tr>';
                    foreach($company as $value)
                    {
                        echo "<tr>";
                            echo "<td><a href='company.php?id=".$value['ID']."'>".$value["TITULO"]."</a></td><td>".$value["DATO2"]."</td><td>".$value["DATO1"]."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                </div>
            </div>
        </div>
        <?php
        
    }
    if(count($staff)>0)
    {
        ?>
        <div class="card blackLinkColor my-3">
            <div class="card-header">
                <p class="text-center .display-3"><a class="card-link " data-toggle="collapse" href="#collapseStaff">
                PERSONAS
                </a></p>
            </div>
            <div id="collapseStaff" class="collapse show" data-parent="#accordion">
                <div class="card-body">
            <?php
                    echo '<table class="table borderless table-striped my-3">';
                    echo '<tr>';
                    echo '    <th colspan="3" class="text-center"> PERSONAS </th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '    <th class="w-50">Nombre</th><th>Nacionalidad</th><th>Género</th>';
                    echo '</tr>';
                    foreach($staff as $value)
                    {
                        echo "<tr>";
                            echo "<td><a href='staff.php?id=".$value['ID']."'>".$value["TITULO"]."</a></td><td>".$value["DATO1"]."</td><td>".$value["DATO2"]."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    ?>
                </div>
            </div>
        </div>
        <?php
        
    }

     echo '</div>';

}
echo $listado->pages->page_links('?', '&'.$tipo.'='.$busqueda);
?>
