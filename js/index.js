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
            window.location.href = "pages/busqueda.php?j="+sText;
        break;

        case "comp":
            window.location.href = "pages/busqueda.php?c="+sText;
        break;

        case "staff":
            window.location.href = "pages/busqueda.php?s="+sText;
        break;

        case "plat":
            window.location.href = "pages/busqueda.php?p="+sText;
        break;
        
        case "todos": 
            window.location.href = "pages/busqueda.php?a="+sText;
        break;
    }
}
