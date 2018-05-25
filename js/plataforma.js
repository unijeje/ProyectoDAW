var oPlatAntiguo; 
$( document ).ready(function() {
    $( "#tabs" ).tabs();
    
    if(user_id != -1)
    {
        $.get("../servidor/gestionCompany/autoCompleteCompany.php", respuestaAutoCompleteCompany, "json");
    }
    var sDatosRevisiones = "datos="+JSON.stringify({id:plat_id, tipo: plataformaRev})
    $.get("../servidor/gestionRevisiones/getRevisiones.php", sDatosRevisiones, cargarRevisionesStaff, "json");


    var sNombre=$("#nombre").val().trim();
    var sCompany=$("#company").val().trim();
    var sDesc=$("#desc").val().trim();
    var sFecha=$('#fecha').val().trim();
    var sEsp=$("#esp").val().trim();

    oPlatAntiguo =  {id: plat_id,
            nombre: sNombre,
            company: sCompany,
            desc: sDesc,
            fecha: sFecha,
            esp: sEsp};

});


var companies=[];
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
                editarRevision(oPlat, oPlatAntiguo, user_id, plataformaRev, plat_id, "Editar información de plataforma.");
                setTimeout(function(){window.location.reload();}, 1000);
                
            }
            else
            {
                $("#registroError").show();
                $("#registroError").text(bExito);
                $("#guidelines").show();
            }
            
        },"json");
        
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
            sHtml += "<td><a href='revision.php?id="+sID+"'>J"+plat_id+"."+sNumero+"</a></td>";
            sHtml += "<td><a href='perfil.php?id="+sIdUsuario+"'>"+sUsuario+"</a></td>";
            sHtml += "<td>"+sDescripcion+"</td>";
            sHtml += "<td>"+sFecha+"</td>";
            sHtml += "</tr>";
            $("#revisionesListado").append(sHtml);
        }
    }
    else
    {
        $("#revisionesPlataforma").append("<p>Error. No se han podido obtener las revisiones desde el servidor.</p>");
    }
}
function validarEdicionPlat()
{
    var res=true;
    
    if($("#nombre").val().trim()=="")
    {
       invalidarCampo($("#nombre"), "No puede dejar este campo vacio", true);
       res=false;
    }
    else
        invalidarCampo($("#nombre"), "No puede dejar este campo vacio", false);


    var valComapny=false;
    var company=$("#company").val();

    for(var i=0;i<companies.length;i++)
    {
        if(companies[i].value==company)
            valComapny=true;
    }

    if(!valComapny)
    {
        invalidarCampo($("#company"), "Esta compañía no existe", true);
        res=false;
    }
    else
        invalidarCampo($("#company"), "Esta compañía no existe", false);


    return res;
}

function respuestaAutoCompleteCompany(oRespuesta, sStatus, oAjax)
{
    if(oAjax.status==200)
    {
        

        for(var i=0;i<oRespuesta.length;i++)
        {
            //arrayDNI.push(oRespuesta[i].dni);
            var arrayDatos={};
            arrayDatos["value"]=oRespuesta[i].nombre;

            var fecha = oRespuesta[i].fecha == null || oRespuesta[i].fecha.trim()=="" ? "0/0/0" : oRespuesta[i].fecha;
            var pais = oRespuesta[i].pais == null || oRespuesta[i].pais.trim()=="" ? "desconocido" : oRespuesta[i].pais;

            arrayDatos["desc"]="Fecha: "+fecha+" - País: "+pais;
            companies.push(arrayDatos);
        }
        
        $("#formEditarPlat #company").autocomplete({
            source: companies,
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
