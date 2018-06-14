var idsCompany=[];
var listaPersonas=[];
var oJuegoAntiguo;
var oCompaniesAntiguo;
var oStaffAntiguo;
var oPlatAntiguo;
$( document ).ready(function() {
    $( "#tabs" ).tabs();
    //cargarRevisionesStaff();

    //datepicker
    $( function() {
        var today = new Date();
        var maxYear=today.getFullYear()+3;
        $("#fecha").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm-dd',
            yearRange: "1950:"+maxYear
            });
    } );

    var sDatos= "datos="+juego_id;
    $.get("../servidor/gestionCompany/autoCompleteCompany.php", respuestaAutoCompleteCompany, "json");
    $.get("../servidor/gestionJuego/getCompanyOfGame.php", sDatos, rellenarCompanies, "json" );
    $.get("../servidor/gestionPlataforma/listadoPlat.php", rellenarPlataformas, "json" );

    $("#btnCompany").click(addCompany);
    $("#btnEditarCompany").click(guardarCompanies);

    $("#btnEditarPlat").click(guardarPlataformas);
    //console.log(plats_id);

    if(user_id != -1)
    {
        $("#btnEditInfo").click(guardarInformacion);
        $.get("../servidor/gestionJuego/getListaGeneros.php", getListadoGenero, "json");
        $.get("../servidor/gestionJuego/getListaDuracion.php", getListadoDuracion, "json");

        $("#eliminar").click(function()
        {
            $( "#dialog-eliminar" ).dialog("open");
        });
    }


    $("#nota").change(guardarNota);

    $('.custom-file-input').on('change',function(){ //cambia el nombre en el input al nombre del fichero seleccionado
        var fileName = $(this).val();
        var fileName = fileName.split('\\').pop().split('/').pop();

        $(this).next().text(fileName);
        //console.log($(this));
        //console.log(fileName);
    });
    
    $("#btnEditarCover").click(guardarCoverImg);
    $("#btnEliminarCover").click(eliminarCover);

    $("#btnAddStaff").click(addStaffInput);
    var sOptionsStaff;
    $.get("../servidor/gestionJuego/getListaRoles.php", getListadoRoles, "json");

    $.get("../servidor/gestionPersona/listadoPersonas.php", autoCompletePersonas, "json");

    $("#btnGuardarStaff").click(guardarStaff);

    for(var i=0;i<$(".btnEliminarStaff").length;i++)
    {
        $($(".btnEliminarStaff")[i]).click(eliminarStaffInput);
        
    }

    //console.log(filaStaff);


    $("#enviarComment").click(guardarComentario);

    //cargar comentarios con ajax al cargar la página
    var sEnviarJuego= "datos="+juego_id;
    $.get("../servidor/gestionJuego/getComentarios.php", sEnviarJuego, procesarComentarios, "json");

    //variables para validacion
    var mensajeCommentBox;


    $("#btnEditarScreenshot").click(guardarImagenes);

    $("#btnEliminarScreenshots").click(eliminarImagenes);

    var sDatosRevisiones = "datos="+JSON.stringify({id:juego_id, tipo: juegoRev})
    $.get("../servidor/gestionRevisiones/getRevisiones.php", sDatosRevisiones, procesarRevisiones, "json");

	$('[data-fancybox="gallery"]').fancybox({
        // Options will go here
    });

    $("#activar").click(reactivarJuego);
});

function procesarRevisiones(oRespuesta, sStatus, oAjax)
{
    if(oAjax.status==200)
    {
        
        for(var i=0;i<oRespuesta.length;i++)
        {
            var sID = oRespuesta[i].ID;
            var sNumero = oRespuesta[i].NUMERO;
            var sFecha = oRespuesta[i].FECHA.padEnd(10);
            var sDescripcion = oRespuesta[i].DESCRIPCION.padEnd(10);
            var sUsuario = oRespuesta[i].NOMBRE;
            var sIdUsuario = oRespuesta[i].PERFIL;
            var sHtml = "<tr>";
            sHtml += "<td><a href='revision.php?id="+sID+"'>J"+juego_id+"."+sNumero+"</a></td>";
            sHtml += "<td><a href='perfil.php?id="+sIdUsuario+"'>"+sUsuario+"</a></td>";
            sHtml += "<td>"+sDescripcion+"</td>";
            sHtml += "<td>"+sFecha+"</td>";
            sHtml += "</tr>";
            $("#revisionesListado").append(sHtml);
        }
    }
    else
    {
        $("#revisionesJuego").append("<p>Error. No se han podido obtener las revisiones desde el servidor.</p>");
    }
}

