function falloValidacion(sTexto, oInput)
{
    //console.log(oInput);
    var oTexto=document.createTextNode(sTexto);
    var oDiv=document.createElement("div");
    oDiv.setAttribute("id", "error");
    oDiv.appendChild(oTexto);
    var oAnterior=oInput.parentNode.querySelector("#error");

    if(oAnterior)
        oAnterior.textContent=sTexto;
    else
        oInput.parentNode.appendChild(oDiv);
}

/*
function comprobarLogin()
{
    if(getCookie("tipo")!="")
    {
        console.log("tiene cookie");

        var sNombre=getCookie("nombre");
        var sTipo=getCookie("tipo");
        var oCuenta={nombre: sNombre,
            tipo: sTipo};

        var sDatos= "datos="+JSON.stringify(oCuenta);
        
        $.get("servidor/manejadorSesiones.php",sDatos);
        
    }
}
*/
function getCookie(cname) { // cookie name
    var name = cname + "=";
    var ca = document.cookie.split(';'); // Splitea los pares key (clave) / value (valor) name1=valor1;name2=valor2
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


/*ExpReg*/

function validacionCampo(oCampo, sMensaje, oExpReg)
{
    var res=true;

    if(typeof(oCampo)=="object")
        oCampo=oCampo[0];

    
    if(!oExpReg.test(oCampo.value.trim()))
    {
        res=false;
        $(oCampo).addClass("is-invalid");
        if($(oCampo).parent().find(".invalid-feedback").length>0)
        {
            $(oCampo).parent().find('.invalid-feedback').text(sMensaje);
        }
        else
            $(oCampo).parent().append('<div class="invalid-feedback">'+sMensaje+'</div>');
    }
    else
    {
        $(oCampo).removeClass("is-invalid");
        $(oCampo).parent().find('.invalid-feedback').remove();
    }

    return res;
}

function invalidarCampo(oCampo, sMensaje, bool)
{
    if(typeof(oCampo)=="object")
        oCampo=oCampo[0];

    if(bool)
    {
        $(oCampo).addClass("is-invalid");
        if($(oCampo).parent().find(".invalid-feedback").length>0)
        {
            $(oCampo).parent().find('.invalid-feedback').text(sMensaje);
        }
        else
            $(oCampo).parent().append('<div class="invalid-feedback">'+sMensaje+'</div>');
    }
    else
    {
        $(oCampo).removeClass("is-invalid");
        $(oCampo).parent().find('.invalid-feedback').remove();
    }
}


function altaRevision(oDatos, sUser, sTipo)
{

    if(oDatos == null || sUser == null || sTipo == null)
    {
        return "Error inesperado. Parámetros para la revision no son correctos.";
    }

    var sDatos = JSON.stringify({usuario : sUser , tipo : sTipo , datos : JSON.stringify(oDatos)});

    var sDatos = "revision="+ sDatos;

    $.post("../servidor/gestionRevisiones/revision.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito[0])
        {
            //TODO: log en fichero con revisiones
            
        }
        else
        {
            
        }
        },"json");
}

var plataformaRev = "P";
var juegoRev = "J";
var companyRev = "C";
var staffRev = "S";

var oExpRegNombre = /^[a-z\s]{3,20}$/i; //ENTRE 3 y 20 CARACTERES
var oExpRegPass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,40}$/i; //ENTRE 4, 40 una letra y numero al menos
var oExpRegEmail = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;