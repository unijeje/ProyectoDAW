var ids=[];
$( document ).ready(function() {
    $( "#tabs" ).tabs();
    //cargarRevisionesStaff();
    
    var sDatos= "datos="+juego_id;
    $.get("../servidor/gestionCompany/autoCompleteCompany.php", respuestaAutoCompleteCompany, "json");
    $.get("../servidor/gestionJuego/getCompanyOfGame.php", sDatos, rellenarCompanies, "json" );
    $.get("../servidor/gestionPlataforma/listadoPlat.php", rellenarPlataformas, "json" );

    $("#btnCompany").click(addCompany);
    $("#btnEditarCompany").click(guardarCompanies);

    $("#btnPlat").click(addPlataforma);
    $("#btnEditarPlat").click(guardarPlataformas);
    //console.log(plats_id);
});

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
            $("#formEditPlat").prepend(sHtml);
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

/*

$("#btnEditar").click(editarPersona);
$("#editarStaffBtn").click(function()
{
    $("#formEditarStaff").show();
});
$("#eliminar").click(function()
{
    $( "#dialog-eliminar" ).dialog("open");
});
function editarPersona()
{
    if(validarEdicionStaff())
    {
    $("#guidelines").hide();
    $("#registroError").hide();
    var sNombre=$("#nombre").val().trim();
    var sNacionalidad=$("#nacionalidad").val().trim();
    var sDesc=$("#desc").val().trim();
    var sGenero=$('input[name=radioGenero]:checked').val();
    var sEnlace=$("#enlace").val().trim();

    var oPersona={  id: staff_id,
                    nombre: sNombre,
                    nacionalidad: sNacionalidad,
                    desc: sDesc,
                    genero: sGenero,
                    enlace: sEnlace};

    var sDatos= "datos="+JSON.stringify(oPersona);
    //console.log(oPersona);
    $.post("../servidor/gestionPersona/editarPersona.php",sDatos,function(bExito, sStatus, oAjax){

        
        if(bExito==true)
        {
            $("#formEditarStaff").hide();
            $("#guidelines").hide();
            $("#registrado").show();
            window.location.reload();
            
        }
        else
        {
            $("#registroError").show();
        }
        
    },"json");
    
    }
    else
    {
        $("#guidelines").show();
    }
}
function eliminarPersona()
{
    
    var sDatos= "datos="+staff_id;
    $.post("../servidor/gestionPersona/eliminarPersona.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito==true)
        {
            $("#formEditarStaff").hide();
            $("#borrarStaff").hide();
            $("#guidelines").hide();
            $("#registrado").show();
            
        }
        else
        {
            $("#registroError").show();
        }
        
    },"json");

}
function cargarRevisionesStaff()
{

}
function validarEdicionStaff()
{
    var res=true;


    return res;
}
*/

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
            eliminarPersona();
            $( this ).dialog( "close" );
        }

    }
});
