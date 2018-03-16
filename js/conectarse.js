$("#btnConectar").click(conectarse);

function conectarse()
{

    $("#registrado").hide();
    $("#registroError").hide();

    var sNombre=formConectarse.usuario.value.trim();
    var sPass=formConectarse.pass.value.trim();
    
    var oCuenta={nombre: sNombre,
                    pass: sPass};
    
    var sDatos= "datos="+JSON.stringify(oCuenta);
    $.get("../servidor/conectarse.php",sDatos,function(oRespuesta, sStatus, oAjax){
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
