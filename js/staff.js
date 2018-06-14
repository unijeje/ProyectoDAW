var oStaffAntiguo; 
$( document ).ready(function() {
    $( "#tabs" ).tabs();
    var sDatosRevisiones = "datos="+JSON.stringify({id:staff_id, tipo: staffRev})
    $.get("../servidor/gestionRevisiones/getRevisiones.php", sDatosRevisiones, cargarRevisionesStaff, "json");
    var sNombre=$("#nombre").val().trim();
    var sNacionalidad=$("#nacionalidad").val().trim();
    var sDesc=$("#desc").val().trim();
    var sGenero=$('input[name=radioGenero]:checked').val();
    var sEnlace=$("#enlace").val().trim();

    oStaffAntiguo={  id: staff_id,
                    nombre: sNombre,
                    nacionalidad: sNacionalidad,
                    desc: sDesc,
                    genero: sGenero,
                        enlace: sEnlace};


    $("#activar").click(activarStaff);
});



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
                editarRevision(oPersona, oStaffAntiguo, user_id, staffRev, staff_id, "Editar información de staff.");
                setTimeout(function(){window.location.reload();}, 1000);
                
            }
            else
            {
                $("#registroError").show();
                $("#guidelines").show();
            }
            
        },"json");

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

function activarStaff()
{
    
    var sDatos= "datos="+staff_id;
    $.post("../servidor/gestionPersona/activarPersona.php",sDatos,function(bExito, sStatus, oAjax){
        if(bExito==true)
        {
            $("#formEditarStaff").hide();
            $("#activarStaff").hide();
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


function cargarRevisionesStaff(oRespuesta, sStatus, oAjax)
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
            sHtml += "<td><a href='revision.php?id="+sID+"'>J"+staff_id+"."+sNumero+"</a></td>";
            sHtml += "<td><a href='perfil.php?id="+sIdUsuario+"'>"+sUsuario+"</a></td>";
            sHtml += "<td>"+sDescripcion+"</td>";
            sHtml += "<td>"+sFecha+"</td>";
            sHtml += "</tr>";
            $("#revisionesListado").append(sHtml);
        }
    }
    else
    {
        $("#revisionesStaff").append("<p>Error. No se han podido obtener las revisiones desde el servidor.</p>");
    }
}
function validarEdicionStaff()
{
    var res=true;
    
    if($("#nombre").val().trim()=="")
    {
       invalidarCampo($("#nombre"), "No puede dejar este campo vacio", true);
       res=false;
    }
    else
        invalidarCampo($("#nombre"), "No puede dejar este campo vacio", false);

    var reEnlace = new RegExp("^(http|https)://", "i");

    if($("#formEditarStaff #enlace").val().trim()!="" && !reEnlace.test($("#formEditarStaff #enlace").val().trim()))
    {
        
        invalidarCampo($("#formEditarStaff #enlace"), "Este campo no es un enlace", true);
        res=false;
    }
    else
    {
        invalidarCampo($("#formEditarStaff #enlace"),  false);
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
            eliminarPersona();
            $( this ).dialog( "close" );
        }

    }
});
