$(document).ready(function() {
    $.get("../servidor/gestionJuego/cargarJuegos.php", function(oRespuesta, sStatus, oAjax)
    {
        //'sDom': 'lptip' ,
        var juegos=$('#tablaListadoJuego').DataTable( {
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


} );


//$("#btnBusqueda").click(buscarJuego);
$("#btnFiltro").click(function()
{
    $("#formEditarJuego").show(); //por hacer
});

var $limit=9;


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




