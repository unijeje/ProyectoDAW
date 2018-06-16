$("#guardar").click(editarPerfil);
$("#eliminar").click(eliminarPerfil);
$("#btnGuardarAdmin").click(editarAdminPerfil);
$("#registradoA").hide();
$("#registroErrorA").hide();

var sEnviarPerfil= "datos="+user_id;
$.get("../servidor/gestionCuenta/buscarComentarios.php", sEnviarPerfil, procesarComentarios, "json");

var sNombreUsuario=$("#usuario").val();


function editarAdminPerfil()
{
    $("#registroErrorA").hide();
    $("#registradoA").hide();

    var tipoC = $("#tipoCuenta").val();
    var activoC = $("#activoCuenta").val();

    var oOpciones = {tipo: tipoC, activo: activoC, id: user_id};

    var sDatos= "datos="+JSON.stringify(oOpciones);

    $.post("../servidor/gestionCuenta/editarAdmin.php",sDatos,function(respuesta, sStatus, oAjax){
        if(respuesta[0]==true)
        {
            $("#registradoA").show();
           // window.location.reload();
        }
        else
        {
            $("#registroErrorA p:first").append(respuesta[1]);
            $("#registroErrorA").show();
        }
    },"json");
}




function editarPerfil()
{
    $("#registroError").hide();
    $("#registrado").hide();

    if($("#passAntigua").val().trim()=="") //sin contraseña
    {
        
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
            var sPassAntigua = $("#passAntigua").val().trim();
            var oCuenta={nombre: sNombreUsuario,
                        id: user_id,
                        pass: sPass,
                        correo: sEmail,
                        passAnt : sPassAntigua};
            var sDatos= "datos="+JSON.stringify(oCuenta);
            $.post("../servidor/gestionCuenta/editarPerfilConPass.php",sDatos,function(respuesta, sStatus, oAjax){
                if(respuesta[0]==true)
                {
                    $("#formEditarPerfil").hide();
                    $("#registrado").show();
                    window.location.reload();
                }
                else
                {
                    $("#registroError p:first").append(respuesta[1]);
                    $("#registroError").show();
                }
            },"json");
        }
    }
}



function validarEdicionUsuario()
{
    var res=true;

    res=validacionCampo($("#usuario"), "Tiene que tener entre 3 y 20 carácteres", oExpRegNombre);

    if(!validacionCampo($("#email"), "El correo no es válido", oExpRegEmail))
        res=false;

    if($("#passAntigua").val().trim()!="") 
    {
        if(!validacionCampo($("#passNueva"), "Tiene que tener un número, caracter y longitud 4", oExpRegPass))
            res=false;

        if($("#passNuevaRepetida").val().trim()!=$("#passNueva").val().trim() || $("#passNuevaRepetida").val().trim()=="")
        {
            invalidarCampo($("#passNuevaRepetida"), "Las contraseñas no coinciden", true);
            res=false;
        }
        else
            invalidarCampo($("#passNuevaRepetida"), "", false);

    }

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
            'sDom': "<'row'<'col-lg-7 col-md-6 col-12'l><'col-lg-5 col-md-6 col-12'f>>" +
                    "<'row'<'col-12't>>" +
                    "<'row'<'col-lg-7 d-none d-lg-block'i><'col-lg-5 col-md-10 offset-md-2 offset-2 offset-lg-0'p>>",
            "language": {
                "url": "../utilities/datatable_ESP.lang"
            },
            columns: [
                    { data: 'cover',
                      "width" : "17%",
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        if(sData!=null)
                            $(nTd).html("<img class='imgCoverMin' src='../img/covers/"+oData.id+".png'>" );
                        else
                            $(nTd).html("<div class='autoAlturaTd'> </div>" );
                        }
                        
                },
                    { data: 'titulo',
                    "width" : "50%",
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a class='w-75' href='juego.php?id="+oData.id+"'>"+oData.titulo+"</a>");
                    }
                },
                    { data: 'nota', 
                    "width" : "17%",
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
                    { data: 'fecha',
                    "width" : "17%"}
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
            'sDom': "<'row'<'col-lg-7 col-md-6 col-12'l><'col-lg-5 col-md-6 col-12'f>>" +
                    "<'row'<'col-12't>>" +
                    "<'row'<'col-lg-7 d-none d-lg-block'i><'col-lg-5 col-md-10 offset-md-2 offset-2 offset-lg-0'p>>",
            "language": {
                "url": "../utilities/datatable_ESP.lang"
            },
            columns: [
                    { data: 'cover',
                    "width" : "17%",
                        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        if(sData!=null)
                            $(nTd).html("<img class='imgCoverMin' src='../img/covers/"+oData.id+".png'>" );
                        else
                            $(nTd).html("<div class='autoAlturaTd'> </div>" );
                        }
                        
                },
                    { data: 'titulo',
                    "width" : "50%",
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='juego.php?id="+oData.id+"'>"+oData.titulo+"</a>");
                    }
                },
                    { data: 'nota',
                    "width" : "17%", 
                    fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<div class='text-center'>"+ oData.nota+"</div>");
                        
                    }
                },
                    { data: 'fecha', "width" : "17%"}
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


function procesarComentarios(oRespuesta, sStatus, oAjax)
{
    if(oAjax.status==200)
    {
        var oTabla = $("#tablaComentarios");
        for(var i=0;i<oRespuesta.length;i++)
        {
            var comentario = oRespuesta[i].texto;
            if(comentario.length > 50)
            {
                comentario = comentario.substr(0, 50);
                comentario+="..."; 
            }

            $("#tablaComentarios").append("<tr><td>"+oRespuesta[i].fecha+"</td><td><a href='juego.php?id="+oRespuesta[i].juego+"'>"+oRespuesta[i].titulo+"</a></td><td>"+comentario+"</td></tr>");
        }

    }
}


