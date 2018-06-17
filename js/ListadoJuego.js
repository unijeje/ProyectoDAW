var juegos;

$(document).ready(function() 
{
    $.get("../servidor/gestionJuego/cargarJuegos.php", function(oRespuesta, sStatus, oAjax)
    {
        //'sDom': 'lptip' ,
        juegos=$('#tablaListadoJuego').DataTable( {
        destroy: true,
        data: oRespuesta,
        'sDom': "<'row'<'col-6'l><'col-6'p>>" +
                "<'row'<'col-12't>>" +
                "<'row'<'col-6'i><'col-6'p>>",
        "language": {
            "url": "../utilities/datatable_ESP.lang"
        },
        columns: [
                { data: 'TITULO',
                fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                $(nTd).html("<a href='juego.php?id="+oData.ID+"'>"+oData.TITULO+"</a>");
                }
            },
                { data: 'FECHA' },
                { data: 'MEDIA'}
                ]
    } );

    $('#txtBusqueda').keyup(function() {
        juegos.search($(this).val()).draw();
    });
    
    }, "json");


    $.get("../servidor/gestionJuego/getListaGeneros.php", getListadoGenero, "json");
    $.get("../servidor/gestionJuego/getListaDuracion.php", getListadoDuracion, "json");
    $.get("../servidor/gestionPlataforma/listadoPlat.php", getListadoPlataforma, "json");
    //$("#btnBusqueda").click(buscarJuego);
    $("#btnFiltro").click(function()
    {
        $("#formEditarJuego").toggle(); 
    });

    //datepicker
    $( function() {
        var today = new Date();
        var maxYear=today.getFullYear()+3;
        $(".fecha").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm-dd',
            yearRange: "1950:"+maxYear
            });
    } );

    $("#btnFiltroAvanz").click(busquedaAvanzada);
    
} );


function busquedaAvanzada()
{
    var oGeneros = $("#generos").val();

    var oDuracion = $("#duracion").val();

    var oplat = $("#plataformas").val();

    var $sql = "SELECT DISTINCT j.ID, j.TITULO, j.FECHA, j.MEDIA FROM juego j "

    if(oGeneros.length>0 && !oGeneros.includes("t"))
    {
        $sql += " inner join generos_juego g on j.id=g.id_juego ";
    }

    if(oplat.length>0 && !oplat.includes("t"))
    {
       $sql += " inner join plataforma_juego p on j.id=p.id_juego ";
    }

    $sql += " where true ";

    if(oDuracion.length>0 && !oDuracion.includes("t"))
    {
        $sql += " and j.duracion in ( ";
        for(var i=0;i<oDuracion.length;i++)
        {
            if(i == oDuracion.length-1)
            {
                $sql += oDuracion[i] + " ) ";
            }
            else
            {
                $sql += oDuracion[i] + ", ";
            }
        }
    }

    if(oGeneros.length>0 && !oGeneros.includes("t"))
    {
        $sql += " and g.id_genero in ( ";
        for(var i=0;i<oGeneros.length;i++)
        {
            if(i == oGeneros.length-1)
            {
                $sql += oGeneros[i] + " ) ";
            }
            else
            {
                $sql += oGeneros[i] + ", ";
            }
        }
    }

    if(oplat.length>0 && !oplat.includes("t"))
    {
        $sql += "and p.id_plataforma in ( ";
        for(var i=0;i<oplat.length;i++)
        {
            if(i == oplat.length-1)
            {
                $sql += oplat[i] + " )";
            }
            else
            {
                $sql += oplat[i] + ", ";
            }
        }
    }

    var sFechaMin = $("#fechaMin").val();
    var sFechaMax = $("#fechaMax").val();

    if(sFechaMin.length > 0)
    {
        $sql += " and j.fecha > '"+sFechaMin+"'";
    }
    if(sFechaMax.length > 0)
    {
        $sql += " and j.fecha < '"+sFechaMax+"'";
    }

    $sql += " and j.activo=1";

    console.log($sql);

    var sDatos= "datos="+$sql;

    

    // juegos.ajax.url( '../servidor/gestionJuego/cargarJuegosBusqueda.php?'+sDatos ).load();

    $.get("../servidor/gestionJuego/cargarJuegosBusqueda.php", sDatos, function(oRespuesta, sStatus, oAjax)
    {
        
        juegos.destroy();
        $("#tablaListadoJuego").empty();
        $("#tablaListadoJuego").append("<thead><tr><th class='w-75'>Título</th><th>Lanzamiento</th><th>Rating</th></tr></thead>");
        juegos=$('#tablaListadoJuego').DataTable( {
            destroy: true,
            data: oRespuesta,
            'sDom': "<'row'<'col-6'l><'col-6'p>>" +
                    "<'row'<'col-12't>>" +
                    "<'row'<'col-6'i><'col-6'p>>",
            "language": {
                "url": "../utilities/datatable_ESP.lang"
            },
            columns: [
                    { data: 'TITULO',
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='juego.php?id="+oData.ID+"'>"+oData.TITULO+"</a>");
                    }
                },
                    { data: 'FECHA' },
                    { data: 'MEDIA'}
                    ]
        } );
    
        $('#txtBusqueda').keyup(function() {
            juegos.search($(this).val()).draw();
        });

        // for(var i=0;i<oRespuesta.length;i++)
        // {
        //     juegos.rows.add([
        //     {
        //         TITULO: fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
        //             $(nTd).html("<a href='juego.php?id="+oRespuesta.ID+"'>"+oRespuesta.TITULO+"</a>");},
        //         FECHA: oRespuesta[i].FECHA,
        //         MEDIA: oRespuesta[i].MEDIA,
        //     }
        //     ]).draw();
        // }

    }, "json");

}

