var ids=[];
var listaPersonas=[];
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

    $("#btnPlat").click(addPlataforma);
    $("#btnEditarPlat").click(guardarPlataformas);
    //console.log(plats_id);

    $("#btnEditInfo").click(guardarInformacion);
    $.get("../servidor/gestionJuego/getListaGeneros.php", getListadoGenero, "json");
    //console.log(generos_id);
    $.get("../servidor/gestionJuego/getListaDuracion.php", getListadoDuracion, "json");
    //console.log(duracion_id);

    $("#eliminar").click(function()
    {
        $( "#dialog-eliminar" ).dialog("open");
    });

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

});

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
            sHtml+='                        <a href="#"><b>'+oRespuesta[i].nombre+'</b></a>';
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
    /* coger los datos de todos el staff al momento de pulsar el boton, eliminar los pertinentes a este juego en la DB y escribir estos */
    var oCamposNombre=$(".txtStaffNombre");
    var oSelectsRol=$(".selectStaff");
    var oCamposComentario=$(".txtStaffComentario");

    var oNombreValues=[];
    var oRolesValues=[];
    var oComentsValues=[];

    for (var i=0;i<oCamposNombre.length;i++)
    {
        oNombreValues.push(oCamposNombre[i].value.trim());
        oRolesValues.push(oSelectsRol[i].value);
        oComentsValues.push(oCamposComentario[i].value.trim());
    }

    var oDatos={id: juego_id,
                nombres: oNombreValues,
                roles: oRolesValues,
                coment: oComentsValues};

    var sDatos= "datos="+JSON.stringify(oDatos);

    $("#registroError").hide();

    $.post("../servidor/gestionJuego/editarStaff.php", sDatos, function(oRespuesta, sStatus, oAjax)
    {
        if(oAjax.status==200 && oRespuesta==true)
        {
            $("#registrado").show();
            $("#formStaff").hide();
            $("#guidelines").hide();
            window.location.reload();
        }
        else
        {
            $("#registroError p").text("Error al procesar");
            $("#registroError").show();
        }
    }, "json");

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
            window.location.reload();
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
                window.location.reload();
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


    /*
    console.log(fileInput);
    console.log(file);
    console.log(formData);
    // Display the key/value pairs
    for (var pair of formData.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    */
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

}

function guardarInformacion()
{
    if(validarGuardarInformacion)
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
            window.location.reload();

            
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
                window.location.reload();
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
        /*
        var sDatos= "datos="+juego_id;
        $.get("../servidor/gestionJuego/getSelectedPlat.php", sDatos, function(oRespuesta, sStatus, oAjax)
        {
            if(oAjax.status==200)
            {
                //console.log(oRespuesta);
                for(var i=0;i<plats_id.length;i++)
                {
                    var oCheckbox=$("input[value="+plats_id[i].id_plataforma+"]");
                    $(oCheckbox).prop('checked', true);
                }
            }
        },"json"); 
        */
}   
    
}

function guardarCompanies()
{
    if(validarEdicionCompanies)
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
                window.location.reload();
                /*
                $.post("../servidor/gestionJuego/altaJuegosCompany.php",sDatos,function(bExito, sStatus, oAjax)
                {
    
                }
                */
                
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
    if(oAjax.status==200)
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
                source: ids,
                minLength: 0,
                select: function(event, ui){
                    $(camposCompanies).val(ui.item.value);
                    return false;
                }}).autocomplete("instance")._renderItem=function(ul, item){
                    return $("<li>").append("<div>"+item.value+"<br>"+item.desc+"</div>").appendTo(ul);
                };

            

        }
        
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
        source: ids,
        minLength: 0,
        select: function(event, ui){
            $(camposCompanies).val(ui.item.value);
             //$("#cliente-dni").val(ui.item.value);
             return false;
        }}).autocomplete("instance")._renderItem=function(ul, item){
            return $("<li>").append("<div>"+item.value+"<br>"+item.desc+"</div>").appendTo(ul);
        };

}

function addPlataforma()
{

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
            ids.push(arrayDatos);
        }
    }

}


function validarEdicionCompanies()
{
    var res=true;

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
