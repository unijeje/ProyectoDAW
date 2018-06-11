$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $("#btnBusqueda").click(iniciarBusqueda);

    $("#txtBusqueda").keypress(function(event)
    {
        var code = event.keyCode || event.which;
        if(code == 13) 
        {
            iniciarBusqueda();
        }
    });
});


function iniciarBusqueda()
{
    var radio = $('input[name=busqRadio]:checked').val();

    var sText = $("#txtBusqueda").val();

    switch(radio)
    {
        case "juego":
            window.location.replace("pages/busqueda.php?j="+sText);
        break;

        case "comp":
            window.location.replace("pages/busqueda.php?c="+sText);
        break;

        case "staff":
            window.location.replace("pages/busqueda.php?s="+sText);
        break;

        case "plat":
            window.location.replace("pages/busqueda.php?p="+sText);
        break;
        
        case "todos": 
            window.location.replace("pages/busqueda.php?a="+sText);
        break;
    }
}
