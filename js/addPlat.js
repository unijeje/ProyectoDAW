/*
$( function() {
$( "#formAddCompany #fecha" ).datepicker({ dateFormat: 'yy-mm-dd' });
} );
*/
var companies=[];
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
        if(bExito[0])
        {
            $("#formAddPlat").hide();
            $("h1").hide();
            $("#guidelines").hide();
            $("#registrado").show();
            $("#registrarOtro").show();
            altaRevision(oPlat, user_id, plataformaRev, bExito[1]);
            $("#formAddPlat")[0].reset();
            $("#registrarOtro span").html("<a href=plataforma.php?id="+bExito[1]+">Ir a la nueva plataforma.</a>");
        }
        else
        {
            $("#registroError p").text(bExito[1]);
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
        

        for(var i=0;i<oRespuesta.length;i++)
        {
            //arrayDNI.push(oRespuesta[i].dni);
            var arrayDatos={};
            arrayDatos["value"]=oRespuesta[i].nombre;
            arrayDatos["desc"]="Fecha: "+oRespuesta[i].fecha+" - País: "+oRespuesta[i].pais;
            companies.push(arrayDatos);
        }
        
        $("#formAddPlat #company").autocomplete({
            source: companies,
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