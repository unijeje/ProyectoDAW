$( document ).ready(function() {
    $( "#tabs" ).tabs();
    cargarRevisionesStaff();
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
function cargarRevisionesStaff()
{

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