function mostrarPaginacion(evento)
{
    // var target=evento.target;
    // var numberPage = $(target).text();
    // console.log(numberPage);
}

function procesarComentarios(oRespuesta, sStatus, oAjax)
{
    if(oAjax.status==200)
    {

        //TODO: comentarios con paginacion
        // var maxComentariosPage = 5;

        // var numPages = Math.ceil(oRespuesta.length / maxComentariosPage);

        // $("#paginateComentarios").append('<li class="page-item"><a class="page-link" href="#">Previous</a></li>');

        // for(var i=1;i<=numPages;i++)
        // {

        //     if(i==1)
        //     {
        //         $("#comentariosMostrar").append("<div id='paginateComment"+i+"'> 123</div>")
        //     }
        //     else
        //     {
        //         $("#comentariosMostrar").append("<div id='paginateComment"+i+"'> 456</div>");
        //         $("#paginateComment"+i+"").hide();
        //         console.log( $("#paginateComment"+i+""));
        //     }


            
        //     $("#paginateComentarios").append('<li class="page-item"><a class="page-link paginateComment" href="#">'+i+'</a></li>');
        //     $(".paginateComment:last").click(mostrarPaginacion())
        // }

        // $("#paginateComentarios").append('<li class="page-item"><a class="page-link" href="#">Next</a></li>');

        for(var i=0;i<oRespuesta.length;i++)
        {
            var iRandom=Math.floor(Math.random() * (3 - 1 + 1)) + 1;
            sHtml='<div class="row mt-3">';
            sHtml+='    <div class="col-8 offset-2">';
            sHtml+='        <div class="card bg-white post panel-shadow">';
            sHtml+='            <div class="post-heading row">';
            sHtml+='                <div class="pull-left image col-2">';
            sHtml+='                    <img src="../img/avatars/noavatar'+iRandom+'.png" class="img-circle avatar" alt="user profile image">';
            sHtml+='                </div>';
            sHtml+='                <div class="pull-left meta col-7 mt-2">';
            sHtml+='                    <div class="title h5">';
            sHtml+='                        <a href="perfil.php?id='+oRespuesta[i].id_user+'"><b>'+oRespuesta[i].nombre+'</b></a>';
            sHtml+='                    </div>';
            sHtml+='                </div>';
            sHtml+='                <div class="fechaPub col-3 mt-2">';
            sHtml+='                    <h6 class="text-muted time">'+oRespuesta[i].fecha+'</h6>';
            sHtml+='                </div>';
            sHtml+='            </div> ';
            sHtml+='            <div class="post-description"> ';
            sHtml+='                <p>'+oRespuesta[i].texto+'</p>';
            sHtml+='            </div>';
            sHtml+='        </div>';
            sHtml+='    </div>';
            sHtml+='</div>  ';
            $("#comentariosMostrar").append(sHtml);
        }
    }
    else
    {
        $("#comentariosMostrar").append("<p>Error consiguiendo comentarios desde el servidor.</p>");
    }
}


function eliminarImagenes()
{
    var sEnviarJuego= "datos="+juego_id;
    $.post("../servidor/gestionJuego/eliminarScreenshots.php", sEnviarJuego, function(bExito, sStatus, oAjax)
    {
        if(bExito == true)
        {
            $("#registrado").show();
            $("#formEditarImg").hide();
            $("#guidelines").hide();
            editarRevision(0, 0, user_id, juegoRev, juego_id, "Eliminar screenshots del juego.");
            setTimeout(function(){window.location.reload();}, 1000);
        }
        else
        {
            $("#registroError").show();
        }
    }, "json");
}

