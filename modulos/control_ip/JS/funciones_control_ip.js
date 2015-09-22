var url = 'php/php_gestionIP.php';
var urlRed = '../control_red/php/php_gestionRed.php';

var HOST = null;
var datosform = null;

//    $(".btnsw").bootstrapSwitch();
//
//  $('.bootstrap-switch-handle-on').attr("class", "glyphicon glyphicon-ok-sign bootstrap-switch-handle-on bootstrap-switch-info");
//  $('.bootstrap-switch-handle-off').attr("class", "glyphicon glyphicon-remove bootstrap-switch-handle-on bootstrap-switch-danger");


$(document).ready(function(){
    $("#ip-error").css("color","red");
    $("#perspective").hide();

    $.validator.addMethod('IP4Checker', function(value) {
        var ip = /^(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])(\.(25[0-5]|2[0-4][0-9]|[0-1][0-9]{2}|[0-9]{2}|[0-9])){3}$/;
        return value.match(ip);
    }, 'Error en la IP');

    $.validator.addMethod('MACChecker', function(value) {
        var mac = /^([0-9a-fA-F][0-9a-fA-F]:){5}([0-9a-fA-F][0-9a-fA-F])$/;
        return value.match(mac);
    }, 'Error en la MAC');

    $.validator.addMethod('IPexiste', function(value) {
        value = value.trim().toUpperCase();
        existe=null;

        for (i = 0; i < datosips["iphosts"].length; i++) {
            if (datosips["iphosts"][i]==value){
                existe = true;
                break;
            }
        }
        if($("#id_sel").val()!="") {
            if (datosform[0]["value"] == value) {
                return value;
            }
        }
        if (existe)
        return;

        return value;
    }, 'Esta ip se encuentra Asignada');

    $.validator.addMethod('HOSTexiste', function(value) {
        value = value.trim().toUpperCase();
        existe=null;

        for (i = 0; i < datosips["nombre_hosts"].length; i++) {
            if (datosips["nombre_hosts"][i]==value){
                existe = true;
                break;
            }
        }
        if($("#id_sel").val()!=""){
            if (datosform[1]["value"]==value){
                return value;
            }
        }
        if (existe)
            return;
        return value;
    }, 'Este nombre de HOST ya se encuentra Asignado');

    $.validator.addMethod('MACExiste', function(value) {

        datosform = $("#form1").serializeArray();
        value = value.trim().toUpperCase();


        existe=null;

        for (i = 0; i < datosips["mac_hosts"].length; i++) {
            if (datosips["mac_hosts"][i]==value){
                existe = true;
                break;
            }
        }
        if($("#id_sel").val()!=""){
            if (datosform[3]["value"]==value){
                return value;
            }
        }
        if (existe){
            return;
        }

        return value;
    }, 'Esta MAC ya se encuentra registrada');


    setInterval(function(){  $("#perspective").fadeIn(500); }, 0);

    obtenerRedes();
    $("#botonlimpiar").on("click",function(){
        $("#form1").trigger("reset");
    });

    $("#comboSEGRED" ).change(function() {
        dibujartablahost($("#comboSEGRED").val().toString());
    });
  //  $("#ip").mask('000.000.000.000');
    $("#hostlibres").parent().parent().click(function(){
        $("#ipslibresmodal").html("");
        datosips=obteneriplibres();
        for (i = 0; i < datosips['iplibres'].length; i++) {
            $("#ipslibresmodal").prepend("<span class='badge ipslibrebadge'><strong id='gateway'>"+datosips['iplibres'][i]+"</strong>")
        }
        $('#modalIpLibres').foundation('reveal', 'open');
    });

    //$('#ip').mask('099.099.099.099');

    $("#form1").validate({
        rules:{
            nombre_ip:{
                required:true,
                minlength: 5,
                HOSTexiste: true
            },
            descripcion_ip:{
                required:true,
                minlength: 5
            },
            mac_ip:{
                required:true,
                minlength: 16,
                MACChecker:true,
                MACExiste:true
            },
            ip:{
                required:true,
                minlength: 12,
                IP4Checker:true,
                IPexiste:true
            }

        },
        messages:{
            nombre_ip:{
                required:"Ingresa un nombre para el Host",
                minlength: "Debe de tener al menos 5 caracteres"
            },
            descripcion_ip:{
                required:"Ingresa una descripción para el Host",
                minlength: "Ingresa el una Ip Válida (192.168.100.0)"
            },
            mac_ip:{
                required:"Ingresa una MAC válida",
                minlength: "Ingresa una mac válida"
            },
            ip:{
                required:"Ingresa el una Ip Válida",
                minlength: "Ingresa el una Ip Válida (192.168.100.1)"
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
            datos["red"]=$("#comboSEGRED").val().toString();
            if($("#id_sel").val()==""){
                datos["id_red"]=$("#id_sel").val();
                data["action"]="GuardarHost";
                data["data"]=datos;
            }
            else{
                datos["id_red"]=$("#id_sel").val();
                data["action"]="EditarHost";
                data["data"]=datos;
            }
            console.log(data);
            ajaxHOST(data);
        }
    });

});

