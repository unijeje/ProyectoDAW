var ids=[];
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


$("#btnADD").click(addJuego);
$("#btnCompany").click(addCompany);
$("#registrarOtro").click(mostrarForm);

$.get("../servidor/gestionCompany/autoCompleteCompany.php", respuestaAutoCompleteCompany, "json");

function addCompany()
{
    var sHtml='<div style="display:none;" class="form-group divCompany"><label for="company">Compañía: *</label>';
    sHtml+='<div class="form-inline">';
    sHtml+='<input type="text" class="form-control col-6 companies" placeholder="Nombre completo" name="company">';
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

function ocultarCompany(event)
{
    $( event.target ).parent().parent().hide('slow', function(){ this.remove(); });

}

function mostrarForm()
{
    $("#formAddJuego").show();
    $("#guidelines").show();
    $("h1").show();
    $("#registroError").hide();
    $("#registrarOtro").hide();
    $("#registrado").hide();
}

function addJuego()
{
    $("#guidelines").hide();
    $("#registroError").hide();
    $("#registrarOtro").hide();
    if(validarJuego())
    {
        var botonesEliminar=$(".btnEliminar");
        var sNombre=$("#nombre").val().trim();
        var sSinopsis=$("#sinopsis").val().trim();
        var sEnlace=$("#enlace").val().trim();
        var sFecha=$('#fecha').val().trim();
        var valoresCompany=[];
        $.each($('.companies'), function(i, val)
        {
            valoresCompany.push($(val).val().trim());
        });
        
        //var sCompany=$('.company').val().trim();

        var oJuego=  {nombre: sNombre,
                        arrayCompany: JSON.stringify(valoresCompany),
                        sinopsis: sSinopsis,
                        enlace: sEnlace,
                        fecha: sFecha};

        var sDatos= "datos="+JSON.stringify(oJuego);
        $.post("../servidor/gestionJuego/altaJuego.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito==true)
        {
            $("#formAddJuego").hide();
            $("h1").hide();
            $("#guidelines").hide();
            $("#registrado").show();
            $("#registrarOtro").show();
            altaRevision(oJuego, user_id, juegoRev);
            
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

function respuestaAutoCompleteCompany(oRespuesta, sStatus, oAjax)
{
    if(oAjax.status==200)
    {
        

        for(var i=0;i<oRespuesta.length;i++)
        {
            //arrayDNI.push(oRespuesta[i].dni);
            var arrayDatos={};
            arrayDatos["value"]=oRespuesta[i].nombre;
            arrayDatos["desc"]="Fecha: "+oRespuesta[i].fecha+" - País: "+oRespuesta[i].pais;
            ids.push(arrayDatos);
        }
        
        $("#formAddJuego #company").autocomplete({
            source: ids,
            minLength: 0,
            select: function(event, ui){
                 $("#formAddJuego #company").val(ui.item.value);
                 //$("#cliente-dni").val(ui.item.value);
                 return false;
            }}).autocomplete("instance")._renderItem=function(ul, item){
                return $("<li>").append("<div>"+item.value+"<br>"+item.desc+"</div>").appendTo(ul);
            };
    }
}

function validarJuego()
{
    var res=true;

    
    if($("#nombre").val().trim()=="")
    {
       invalidarCampo($("#nombre"), "No puede dejar este campo vacio", true);
       res=false;
    }
    else
        invalidarCampo($("#nombre"), "No puede dejar este campo vacio", false);


    var camposCompanies=$(".companies");
    for(var i=0;i<camposCompanies.length;i++)
    {
       
        var valCampo=false;
        for(var j=0;j<ids.length;j++)
        {
            if(camposCompanies[i].value.trim()==ids[j].value.trim())
            {
                valCampo=true;                
            }
        }
        
        if(!valCampo)
        {
            res=false;
            invalidarCampo($(camposCompanies[i]), "Esta compañía no existe", true);
        }
        else
            invalidarCampo($(camposCompanies[i]), "Esta compañía no existe, añadará primero", false);
    }

    return res;
}