function guardarImagenes()
{
    $("#registroError").hide();
    var fileInput = document.querySelectorAll('#imgJuegoScreenshot');

    if(fileInput[0].files.length > 10)
    {
        $("#registroError p").text("Numero de imágenes pérmitido superado.");
        $("#registroError").show();
        
        return;
    }

    var formData = new FormData();

    for(var i=0;i<fileInput[0].files.length;i++)
    {
        var file = fileInput[0].files[i];
        formData.append('image[]', file);
    }

    formData.append('id_juego', juego_id);

    //ajax
    $.ajax({
        url: "../servidor/gestionJuego/editarScreenshots.php",
        type : "POST",
        data : formData,
        dataType: "json",
        
        success: function(bExito, sStatus, oAjax){
            
            if(bExito[0]==true)
            {
                $("#registrado").show();
                $("#formEditarImg").hide();
                $("#guidelines").hide();
                editarRevision(0, 0, user_id, juegoRev, juego_id, "Añadir screenshots al juego.");
                setTimeout(function(){window.location.reload();}, 1000);
            }
            else
            {
                $("#registroError p").text(bExito[1]);
                $("#registroError").show();
            }
            
        },
        
        processData : false,
        contentType : false
    });

}

function guardarComentario()
{
    $("#registroError").hide();
    if(validarComentario())
    {
    var sComment=$("#txtComentario").val().trim();

    var oComment={  usuario: user_id,
                    comment: sComment,
                    juego: juego_id};
    //console.log(oComment);
    var sDatos= "datos="+JSON.stringify(oComment);

    $.post("../servidor/gestionJuego/altaComentarioJuego.php", sDatos, function(oRespuesta, sStatus, oAjax)
    {
        if(oAjax.status==200 && oRespuesta==true)
        {
            $("#txtComentario").val("");
            var iRandom=Math.floor(Math.random() * (3 - 1 + 1)) + 1;
            sHtml='<div class="row mt-3">';
            sHtml+='    <div class="col-8 offset-2">';
            sHtml+='        <div class="card bg-white post panel-shadow">';
            sHtml+='            <div class="post-heading row">';
            sHtml+='                <div class="pull-left image col-2">';
            sHtml+='                    <img src="../img/avatars/noavatar'+iRandom+'.png" class="img-circle avatar" alt="user profile image">';
            sHtml+='                </div>';
            sHtml+='                <div class="pull-left meta col-7 mt-2">';
            sHtml+='                    <div class="title h5">';
            sHtml+='                        <a href="#"><b>'+user_name+'</b></a>';
            sHtml+='                    </div>';
            sHtml+='                </div>';
            sHtml+='                <div class="fechaPub col-3 mt-2">';
            sHtml+='                    <h6 class="text-muted time">Ahora</h6>';
            sHtml+='                </div>';
            sHtml+='            </div> ';
            sHtml+='            <div class="post-description"> ';
            sHtml+='                <p>'+sComment+'</p>';
            sHtml+='            </div>';
            sHtml+='        </div>';
            sHtml+='    </div>';
            sHtml+='</div>  ';

            $("#comentariosMostrar").append(sHtml);

        }
        else
        {
            $("#registroError p").text("Error al procesar");
            $("#registroError").show();
        }
    }, "json");
    }
}

function validarComentario()
{
    var sComment=$("#txtComentario").val().trim();
    var res=true;
    mensajeCommentBox="";
    if(sComment.length<1 )
    {
        res=false;
        mensajeCommentBox+="Debe escribir algo antes de enviar";
        $("#txtComentario").addClass("is-invalid");
        $("#txtComentario").parent().append('<div class="invalid-feedback">'+mensajeCommentBox+'</div>');
    }
    else if(sComment.length>=690 )
    {
        res=false;
        mensajeCommentBox+="Límite máximo de carácteres alcanzado";
        $("#txtComentario").addClass("is-invalid");
        $("#txtComentario").parent().append('<div class="invalid-feedback">'+mensajeCommentBox+'</div>');
    }
    else
    {
        $("#txtComentario").removeClass("is-invalid");
        $("#txtComentario").parent().find('div').remove();
    }
    return res;
}

