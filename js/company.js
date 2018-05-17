$( document ).ready(function() {
    $( "#tabs" ).tabs();
    
    var sDatosRevisiones = "datos="+JSON.stringify({id:company_id, tipo: companyRev})
    $.get("../servidor/gestionRevisiones/getRevisiones.php", sDatosRevisiones, cargarRevisionesStaff, "json");

});



$("#btnEditar").click(editarCompany);
$("#editarCompanyBtn").click(function()
{
    $("#formEditarCompany").show();
});
$("#eliminar").click(function()
{
    $( "#dialog-eliminar" ).dialog("open");
});
function editarCompany()
{
    if(validarEdicionCompany())
    {
        $("#guidelines").hide();
        $("#registroError").hide();
        var sNombre=$("#nombre").val().trim();
        var sPais=$("#pais").val().trim();
        var sDesc=$("#desc").val().trim();
        var sFecha=$('#fecha').val().trim();
        var sEnlace=$("#enlace").val().trim();

        var oCompany=  {id: company_id,
                        nombre: sNombre,
                        pais: sPais,
                        desc: sDesc,
                        fecha: sFecha,
                        enlace: sEnlace};

        var sDatos= "datos="+JSON.stringify(oCompany);
        //console.log(oPersona);
        $.post("../servidor/gestionCompany/editarCompany.php",sDatos,function(bExito, sStatus, oAjax){

            
            if(bExito==true)
            {
                $("#formEditarCompany").hide();
                $("#guidelines").hide();
                $("#registrado").show();
                window.location.reload();
                
            }
            else
            {
                $("#registroError").show();
                $("#guidelines").show();
            }
            
        },"json");
    
    }

}
function eliminarCompany()
{
    
    var sDatos= "datos="+company_id;
    $.post("../servidor/gestionCompany/eliminarCompany.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito==true)
        {
            $("#formEditarCompany").hide();
            $("#borrarCompany").hide();
            $("#guidelines").hide();
            $("#registrado").show();
            
        }
        else
        {
            $("#registroError").show();
        }
        
    },"json");

}
function cargarRevisionesStaff(oRespuesta, sStatus, oAjax)
{

    if(oAjax.status==200)
    {
        
        for(var i=0;i<oRespuesta.length;i++)
        {
            var sID = oRespuesta[i].ID;
            var sNumero = oRespuesta[i].NUMERO;
            var sFecha = oRespuesta[i].FECHA.padEnd(10);
            var sDescripcion = oRespuesta[i].DESCRIPCION.padEnd(10);
            var sUsuario = oRespuesta[i].NOMBRE;
            var sIdUsuario = oRespuesta[i].PERFIL;
            var sHtml = "<tr>";
            sHtml += "<td><a href='revision.php?id="+sID+"'>J"+company_id+"."+sNumero+"</a></td>";
            sHtml += "<td><a href='perfil.php?id="+sIdUsuario+"'>"+sUsuario+"</a></td>";
            sHtml += "<td>"+sDescripcion+"</td>";
            sHtml += "<td>"+sFecha+"</td>";
            sHtml += "</tr>";
            $("#revisionesListado").append(sHtml);
        }
    }
    else
    {
        $("#revisionesCompany").append("<p>Error. No se han podido obtener las revisiones desde el servidor.</p>");
    }
}
function validarEdicionCompany()
{
    var res=true;
    
    if($("#nombre").val().trim()=="")
    {
       invalidarCampo($("#nombre"), "No puede dejar este campo vacio", true);
       res=false;
    }
    else
        invalidarCampo($("#nombre"), "No puede dejar este campo vacio", false);

       
    return res;
}


$( "#dialog-eliminar" ).dialog({
    resizable: false,
    height: "auto",
    width: 400,
    modal: true,
    closeOnEscape: false,
    autoOpen: false,
    buttons: {
        Mantener: function() {
            $( this ).dialog( "close" );
        },
        Eliminar: function() {
            eliminarCompany();
            $( this ).dialog( "close" );
        }

    }
});
