$( document ).ready(function() {
    $( "#tabs" ).tabs();
    cargarRevisionesStaff();
    $.get("../servidor/gestionCompany/autoCompleteCompany.php", respuestaAutoCompleteCompany, "json");
});



$("#btnEditar").click(editarPlat);
$("#editarPlatBtn").click(function()
{
    $("#formEditarPlat").show();
});
$("#eliminar").click(function()
{
    $( "#dialog-eliminar" ).dialog("open");
});
function editarPlat()
{
    if(validarEdicionPlat())
    {
    $("#guidelines").hide();
    $("#registroError").hide();
    $("#borrarPlat").hide();
    var sNombre=$("#nombre").val().trim();
    var sCompany=$("#company").val().trim();
    var sDesc=$("#desc").val().trim();
    var sFecha=$('#fecha').val().trim();
    var sEsp=$("#esp").val().trim();

    var oPlat=  {id: plat_id,
                    nombre: sNombre,
                    company: sCompany,
                    desc: sDesc,
                    fecha: sFecha,
                    esp: sEsp};

    var sDatos= "datos="+JSON.stringify(oPlat);
    //console.log(oPersona);
    $.post("../servidor/gestionPlataforma/editarPlat.php",sDatos,function(bExito, sStatus, oAjax){

        
        if(bExito==true)
        {
            $("#formEditarPlat").hide();
            $("#guidelines").hide();
            
            $("#registrado").show();
            window.location.reload();
            
        }
        else
        {
            $("#registroError").show();
        }
        
    },"json");
    
    }
    else
    {
        $("#guidelines").show();
    }
}
function eliminarPlat()
{
    
    var sDatos= "datos="+plat_id;
    $.post("../servidor/gestionPlataforma/eliminarPlat.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito==true)
        {
            $("#formEditarPlat").hide();
            $("#borrarPlat").hide();
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
function validarEdicionPlat()
{
    var res=true;


    return res;
}

function respuestaAutoCompleteCompany(oRespuesta, sStatus, oAjax)
{
    if(oAjax.status==200)
    {
        var ids=[];

        for(var i=0;i<oRespuesta.length;i++)
        {
            //arrayDNI.push(oRespuesta[i].dni);
            var arrayDatos={};
            arrayDatos["value"]=oRespuesta[i].nombre;
            arrayDatos["desc"]="Fecha: "+oRespuesta[i].fecha+" - País: "+oRespuesta[i].pais;
            ids.push(arrayDatos);
        }
        
        $("#formEditarPlat #company").autocomplete({
            source: ids,
            minLength: 0,
            select: function(event, ui){
                 $("#formEditarPlat #company").val(ui.item.value);
                 $("#formEditarPlat #company-name").val(ui.item.desc);
                 //$("#cliente-dni").val(ui.item.value);
                 return false;
            }}).autocomplete("instance")._renderItem=function(ul, item){
                return $("<li>").append("<div>"+item.value+"<br>"+item.desc+"</div>").appendTo(ul);
            };
    }
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
            eliminarPlat();
            $( this ).dialog( "close" );
        }

    }
});
