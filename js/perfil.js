$("#guardar").click(editarPerfil);
$("#eliminar").click(eliminarPerfil);
var sNombreUsuario=$("#usuario").val();
function editarPerfil()
{
    if($("#passAntigua").val().trim()=="") //sin contraseña
    {
        $("#registroError").hide();
        $("#registrado").hide();
        if(validarEdicionUsuario())
        {
            var sEmail=$("#email").val().trim();
            var oCuenta={nombre: sNombreUsuario,
                        id: user_id,
                        correo: sEmail};
            var sDatos= "datos="+JSON.stringify(oCuenta);
            $.post("../servidor/gestionCuenta/editarPerfilSinPass.php",sDatos,function(bExito, sStatus, oAjax){
                if(bExito==true)
                {
                    $("#formEditarPerfil").hide();
                    $("#registrado").show();
                    window.location.reload();
                }
                else
                {
                    $("#registroError").show();
                }
            },"json");
        }
        

    }
    else // con contraseña
    {
        if(validarEdicionUsuario())
        {
            var sEmail=$("#email").val().trim();
            var sPass=$("#passNueva").val().trim();
            var oCuenta={nombre: sNombreUsuario,
                        id: user_id,
                        pass: sPass,
                        correo: sEmail};
            var sDatos= "datos="+JSON.stringify(oCuenta);
            $.post("../servidor/gestionCuenta/editarPerfilConPass.php",sDatos,function(bExito, sStatus, oAjax){
                if(bExito==true)
                {
                    $("#formEditarPerfil").hide();
                    $("#registrado").show();
                    window.location.reload();
                }
                else
                {
                    $("#registroError").show();
                }
            },"json");
        }
    }
}



function validarEdicionUsuario()
{
    var res=true;

    //la contraseña se puede dejar en blanco o que cumpla parámetros

    return res;
}

function eliminarPerfil()
{
    $( "#dialog-eliminar" ).dialog("open");
}

function eliminarCuenta()
{
    var sDatos= "datos="+user_id;
    $.post("../servidor/gestionCuenta/eliminarCuenta.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito==true)
        {
            window.location.replace("logoff.php");
        }
    },"json");
}

$(document).on("click", "#editarPerfil", function(){
    $("#formEditarPerfil").show();
});

$(document).on("click", "#mostrarPerfil", function(){
    //cuando se clickea esto se vuelve a comprobar los datos del perfil por si hay necesidad de actualizarlos
});


$( "#dialog-eliminar" ).dialog({
    resizable: false,
    height: "auto",
    width: 400,
    modal: true,
    closeOnEscape: false,
    autoOpen: false,
    buttons: {
        Mantener: function() {
            $( this ).dialog( "close" );
        },
        Eliminar: function() {
            eliminarCuenta();
        }

    }
});