function solotexto(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[A-Za-z-1-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
function ajaxHOST(data){
    $.ajax({
        url: "./php/php_gestionIP.php",
        async: true,
        data: data,
        dataType: "JSON",
        type: "post",
        error: function (err) {
            error = err;
            console.log(error);
            // alert("Este Registro ya existe..");
        },
        success: function (resp) {
          //  console.log(resp);

            switch (resp.evento) {

                case "EditarHost":
                    $('#modalEditarPc').foundation('reveal', 'close');
                    if (resp.respuesta=="erroip"){
                        PNotify.removeAll();
                        new PNotify({
                            title: 'Error',
                            text: 'La ip no esta dentro del segmento de la red Seleccionada',
                            hide: true,
                            type: 'error',
                            buttons: {
                                sticker: true
                            }
                        });
                        break;
                    }
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
                case "GuardarHost":
                    $('#modalEditarPc').foundation('reveal', 'close');
                    if (resp.respuesta=="erroip"){
                        PNotify.removeAll();
                        new PNotify({
                            title: 'Error',
                            text: 'La ip no esta dentro del segmento de la red Seleccionada',
                            hide: true,
                            type: 'error',
                            buttons: {
                                sticker: true
                            }
                        });
                        break;
                    }
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
                case "EliminarHost":
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

            dibujartablahost($("#comboSEGRED").val().toString());

            $("#form1").trigger("reset");
            $("#btneditarRED").hide();
            $("#guardar").show();
            $("#id_sel").val("");
        }
    });
}

function editarIp(host){
    datosform = null;
    $('#modalEditarPc').foundation('reveal', 'open');
    $("label.error").hide()
    $("#modalTitleIP").html("Editar HOST");
    $("#nombre_ip").val(host[0]);
    $("#descripcion_ip").val(host[1]);
    $("#mac_ip").val(host[2]);
    $("#ip").val(host[3]);
    $("#btneditarIP").show();
    $("#guardar").hide();
    $("#id_sel").val(host[3]);

    datosform = $("#form1").serializeArray();
   //
    //console.log(datosform);
}
function EliminarHost(host){
    var r = confirm("¿Realmente desea eliminar este Host?");
    if (r == true) {
        data={};
        datos={};
        datos["ipsel"]=host[3];
        data["action"]="EliminarHost";
        data["data"]=datos;
        ajaxHOST(data);
    }
}

function GuardarHost(host){
    datosform = null;
    $('#modalEditarPc').foundation('reveal', 'open');
    $("label.error").hide();
    $("#btneditarIP").hide();
    $("#guardar").show();
    $("#modalTitleIP").html("Nuevo HOST");
    $("#form1").trigger("reset");
    $("#id_sel").val("");
}


function dibujartablahost(red){
    if ($("#tablaHosts").children().length > 0) {
        $("#tablaHosts").dataTable().fnClearTable();
        $("#tablaHosts").dataTable().fnDestroy();
        $("#tablaHosts thead > tr >  th").hide();
    }
    var cambiarDiseno = {};

    cambiarDiseno['tamano']= null;
    cambiarDiseno['bPaginate'] = true;
    cambiarDiseno['bScrollCollapse'] = false;
    cambiarDiseno['searching'] = true;
    cambiarDiseno['bLengthChange'] = false;
    cambiarDiseno['iDisplayLength'] = 5;
    cambiarDiseno['ancho'] = [
        { "width": "20%" },
        { "width": "50%" },
        { "width": "10%" },
        { "width": "10%" },
        { "width": "10%" }

    ];

    var data ={};
    data["subnet"]= red;//$("#comboSEGRED").val();
    //console.log(data["subnet"]);

    sDefaultContent ="" +
        "<button style='padding:3px' class='botonRow editip  btn btn-info '><span class='glyphicon glyphicon-wrench'></span></button>" +
        "<button style='padding:3px' class='botonRow eliminarip btn btn-danger '><span class='glyphicon glyphicon-remove'></span></button>";
    cargarTablas("obtenerHosts", data, "#tablaHosts", cambiarDiseno, [],"./php/php_gestionIP.php",null,sDefaultContent);
    //console.log($("#tablaHosts").children());
    dibujarGrafico();
    obteneriplibres();
}

function obteneriplibres(){

    var data ={};
    data["subnet"]= $("#comboSEGRED").val();
    //var iptotales = ["Saab", "Volvo", "BMW"];
    var iptotales = obteneipsred(data);
    var iphosts = obtenerHosts(data);
    var iplibres = [];

    for	(index = 0; index < iptotales.length; index++) {
        bandera = false;
        for	(index2 = 0; index2 < iphosts[0].length; index2++) {
            if (iptotales[index]===iphosts[0][index2]){
                bandera =true;
            }
        }
        if (!bandera){
            iplibres.push(iptotales[0][index])
        }
    }
    var result ={};
    result["iplibres"]=iplibres;
    result["totales"]=iptotales;
    result["iphosts"]=iphosts[0];
    result["nombre_hosts"]=iphosts[1];
    result["mac_hosts"]=iphosts[2];

    return result;


}

function dibujarGrafico(){
    datosips = obteneriplibres();

    var iptotales = datosips['totales'];
    var iphosts = datosips['iphosts'];
    var iplibres = datosips['iplibres'];

    Morris.Donut({
        element: 'donut-articulos',
        data: [
            {label: "Host Usados", value: iphosts.length},
            {label: "Host Libres", value: iplibres.length},
        ],
        colors: ['#07bee5', '#75ab00'],
        labelColor: "#F7F5F5"
    });
    $("#numhosts").text(iptotales.length);
    $("#hostusados").text(iphosts.length);
    $("#hostlibres").text(iplibres.length);

    var redSeleccionada = document.getElementById("comboSEGRED").selectedIndex;

    $("#gateway").text(HOST[redSeleccionada].puerta);
}

function obtenerRedes(){
    $.getJSON(urlRed+'?action=obtenerRedes', function(json) { // Obtener Accesorios
        datosTabla = [];
        HOST=json;
        $.each(json, function(i, j){
            if(j.descripción==null){
                j.descripción="";
            }
            $("#comboSEGRED").append(new Option(j.descripción+" Red-> ("+j.RED+") Mascara->("+ j.mascara+")", j.RED+"/"+j.netmask2cidr));
            $.each(j, function(key,value){
                //  console.log(key);
            });
        });
    }).fail(function(aa){
        console.log(aa);
    }).complete(function(aa){
        $("#comboSEGRED").append(new Option("Todos","todos"));
        dibujartablahost($("#comboSEGRED").val().toString());
    });
}


function obtenerHosts(red){
    datos = {
        action          : "obtenerHosts",
        data            : red
    };
    ips = [];
    nombres = [];
    mac = [];
    data =[];
    $.ajax({
        url:url,
        data:datos,
        dataType:"json",
        type:"POST",
        async:false,
        error:function(req,err){
            console.log(req);
            $(tabla).hide();
            return false;
        },
        success: function(resp) {

            $.each(resp, function (i, a) {
                ips.push(a['ip']);
                nombres.push(a['nombre']);
                mac.push(a['mac']);
            });

            data.push(ips);
            data.push(nombres);
            data.push(mac);
            return datos;
        }
    });
    return data;
}

var ipsred;
function obteneipsred(red){
    //$(".btnsw").bootstrapSwitch('state', false, false);

    var ipsred;

    datos = {
        action          : "obtenerDatosRed",
        data            : red
    };
    ips = [];
    var respuesta =  $.ajax({
        url:url,
        data:datos,
        dataType:"json",
        type:"POST",
        async:false,
        error:function(req,err){
            console.log(req);
            $(tabla).hide();
            return false;
        },
        success: function(resp) {
            //resp=resp.responseText;
            num_clases = (resp['hosts']/256)-1;

            inicio_red = resp['ip_red'];
            fin_red = resp['broadcast'];
            /********************************************************************************/
            //                                                                              //
            //  192.168.100.1  ===>   192=octetoA - 168=octetoB - 100=octectoC - 1=octectoD //
            //                                                                              //
            /********************************************************************************/
            octetoA=inicio_red.split(".")[0];
            octetoB=inicio_red.split(".")[1];

            inicio_octetoC=inicio_red.split(".")[2];
            fin_octetoC=fin_red.split(".")[2];

            inicio_octetoD=parseInt(inicio_red.split(".")[3]+1); //se le suma 1 xq (0 es ip de red y 1 puede ser un gateway.... )

            fin_octetoD=fin_red.split(".")[3];

            for (i = inicio_octetoC; i <=fin_octetoC; i++) {
                //  console.log(i);
                for (j = inicio_octetoD+1; j <fin_octetoD; j++) {
                    ips.push(octetoA+"."+octetoB+"."+i+"."+j);
                }
            }
        }
    });
    return ips;
}