function guardarStaff()
{

    if(validarGuardarStaff())
    {
        /* coger los datos de todos el staff al momento de pulsar el boton, eliminar los pertinentes a este juego en la DB y escribir estos */
        var oCamposNombre=$(".txtStaffNombre");
        var oSelectsRol=$(".selectStaff");
        var oCamposComentario=$(".txtStaffComentario");

        var oNombreValues=[];
        var oRolesValues=[];
        var oComentsValues=[];
        var oRolesNombres=[];

        for (var i=0;i<oCamposNombre.length;i++)
        {
            oNombreValues.push(oCamposNombre[i].value.trim());
            oRolesValues.push(oSelectsRol[i].value);
            oComentsValues.push(oCamposComentario[i].value.trim());
            oRolesNombres.push(oSelectsRol[i][oSelectsRol[i].selectedIndex].text);
        }

        var oDatos={id: juego_id,
                    nombres: oNombreValues,
                    roles: oRolesValues,
                    coment: oComentsValues,
                    roles_nomb : oRolesNombres};

        var sDatos= "datos="+JSON.stringify(oDatos);

        $("#registroError").hide();

        $.post("../servidor/gestionJuego/editarStaff.php", sDatos, function(oRespuesta, sStatus, oAjax)
        {
            if(oAjax.status==200 && oRespuesta==true)
            {
                $("#registrado").show();
                $("#formStaff").hide();
                $("#guidelines").hide();

                var oNombresAntiguos = [];
                var oRolesAntiguos = [];
                var oComentsAntiguos = [];

                for(var i=0;i<filaStaff.length;i++)
                {
                    oNombresAntiguos.push(filaStaff[i]["nombre"]);
                    oRolesAntiguos.push(filaStaff[i]["rol"]);
                    oComentsAntiguos.push(filaStaff[i]["comentario"]);
                }

                var oStaffAntiguo = {id: juego_id,
                                    nombres: oNombresAntiguos,
                                    roles: oRolesAntiguos,
                                    coment: oComentsAntiguos};

                editarRevision(oDatos, oStaffAntiguo, user_id, juegoRev, juego_id, "Editar Staff del juego.");
                setTimeout(function(){window.location.reload();}, 1000);
            }
            else
            {
                $("#registroError p").text("Error al procesar");
                $("#registroError").show();
            }
        }, "json");
    }

}

function addStaffInput()
{
    var sHtml='<div style="display:none;" class="form-group row divStaff">';
    sHtml+=' <input type="text" class="form-control col-3 txtStaffNombre ml-2" placeholder="Jason Rubin" name="" />';
    sHtml+='<select class="selectStaff form-control col-3 ml-2">';
    sHtml+=sOptionsStaff;
    sHtml+='</select>';
    sHtml+=' <input type="text" class="form-control col-3 txtStaffComentario ml-2" placeholder="comentario" name="" />';
    sHtml+='<input type="button" class="btn btn-danger col-1 ml-1 btnEliminarStaff" value="X" />';
    sHtml+="</div>";

    //console.log(sHtml);

    $("#btnAddStaff").before(sHtml);
    $(".divStaff:last").show("slow");

    $(".btnEliminarStaff:last").click(eliminarStaffInput);



    $(".txtStaffNombre:last").autocomplete({
        source: listaPersonas,
        minLength: 0
    });

}

function eliminarStaffInput(evento)
{
    var target=evento.target;
    //console.log(target);
    $(target).parent().hide('slow', function(){ this.remove(); });
}

