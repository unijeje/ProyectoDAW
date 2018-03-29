$( document ).ready(function() {
    $( "#tabs" ).tabs();
    cargarRevisionesStaff();
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
                window.location.reload();
                
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
function cargarRevisionesStaff()
{

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
