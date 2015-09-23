
$(document).ready(function() {

    $.validator.addMethod('IP4Checker', function(value) {
        var ip = /^(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])){3}$/;
        return value.match(ip);
    }, 'Error en la IP');
    // cargarDatePicker();
    $("#botonlimpiar").on("click",function(){
        $("#form1").trigger("reset");
        $("#btneditarRED").hide();
        $("#guardar").show();

    });
   // $(".ip").mask('099.099.099.099');
        // solicitarDatos("obtenerCategorias");
    $("#ip_red").focus();


    $("#perspective").hide();
    //cargarTablas("obtenerPCS", "", "#tabla_pcs", cambiarDiseno, [0,-2],"./php/php_control_equipos.php");
    var cambiarDiseno = {};
    cambiarDiseno['tamano']= null;
    cambiarDiseno['bPaginate'] = true;
    cambiarDiseno['bScrollCollapse'] = false;
    cambiarDiseno['searching'] = true;
    cambiarDiseno['bLengthChange'] = false;
    cambiarDiseno['iDisplayLength'] = 8;
    cambiarDiseno['ancho'] = [
        { "width": "10%" },
        { "width": "10%" },
        { "width": "10%" },
        { "width": "15%" },
        { "width": "35%" },
        { "width": "0%" },
        { "width": "0%" },
        { "width": "0%" },
        { "width": "20%" }
    ];
    sDefaultContent ="" +
        "<button style='padding:3px' class='botonRow editip  btn btn-info '><span class='glyphicon glyphicon-wrench'>Editar</span></button>" +
        "<button style='padding:3px' class='botonRow eliminarip btn btn-danger '><span class='glyphicon glyphicon-remove'>Eliminar</span></button>";
    cargarTablas("obtenerRedes", "", "#tabla_redes", cambiarDiseno, [-2,-3,-4],"./php/php_gestionRed.php",null,sDefaultContent);

    setInterval(function(){
        $("#perspective").fadeIn(500);
    }, 0);


    $("#form1").validate({
        rules:{
            mask:{
                required:true,
                minlength: 8,
                IP4Checker: true
            },
            ip_red:{
                required:true,
                minlength: 8,
                IP4Checker: true
            },
            gateway:{
                required:true,
                minlength: 8,
                IP4Checker: true
            },
            descripcionSubnet:{
                required:true,
                minlength: 12
            },
            rangemin:{
                required:false,
                minlength: 8,
                IP4Checker: false
            },
            rangemax:{
                required:false,
                minlength: 8,
                IP4Checker: false
            }

        },
        messages:{
            mask:{
                required:"Ingresa el una Ip Válida",
                minlength: "Ingresa el una Ip Válida (255.255.255.0)"
            },
            ip_red:{
                required:"Ingresa el una Ip Válida",
                minlength: "Ingresa el una Ip Válida (192.168.100.0)"
            },
            descripcionSubnet:{
                required:"Ingresa una Descripcion",
                minlength: "La descripcion debe de tener un minimo de 12 de caracteres"
            },
            gateway:{
                required:"Ingresa el una Ip Válida",
                minlength: "Ingresa el una Ip Válida (192.168.100.1)"
            },
            rangemin:{
                minlength: "Ingresa el una Ip Válida (192.168.100.2)"
            },
            rangemax:{
                minlength: "Ingresa el una Ip Válida (192.168.100.254)"
            }

        },
        debug:true,
        submitHandler:function(){
            datosformulario1 = $("#form1").serializeArray();
            data={};
            datos={};
            $.each(datosformulario1, function (i, a) {
                if(a.value===""){
                    a.value=null;
                }
                datos[a.name]=a.value;
            });
            if($("#id_red").val()==""){
                data["action"]="GuardarRed";
                data["data"]=datos;
            }
            else{
                datos["id_red"]=$("#id_red").val();
                data["action"]="EditarRedes";
                data["data"]=datos;
            }
                console.log(data);
                ajax(data);
        }
    });


});
function abrirmodal(){

    $('#modalEditarSubnet').foundation('reveal', 'open');
}
function ajax(data){
    $.ajax({
        url: "./php/php_gestionRed.php",
        async: true,
        data: data,
        dataType: "JSON",
        type: "post",
        error: function (err) {
            error = err;
            console.log(error);
            alert(error.responseText);
        },
        success: function (resp) {
            console.log(resp);

            switch (resp.evento) {

                case "EditarRedes":

                    PNotify.removeAll();

                    new PNotify({
                        title: 'Exito',
                        text: 'Editado Exitosamente',
                        hide: true,
                        type: 'success',
                        buttons: {
                            sticker: true
                        }
                    });
                    break;
                case "GuardarRed":
                    PNotify.removeAll();

                    new PNotify({
                        title: 'Exito',
                        text: 'Guardado Exitosamente',
                        hide: true,
                        type: 'success',
                        buttons: {
                            sticker: true
                        }
                    });
                    break;
                case "EliminarRed":
                    PNotify.removeAll();

                    new PNotify({
                        title: 'Exito',
                        text: 'Eliminado Exitosamente',
                        hide: true,
                        type: 'success',
                        buttons: {
                            sticker: true
                        }
                    });
                    break;
                default :
                    PNotify.removeAll();

                    new PNotify({
                        title: 'Alert',
                        text: 'Error',
                        hide: true,
                        type: 'warning',
                        buttons: {
                            sticker: true
                        }
                    });
                    break;
            }

            if ($("#tabla_redes").children().length > 0) {
                $("#tabla_redes").dataTable().fnClearTable();
                $("#tabla_redes").dataTable().fnDestroy();
                $("#tabla_redes thead > tr >  th").hide();
            }
            var cambiarDiseno = {};
            cambiarDiseno['tamano']= null;
            cambiarDiseno['bPaginate'] = true;
            cambiarDiseno['bScrollCollapse'] = false;
            cambiarDiseno['searching'] = true;
            cambiarDiseno['bLengthChange'] = false;
            cambiarDiseno['iDisplayLength'] = 8;
            cambiarDiseno['ancho'] = [
                { "width": "10%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "15%" },
                { "width": "35%" },
                { "width": "0%" },
                { "width": "0%" },
                { "width": "0%" },
                { "width": "20%" }
            ];
            sDefaultContent ="" +
                "<button style='padding:3px' class='botonRow editip  btn btn-info '><span class='glyphicon glyphicon-wrench'>Editar</span></button>" +
                "<button style='padding:3px' class='botonRow eliminarip btn btn-danger '><span class='glyphicon glyphicon-remove'>Eliminar</span></button>";
            cargarTablas("obtenerRedes", "", "#tabla_redes", cambiarDiseno, [-2,-3,-4],"./php/php_gestionRed.php",null,sDefaultContent);
            $("#form1").trigger("reset");
            $("#btneditarRED").hide();
            $("#guardar").show();
        }
    });
}

function editarSubNet(aData){
    $('#form1').trigger("reset");
    $("#id_red").val("subnet "+aData[0]+" netmask "+aData[1]+" {");
    $("#ip_red").val(aData[0]);
    $("#mask").val(aData[1]);
    $("#gateway").val(aData[2]);
    $("#descripcionSubnet").val(aData[4]);
    if (aData[3]){
        var arr = aData[3].split('->');
        $("#rangemin").val(arr[0]);
        $("#rangemax").val(arr[1]);
    }else{
        $("#rangemin").attr("placeholder","No Definido");
        $("#rangemax").attr("placeholder","No Definido");
    }
    $("#btneditarRED").show();
    $("#guardar").hide();
}
function eliminarSubNet(aData){
    data={};
    var r = confirm("Realmente desea eliminar la SubNet "+aData[0]+" máscara="+aData[1]);
    if (r == true) {
        data["action"]="EliminarRed";
        data["id_red"]="subnet "+aData[0]+" netmask "+aData[1]+" {";
        ajax(data);
    }
}