function getListadoRoles(oRoles, sStatus, oAjax)
{
    if(oAjax.status==200)
    {
        var res="";
        for(var i=0;i<oRoles.length;i++)
        {
            res+="<option value='"+oRoles[i].id+"'>"+oRoles[i].rol+"</option>";
        }

        sOptionsStaff=res;
 
        for(var i=0;i<$(".selectStaff").length;i++)
        {
            
            $($(".selectStaff")[i]).append(sOptionsStaff);
            //console.log(filaStaff[i].id_rol);
            $($(".selectStaff")[i]).val(filaStaff[i].id_rol).change();
        }
     

    }
    
}

function autoCompletePersonas(oRespuesta, sStatus, oAjax)
{
    if(oAjax.status==200)
    {
        for(var i=0;i<oRespuesta.length;i++)
        {
            listaPersonas.push(oRespuesta[i].nombre);
        }
        for(var i=0;i<$(".txtStaffNombre").length;i++)
        {
            $($(".txtStaffNombre")[i]).autocomplete({
                source: listaPersonas,
                minLength: 0
            });
        }

    }
}

function eliminarCover()
{
    var sDatos= "datos="+juego_id;
    $.post("../servidor/gestionJuego/eliminarCover.php",sDatos,function(bExito, sStatus, oAjax){
        //console.log(sNota);
        if(bExito==true)
        {
            $("#registrado").show();
            $("#formEditarImg").hide();
            $("#guidelines").hide();
            editarRevision(0, 0, user_id, juegoRev, juego_id, "Eliminar del juego.");
            setTimeout(function(){window.location.reload();}, 1000);
        }
        else
        {
            $("#registroError").show();
        }
    },"json");
}

function guardarCoverImg()
{
    $("#registroError").hide();
    var fileInput = document.getElementById('imgJuegoCover');
    var file = fileInput.files[0];
    var formData = new FormData();
    formData.append('image', file);
    formData.append('id_juego', juego_id);

    //ajax
    $.ajax({
        url: "../servidor/gestionJuego/editarCover.php",
        type : "POST",
        data : formData,
        dataType: "json",
        success: function(bExito, sStatus, oAjax){
            if(bExito==true)
            {
                $("#registrado").show();
                $("#formEditarImg").hide();
                $("#guidelines").hide();
                editarRevision(0, 0, user_id, juegoRev, juego_id, "Agregar cover del juego.");
                setTimeout(function(){window.location.reload();}, 1000);
            }
            else
            {
                $("#registroError p").text(bExito);
                $("#registroError").show();
            }
        },
        processData : false,
        contentType : false
    });
}

function guardarNota()
{
    var sNota=($("#nota").val());

    var oNota={id_juego: juego_id,
                id_usuario: user_id,
                nota: sNota};
    var sDatos= "datos="+JSON.stringify(oNota);
    $.post("../servidor/gestionJuego/addNotaJuego.php",sDatos,function(bExito, sStatus, oAjax){
        //console.log(sNota);
        if(sNota=="revoke")
        {
            $("option[value=revoke]").text("No ha votado");
            $("option[value=revoke]").attr("value", "nada");
        }
        else if($("option[value=nada]").text()=="No ha votado")
        {
            $("option[value=nada]").text("Eliminar Nota");
            $("option[value=nada]").attr("value", "revoke");
        }
    },"json");
}

function darJuegoBaja()
{
    $("#registroError").hide();
    var sDatos= "datos="+juego_id;
    $.post("../servidor/gestionJuego/eliminarJuego.php",sDatos,function(bExito, sStatus, oAjax){
    if(bExito==true)
    {
        $("#borrarJuego").hide();
        $("#guidelines").hide();
        $("#registrado").show();
        // editarRevision(0, 0, user_id, juegoRev, juego_id, "Dar juego de baja.");
        // setTimeout(function(){window.location.reload();}, 1000);
        window.location.reload();
    }
    else
    {
        $("#registroError").show();
    }
        
    },"json");
}

