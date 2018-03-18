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



function validarCrearCuenta()
{
    var res=true;


    return res;
}