$( document ).ready(function() {
    $( "#tabs" ).tabs();
    cargarRevisionesStaff();
});
/*
function crearCuenta()
{
    $("#registrado").hide();
    $("#registroError").hide();

    if(validarCrearCuenta())
    {
        var sNombre=altaCuenta.usuario.value.trim();
        var sCorreo=altaCuenta.email.value.trim();
        var sPass=altaCuenta.pass.value.trim();
        
        var oCuenta={nombre: sNombre,
                        correo: sCorreo,
                        pass: sPass};
        
        var sDatos= "datos="+JSON.stringify(oCuenta);
        $.post("../servidor/gestionCuenta/altaCuenta.php",sDatos,function(bExito, sStatus, oAjax){
            if(bExito==true)
            {
                $("#formCrearCuenta").hide();
                $("#registrado").show();
            }
            else
            {
                $("#registroError").show();
            }
        },"json");
    }
}

*/
$("#btnEditar").click(editarPersona);
$("#editarStaffBtn").click(function()
{
    $("#formEditarStaff").show();
});
function editarPersona()
{
    if(validarEdicionStaff())
    {
    $("#guidelines").hide();
    $("#registroError").hide();
    var sNombre=$("#nombre").val().trim();
    var sNacionalidad=$("#nacionalidad").val().trim();
    var sDesc=$("#desc").val().trim();
    var sGenero=$('input[name=radioGenero]:checked').val();
    var sEnlace=$("#enlace").val().trim();

    var oPersona={  id: staff_id,
                    nombre: sNombre,
                    nacionalidad: sNacionalidad,
                    desc: sDesc,
                    genero: sGenero,
                    enlace: sEnlace};

    var sDatos= "datos="+JSON.stringify(oPersona);
    //console.log(oPersona);
    $.post("../servidor/gestionPersona/editarPersona.php",sDatos,function(bExito, sStatus, oAjax){

        
        if(bExito==true)
        {
            $("#formEditarStaff").hide();
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
function cargarRevisionesStaff()
{

}
function validarEdicionStaff()
{
    var res=true;


    return res;
}