function getListadoPlataforma(oDuracion, sStatus, oAjax)
{
    var sHtml="";
    for(var i=0;i<oDuracion.length;i++)
    {
        sHtml+="<option value='"+oDuracion[i].id+"'>"+oDuracion[i].nombre+"</option>";
    }
    $("#plataformas").append(sHtml);
}

function getListadoDuracion(oDuracion, sStatus, oAjax)
{
    var sHtml="";
    for(var i=0;i<oDuracion.length;i++)
    {
        sHtml+="<option value='"+oDuracion[i].id+"'>"+oDuracion[i].duracion+"</option>";
    }
    $("#duracion").append(sHtml);
}

function getListadoGenero(oGeneros, sStatus, oAjax)
{
    var sHtml="";
    for(var i=0;i<oGeneros.length;i++)
    {
        sHtml+="<option value='"+oGeneros[i].id+"'>"+oGeneros[i].genero+"</option>";
    }

    $("#generos").append(sHtml);

}


function buscarJuego()
{
    $("#registroError").hide();

    var sNombre=$("#txtBusqueda").val().trim();

    var sDatos= "datos="+sNombre;
    //console.log(oPersona);
    $.get("../servidor/gestionPlataforma/buscarPlat.php",sDatos,function(res, sStatus, oAjax){
        var sHtml='<div class="list-inline text-center col-12">';
        //console.log(res)
        var j=0;
        for(var i=0;i<res.length;i++)
        {
            if(j==$resPorTabla)
            {
                sHtml+= '</div>';
                sHtml+= '<div class="list-inline text-center col-12">';
                sHtml+= "<br>";
                j=0;
            }
            var sId=res[i].id;
            var sNombre=res[i].nombre;
            sHtml+='<li class="list-inline-item elementoListado"><a href="plataforma.php?id='+sId+'" class="list-group-item list-group-item-action">'+sNombre+'</a></li>';
            j++;
        }
        sHtml+="</div>"
        

        $("#listado").html(sHtml);
        $("#paginacion").hide();    
        
    },"json");
    
    

}




