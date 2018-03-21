﻿/*
$( function() {
$( "#formAddCompany #fecha" ).datepicker({ dateFormat: 'yy-mm-dd' });
} );
*/

$("#btnADD").click(addPlat);
$("#registrarOtro").click(mostrarForm);
$.get("../servidor/gestionCompany/autoCompleteCompany.php", respuestaAutoCompleteCompany, "json");

function mostrarForm()
{
    $("#formAddPlat").show();
    $("#guidelines").show();
    $("h1").show();
    $("#registroError").hide();
    $("#registrarOtro").hide();
    $("#registrado").hide();
}

function addPlat()
{
    $("#guidelines").hide();
    $("#registroError").hide();
    $("#registrarOtro").hide();
    if(validarPlat())
    {
        var sNombre=$("#nombre").val().trim();
        var sCompany=$("#company").val().trim();
        var sDesc=$("#desc").val().trim();
        var sFecha=$('#fecha').val().trim();
        var sEsp=$("#esp").val().trim();

        var oPlat=  {nombre: sNombre,
                        company: sCompany,
                        desc: sDesc,
                        fecha: sFecha,
                        esp: sEsp};

        var sDatos= "datos="+JSON.stringify(oPlat);
        $.post("../servidor/gestionPlataforma/altaPlat.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito==true)
        {
            $("#formAddPlat").hide();
            $("h1").hide();
            $("#guidelines").hide();
            $("#registrado").show();
            $("#registrarOtro").show();
            
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
        
        $("#formAddPlat #company").autocomplete({
            source: ids,
            minLength: 0,
            select: function(event, ui){
                 $("#formAddPlat #company").val(ui.item.value);
                 $("#formAddPlat #company-name").val(ui.item.desc);
                 //$("#cliente-dni").val(ui.item.value);
                 return false;
            }}).autocomplete("instance")._renderItem=function(ul, item){
                return $("<li>").append("<div>"+item.value+"<br>"+item.desc+"</div>").appendTo(ul);
            };
    }
}

function validarPlat()
{
    var res=true;

    return res;
}