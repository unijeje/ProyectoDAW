
$("#btnBusqueda").click(buscarPersona);
$("#btnFiltro").click(function()
{
    $("#formEditarStaff").show();
});

var $limit=9;
var $resPorTabla=$limit/3;

function buscarPersona()
{
    $("#registroError").hide();

    var sNombre=$("#txtBusqueda").val().trim();

    var sDatos= "datos="+sNombre;
    //console.log(oPersona);
    $.get("../servidor/gestionPersona/buscarPersona.php",sDatos,function(res, sStatus, oAjax){
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
            sHtml+='<li class="list-inline-item"><a href="staff.php?id='+sId+'" class="list-group-item list-group-item-action">'+sNombre+'</a></li>';
            j++;
        }
        sHtml+="</div>"
        

        $("#listado").html(sHtml);
        $("#paginacion").hide();    
        
    },"json");
    
    

}
function eliminarPersona()
{
    
    var sDatos= "datos="+staff_id;
    $.post("../servidor/gestionPersona/eliminarPersona.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito==true)
        {
            $("#formEditarStaff").hide();
            $("#borrarStaff").hide();
            $("#guidelines").hide();
            $("#registrado").show();
            
        }
        else
        {
            $("#registroError").show();
        }
        
    },"json");

}
function cargarRevisionesStaff()
{

}
function validarEdicionStaff()
{
    var res=true;


    return res;
}


