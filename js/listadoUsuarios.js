
$("#btnBusqueda").click(buscarUsuario);
$("#btnFiltro").click(function()
{
    $("#formEditarStaff").show();
});

var $limit=9;
var $resPorTabla=$limit/3;

function buscarUsuario()
{
    $("#registroError").hide();

    var sNombre=$("#txtBusqueda").val().trim();

    if(sNombre=="")
        invalidarCampo($("#txtBusqueda"), "Introduzca algún caracter", true);
    else
    {
        invalidarCampo($("#txtBusqueda"), "Introduzca algún caracter", false);

        window.location.href = "busqueda.php?u="+sNombre;
        // var sDatos= "datos="+sNombre;
        // //console.log(oPersona);
        // $.get("../servidor/gestionCuenta/buscarUsuario.php",sDatos,function(res, sStatus, oAjax){
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
        //         sHtml+='<li class="list-inline-item elementoListado"><a href="perfil.php?id='+sId+'" class="list-group-item list-group-item-action">'+sNombre+'</a></li>';
        //         j++;
        //     }
        //     sHtml+="</div>"
            

        //     $("#listado").html(sHtml);
        //     $("#paginacion").hide();    
            
        // },"json");
        
    }

}



