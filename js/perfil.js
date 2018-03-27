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

$(document).ready(function() {
    var sDatos= "datos="+user_id;
    $.get("../servidor/gestionCuenta/getJuegos.php", sDatos, function(oRespuesta, sStatus, oAjax)
    {
        

        //'sDom': 'lptip' ,
        if($('#tablaPerfilJuego').length>0)
        {
            var juegos=$('#tablaPerfilJuego').DataTable( {
            data: oRespuesta,
            'sDom': "<'row'<'col-7'l><'col-5'f>>" +
                    "<'row'<'col-12't>>" +
                    "<'row'<'col-7'i><'col-5'p>>",
            "language": {
                "url": "../utilities/datatable_ESP.lang"
            },
            columns: [
                    { data: 'cover',
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        if(sData!=null)
                            $(nTd).html("<img class='imgCoverMin' src='../img/covers/"+oData.id+".png'>" );
                        else
                            $(nTd).html("<div class='autoAlturaTd'> </div>" );
                        }
                        
                },
                    { data: 'titulo',
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='juego.php?id="+oData.id+"'>"+oData.titulo+"</a>");
                    }
                },
                    { data: 'nota', 
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        var sSelect='<select data-nota="'+oData.id+'" class="nota" name="nota">';
                        sSelect+="<option value='revoke'>Eliminar Nota</option>";
                        for(var i=1;i<=10;i++)
                        {
                            if(i==oData.nota)
                                sSelect+="<option selected value='"+i+"'>"+i+"</option>";
                            else
                                sSelect+="<option value='"+i+"'>"+i+"</option>";
                        }
                        sSelect+="</select>";
                        $(nTd).html("<div class='text-center'>"+ sSelect+"</div>");
                        
                    }
                },
                    { data: 'fecha'}
                    ]
        } );

        setTimeout(function()
        {
            var iLength=$(".nota").length;
            for(var i=0;i<iLength;i++)
            {
                $($(".nota")[i]).change(actualizarNota);
            }
        
        }, 250);
    }
    else 
    {
        var juegos=$('#tablaPerfilJuegoOtro').DataTable( {
            data: oRespuesta,
            'sDom': "<'row'<'col-7'l><'col-5'f>>" +
                    "<'row'<'col-12't>>" +
                    "<'row'<'col-7'i><'col-5'p>>",
            "language": {
                "url": "../utilities/datatable_ESP.lang"
            },
            columns: [
                    { data: 'cover',
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        if(sData!=null)
                            $(nTd).html("<img class='imgCoverMin' src='../img/covers/"+oData.id+".png'>" );
                        else
                            $(nTd).html("<div class='autoAlturaTd'> </div>" );
                        }
                        
                },
                    { data: 'titulo',
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='juego.php?id="+oData.id+"'>"+oData.titulo+"</a>");
                    }
                },
                    { data: 'nota', 
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<div class='text-center'>"+ oData.nota+"</div>");
                        
                    }
                },
                    { data: 'fecha'}
                    ]
        } );
        
    }

    }, "json");

    


} );

function actualizarNota(event)
{
    
    var target=event.target;
    var sNota=$(target).val();
    var id_juego=target.dataset.nota;
    //user_id
    //console.log("value: "+sNota);
    //console.log("id_juego: "+id_juego);

    var oNota={id_juego: id_juego,
        id_usuario: user_id,
        nota: sNota};

    var sDatos= "datos="+JSON.stringify(oNota);

    //console.log(oNota);
    
    $.post("../servidor/gestionJuego/addNotaJuego.php",sDatos,function(bExito, sStatus, oAjax){
    //console.log(sNota);
    if(sNota=="revoke")
    {
        $("option[value=revoke]").text("No ha votado");
        $("option[value=revoke]").attr("value", "nada");
    }
    else if($(target.children[0]).text()=="No ha votado")
    {
        $(target.children[0]).text("Eliminar Nota");
        $(target.children[0]).attr("value", "revoke");
    }
    },"json");
    
    
}


