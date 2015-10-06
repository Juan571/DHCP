
$(document).ready(function() {

    // cargarDatePicker();

    var cambiarDiseno = {};
    cambiarDiseno['tamano']= null;
    cambiarDiseno['bPaginate'] = true;
    cambiarDiseno['bScrollCollapse'] = false;
    cambiarDiseno['searching'] = true;
    cambiarDiseno['bLengthChange'] = true;
    cambiarDiseno['iDisplayLength'] = 10;
    cambiarDiseno['ancho'] = [
        { "width": "0%" },
        { "width": "15%" },
        { "width": "10%" },
        { "width": "55%" },
        { "width": "10%" },
        { "width": "8%" },
        { "width": "0%" }


    ];
    sDefaultContent ="<button title='Editar' style='padding:3px' class='btnEditar  btn btn-warning'>" +
        "<span class='glyphicon glyphicon-pencil'></span>" +
        "</button>"+
        "<button title='Resetear Clave' style='padding:3px' class='btnReset btn btn-info '>" +
        "<span class='glyphicon glyphicon-refresh'></span>" +
        "</button>"
    ;
    cargarTablas("obtenerAuditorias", "", "#tabla_auditorias", cambiarDiseno, [-1,0],"./php/php_auditorias.php",null,sDefaultContent);




    $("#perspective").hide();

    setInterval(function(){
        $("#perspective").fadeIn(500);
    }, 0);




});
