
$("#btnBusqueda").click(buscarCompany);
$("#btnFiltro").click(function()
{
    $("#formFiltroStaff").show(); //por hacer
});

var $limit=9;
var $nCols=3;
var $resPorTabla=$limit/$nCols;

function buscarCompany()
{
    $("#registroError").hide();

    var sNombre=$("#txtBusqueda").val().trim();

    if(sNombre=="")
        invalidarCampo($("#txtBusqueda"), "Introduzca algún caracter", true);
    else
    {
        invalidarCampo($("#txtBusqueda"), "Introduzca algún caracter", false);
    
        window.location.href = "busqueda.php?c="+sNombre;
    // var sDatos= "datos="+sNombre;
    // //console.log(oPersona);
    // $.get("../servidor/gestionCompany/buscarCompany.php",sDatos,function(res, sStatus, oAjax){
    //     var sHtml='<div class="list-inline text-center col-12">';
    //     //console.log(res)
    //     var j=0;
    //     for(var i=0;i<res.length;i++)
    //     {
    //         if(j==$resPorTabla)
    //         {
    //             sHtml+= '</div>';
    //             sHtml+= '<div class="list-inline text-center col-12">';
    //             sHtml+= "<br>";
    //             j=0;
    //         }
    //         var sId=res[i].id;
    //         var sNombre=res[i].nombre;
    //         sHtml+='<li class="list-inline-item elementoListado"><a href="company.php?id='+sId+'" class="list-group-item list-group-item-action">'+sNombre+'</a></li>';
    //         j++;
    //     }
    //     sHtml+="</div>"
        

    //     $("#listado").html(sHtml);
    //     $("#paginacion").hide();    
        
    // },"json");
    
    }

}