function reactivarJuego()
{
    $("#registroError").hide();
    var sDatos= "datos="+juego_id;
    $.post("../servidor/gestionJuego/activarJuego.php",sDatos,function(bExito, sStatus, oAjax){
    if(bExito==true)
    {
        $("#activarJuego").hide();
        $("#guidelines").hide();
        $("#registrado").show();
        //editarRevision(0, 0, user_id, juegoRev, juego_id, "Dar juego de Alta.");
        // setTimeout(function(){window.location.reload();}, 1000);
        window.location.reload();
    }
    else
    {
        $("#registroError").show();
    }
        
    },"json");
}

function getListadoDuracion(oDuracion, sStatus, oAjax)
{
    var sHtml="";
    for(var i=0;i<oDuracion.length;i++)
    {
        sHtml+="<option value='"+oDuracion[i].id+"'>"+oDuracion[i].duracion+"</option>";
    }

    $("#duracion").append(sHtml);
    
    //select el pertinente
    var oOption=$("#duracion option[value="+duracion_id+"]");
    $(oOption).prop('selected', true);
}
function getListadoGenero(oGeneros, sStatus, oAjax)
{
    var sHtml="";
    for(var i=0;i<oGeneros.length;i++)
    {
        sHtml+="<option value='"+oGeneros[i].id+"'>"+oGeneros[i].genero+"</option>";
    }

    $("#generos").append(sHtml);

    //checkear los que pertenezcan a este id de juego
    for(var i=0;i<generos_id.length;i++)
    {
        var oOption=$("#generos option[value="+generos_id[i]+"]");
        $(oOption).prop('selected', true);
    }
    setTimeout(function()
    {
        var sNombre=$("#formEditInfo #nombre").val().trim();
        var sSinopsis=$("#formEditInfo #sinopsis").val().trim();
        var sEnlace=$("#formEditInfo #enlace").val().trim();
        var sFecha=$('#formEditInfo #fecha').val().trim();
        var sDuracion=$("#formEditInfo #duracion").val();
        var selectedGeneros = $('#formEditInfo #generos').val();
        oJuegoAntiguo =  {  id: juego_id,
                                nombre: sNombre,
                                sinopsis: sSinopsis,
                                enlace: sEnlace,
                                fecha: sFecha,
                                duracion: sDuracion,
                                generos: selectedGeneros};
    }, 2000);


}

function guardarInformacion()
{
    if(validarGuardarInformacion())
    {
        $("#registroError").hide(); 

        var sNombre=$("#formEditInfo #nombre").val().trim();
        var sSinopsis=$("#formEditInfo #sinopsis").val().trim();
        var sEnlace=$("#formEditInfo #enlace").val().trim();
        var sFecha=$('#formEditInfo #fecha').val().trim();
        var sDuracion=$("#formEditInfo #duracion").val();
        var selectedGeneros = $('#formEditInfo #generos').val();
        

        var oJuego=  {  id: juego_id,
                        nombre: sNombre,
                        sinopsis: sSinopsis,
                        enlace: sEnlace,
                        fecha: sFecha,
                        duracion: sDuracion,
                        generos: selectedGeneros};

        var sDatos= "datos="+JSON.stringify(oJuego);

        $.post("../servidor/gestionJuego/editarJuego.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito==true)
        {
            $("#registrado").show();
            $("#formEditInfo").hide();
            $("#guidelines").hide();
            editarRevision(oJuego, oJuegoAntiguo, user_id, juegoRev, juego_id, "Editar información principal del juego.");
            setTimeout(function(){window.location.reload();}, 1000);
        }
        else
        {
            $("#registroError").show();
            $("#guidelines").show();
            $("#formEditInfo").show();
        }
        },"json");

    }
}

function validarGuardarInformacion()
{
    var res=true;

    if($("#formEditInfo #nombre").val().trim()=="")
    {
       invalidarCampo($("#formEditInfo #nombre"), "No puede dejar este campo vacio", true);
       res=false;
    }
    else
    {
        invalidarCampo($("#formEditInfo #nombre"), false);
    }


    var reEnlace = new RegExp("^(http|https)://", "i");

    if($("#formEditInfo #enlace").val().trim()!="" && !reEnlace.test($("#formEditInfo #enlace").val().trim()))
    {
        
        invalidarCampo($("#formEditInfo #enlace"), "Este campo no es un enlace", true);
        res=false;
    }
    else
    {
        invalidarCampo($("#formEditInfo #enlace"), false);
    }

    return res;
}

