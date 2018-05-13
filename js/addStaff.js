$("#btnADD").click(addStaff);
$("#registrarOtro").click(mostrarForm);

function mostrarForm()
{
    $("#formAddStaff").show();
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
    if(validarStaff())
    {
        var sNombre=$("#nombre").val().trim();
        var sNacionalidad=$("#nacionalidad").val().trim();
        var sDesc=$("#desc").val().trim();
        var sGenero=$('input[name=radioGenero]:checked').val();
        var sEnlace=$("#enlace").val().trim();

        var oPersona={nombre: sNombre,
                        nacionalidad: sNacionalidad,
                        desc: sDesc,
                        genero: sGenero,
                        enlace: sEnlace};

        var sDatos= "datos="+JSON.stringify(oPersona);
        $.post("../servidor/gestionPersona/altaPersona.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito[0])
        {
            $("#formAddStaff").hide();
            $("h1").hide();
            $("#guidelines").hide();
            $("#registrado").show();
            $("#registrarOtro").show();
            altaRevision(oPersona, user_id, staffRev, bExito[1]);
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

function validarStaff()
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