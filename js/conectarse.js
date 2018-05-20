$("#btnConectar").click(conectarse);

$("#pass").keyup(function(event)
{
    var code = event.keyCode || event.which;
    if(code == 13) { //Enter keycode
        conectarse();
    }
});

function conectarse()
{
    
    $("#registrado").hide();
    $("#registroError").hide();

    if(validarConexion())
    {

        var sNombre=formConectarse.usuario.value.trim();
        var sPass=formConectarse.pass.value.trim();
        
        var oCuenta={nombre: sNombre,
                        pass: sPass};
        
        var sDatos= "datos="+JSON.stringify(oCuenta);
        $.get("../servidor/gestionCuenta/conectarse.php",sDatos,function(oRespuesta, sStatus, oAjax)
        {
            if(oRespuesta[0]==true)
            {
                //$("#registrado").show();
                //$("#conectarse").hide();
                var recordar=document.getElementById("recordar").checked;
                if(recordar)
                {
                    //console.log(oRespuesta);
                    setCookie("tipo", oRespuesta[1], 100);
                    setCookie("nombre", oRespuesta[2], 100);
                    setCookie("id", oRespuesta[3], 100);
                    setCookie("clave", oRespuesta[4], 100);
                }

            
                window.location.replace("../index.php");
            }
            else
            {
                $("#registroError").show();
                $("#registroError h2").text(oRespuesta[1]);
            }
        },"json");
    }
    
}



function validarConexion()
{
    var res=true;
    //console.log($("#usuario"));
    res=validacionCampo($("#usuario"), "Tiene que tener entre 3 y 20 carácteres", oExpRegNombre);

    if(!validacionCampo($("#pass"), "Tiene que tener un número, caracter y longitud 4", oExpRegPass))
        res=false;

    return res;
}
