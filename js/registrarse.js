$("#crear").click(crearCuenta);

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
        $.post("../servidor/gestionCuenta/altaCuenta2.php",sDatos,function(bExito, sStatus, oAjax){
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



function validarCrearCuenta()
{
    var res=true;

    res=validacionCampo($("#usuario"), "Tiene que tener entre 3 y 20 carácteres", oExpRegNombre);

    if(!validacionCampo($("#pass"), "Tiene que tener un número, caracter y longitud 4", oExpRegPass))
        res=false;

    if(!validacionCampo($("#email"), "El correo no es válido", oExpRegEmail))
        res=false;

    if($("#pass2").val().trim()!=$("#pass").val().trim() || $("#pass2").val().trim()=="")
    {
        invalidarCampo($("#pass2"), "Las contraseñas no coinciden", true);
        res=false;
    }
    else
        invalidarCampo($("#pass2"), "", false);

    return res;
}