function guardarPlataformas()
{
    $("#registroError").hide();  

    var oPlataformasSel=$("input[name=checkboxPlat]:checked");
    var platValues=[];
    for(var i=0;i<oPlataformasSel.length;i++)
    {
        platValues.push(oPlataformasSel[i].value);
    }

    var oPlataformas={plat: platValues, id: juego_id};
    var sDatos= "datos="+JSON.stringify(oPlataformas);
    $.post("../servidor/gestionJuego/editarPlat.php", sDatos, function(bExito, sStatus, oAjax)
        {
            if(bExito==true)
            {
                $("#registrado").show();
                $("#formEditPlat").hide();
                $("#guidelines").hide();
                editarRevision(oPlataformas, oPlatAntiguo, user_id, juegoRev, juego_id, "Editar plataformas del juego.");
                setTimeout(function(){window.location.reload();}, 1000);
            }
            else
            {
                $("#registroError").show();
                $("#guidelines").show();
                $("#formEditPlat").show();
            }


        },"json");
}

function rellenarPlataformas(oPlat, sStatus, oAjax)
{

    if(oAjax.status==200)
    {
        for(var i=0;i<oPlat.length;i++)
        {
            var sHtml='<div class="form-check form-check-inline"><label class="form-check-label">';
            sHtml+='<input class="form-check-input" type="checkbox" id="checkboxPlat" name="checkboxPlat" value="'+oPlat[i].id+'"> '+oPlat[i].nombre+' </label></div>';
            $("#checkboxPlataformas").prepend(sHtml);
        }
        //get para checkear
        for(var i=0;i<plats_id.length;i++)
        {
            var oCheckbox=$("input[value="+plats_id[i]+"]");
            $(oCheckbox).prop('checked', true);
        }

        var oPlataformasSel=$("input[name=checkboxPlat]:checked");

        var oPlataformasCargadas = [];

        for(var i=0;i<oPlataformasSel.length;i++)
        {
            oPlataformasCargadas.push(oPlataformasSel[i].value);
        }

        oPlatAntiguo = {plat: oPlataformasCargadas, id: juego_id};

    }   
}

function guardarCompanies()
{
    if(validarEdicionCompanies())
    {
        $("#registroError").hide();   
        var valoresCompany=[];
        $.each($('.companies'), function(i, val)
        {
            valoresCompany.push($(val).val().trim());
        });

        var oCompanies={arrayCompany: valoresCompany,
                        id: juego_id};
        var sDatos= "datos="+JSON.stringify(oCompanies);

        $.post("../servidor/gestionJuego/editarCompanyJuegos.php",sDatos,function(bExito, sStatus, oAjax){
            if(bExito==true)
            {
                $("#registrado").show();
                $("#formEditCompany").hide();
                $("#guidelines").hide();
                editarRevision(oCompanies, oCompaniesAntiguo, user_id, juegoRev, juego_id, "Editar compañías del juego.");
                setTimeout(function(){window.location.reload();}, 1000);             
            }
            else
            {
                $("#registroError").show();
                $("#guidelines").show();
                $("#formEditCompany").show();
            }
        },"json");
    }
    
}

