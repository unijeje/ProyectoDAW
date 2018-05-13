/*
$( function() {
$( "#formAddCompany #fecha" ).datepicker({ dateFormat: 'yy-mm-dd' });
} );
*/

$("#btnADD").click(addStaff);
$("#registrarOtro").click(mostrarForm);

function mostrarForm()
{
    $("#formAddCompany").show();
    $("#guidelines").show();
    $("h1").show();
    $("#registroError").hide();
    $("#registrarOtro").hide();
    $("#registrado").hide();
}

function addStaff()
{
    $("#guidelines").hide();
    $("#registroError").hide();
    $("#registrarOtro").hide();
    if(validarCompany())
    {
        var sNombre=$("#nombre").val().trim();
        var sPais=$("#pais").val().trim();
        var sDesc=$("#desc").val().trim();
        var sFecha=$('#fecha').val().trim();
        var sEnlace=$("#enlace").val().trim();

        var oCompany=  {nombre: sNombre,
                        pais: sPais,
                        desc: sDesc,
                        fecha: sFecha,
                        enlace: sEnlace};

        var sDatos= "datos="+JSON.stringify(oCompany);
        $.post("../servidor/gestionCompany/altaCompany.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito==true)
        {
            $("#formAddCompany").hide();
            $("h1").hide();
            $("#guidelines").hide();
            $("#registrado").show();
            $("#registrarOtro").show();
            altaRevision(oCompany, user_id, companyRev);
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

function validarCompany()
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