function rellenarCompanies(oRespuesta, sStatus, oAjax)
{
    if(oAjax.status==200 && user_id!=-1)
    {
        
        //console.log(oRespuesta);
        for(var i=0;i<oRespuesta.length;i++)
        {
            var sHtml='<div class="form-group divCompany"><label for="company">Compañía: *</label>';
            sHtml+='<div class="form-inline">';
            sHtml+='<input type="text" class="form-control col-7 companies" placeholder="Nombre completo" name="company" value="'+oRespuesta[i].nombre+'"/> ';
            sHtml+='<input type="button" class="btn btn-danger col-1 ml-1 btnEliminar" value="X" />';
            sHtml+='</div>';
            sHtml+='</div>';

            $("#btnCompany").parent().before(sHtml);


            var botonesEliminar=$(".btnEliminar:last");
            $(botonesEliminar).click(ocultarCompany);

            var camposCompanies=$(".companies:last");
            //console.log(camposCompanies);
            $(camposCompanies).autocomplete({
                source: idsCompany,
                minLength: 0,
                select: function(event, ui){
                    $(camposCompanies).val(ui.item.value);
                    return false;
                }}).autocomplete("instance")._renderItem=function(ul, item){
                    return $("<li>").append("<div>"+item.value+"<br>"+item.desc+"</div>").appendTo(ul);
                };
        }

        var companiesCargadas = [];

        $.each($('.companies'), function(i, val)
        {
            companiesCargadas.push($(val).val().trim());
        });

        oCompaniesAntiguo = {arrayCompany: companiesCargadas, id: juego_id};
        
    }
    
}

function addCompany()
{
    var sHtml='<div style="display:none;" class="form-group divCompany"><label for="company">Compañía: *</label>';
    sHtml+='<div class="form-inline">';
    sHtml+='<input type="text" class="form-control col-7 companies" placeholder="Nombre completo" name="company">';
    sHtml+='<input type="button" class="btn btn-danger col-1 ml-1 btnEliminar" value="X" />';
    sHtml+='</div>';
    sHtml+='</div>';
    $("#btnCompany").parent().before(sHtml);
    $(".divCompany:last").show("slow");

    var botonesEliminar=$(".btnEliminar:last");
    var camposCompanies=$(".companies:last");
    $(botonesEliminar).click(ocultarCompany);
    $(camposCompanies).autocomplete({
        source: idsCompany,
        minLength: 0,
        select: function(event, ui){
            $(camposCompanies).val(ui.item.value);
             //$("#cliente-dni").val(ui.item.value);
             return false;
        }}).autocomplete("instance")._renderItem=function(ul, item){
            return $("<li>").append("<div>"+item.value+"<br>"+item.desc+"</div>").appendTo(ul);
        };

}



function ocultarCompany(event)
{
    var target=event.target;
    //console.log( $(target).parent().parent());
    $(target).parent().parent().hide('slow', function(){ this.remove(); });

}

function respuestaAutoCompleteCompany(oRespuesta, sStatus, oAjax)
{
    if(oAjax.status==200)
    {
        for(var i=0;i<oRespuesta.length;i++)
        {
            var arrayDatos={};
            arrayDatos["value"]=oRespuesta[i].nombre;
            arrayDatos["desc"]="Fecha: "+oRespuesta[i].fecha+" - País: "+oRespuesta[i].pais;
            idsCompany.push(arrayDatos);
        }
    }

}


function validarEdicionCompanies()
{
    var res=true;

    var camposCompanies=$(".companies");
    for(var i=0;i<camposCompanies.length;i++)
    {
       
        var valCampo=false;
        for(var j=0;j<idsCompany.length;j++)
        {
            if(camposCompanies[i].value.trim()==idsCompany[j].value.trim())
            {
                valCampo=true;                
            }
        }
        
        if(!valCampo)
        {
            res=false;
            invalidarCampo($(camposCompanies[i]), "Esta compañía no existe en la base de datos", true);
        }
        else
            invalidarCampo($(camposCompanies[i]), false);
    }

    return res;
}

function validarGuardarStaff()
{
    var res=true;

    var camposStaff=$(".txtStaffNombre");
    console.log(camposStaff);
    console.log(listaPersonas);
    for(var i=0;i<camposStaff.length;i++)
    {
        var valCampo=false;
        
        if(listaPersonas.includes( $(camposStaff[i]).val() ))
            valCampo=true;                
 
        if(!valCampo)
        {
            res=false;
            invalidarCampo($(camposStaff[i]), "Esta persona no existe en la base de datos", true);
        }
        else
            invalidarCampo($(camposStaff[i]), false);
    }

    return res;
}

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
            darJuegoBaja();
            $( this ).dialog( "close" );
        }

    }
});
