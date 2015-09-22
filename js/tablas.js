
var bPaginate = true ;
var bScrollCollapse= false;
var sScrollY= null;
var searching = true;
var bLengthChange =true;
var bSort = true ;
var iDisplayLength  = 10 ;
var cambiarDiseno = {};

/*
 var cambiarDiseno['tamano'];
 var cambiarDiseno['bPaginate'];
 var cambiarDiseno['bScrollCollapse'];
 var cambiarDiseno['searching'];
 var cambiarDiseno['bLengthChange'];
 var cambiarDiseno['iDisplayLength'];
 */

function crearTh(datos,tabla){
    var tablatemp=tabla;
    var tabla=tabla;
    var classOpc ="indice";
    var indice=null;
    $(tabla).html("<thead ><tr class=\"rowtabla\">");
    tabla+=" thead tr";
    $.each(datos,function(k,v){
        var th = $("<th>",{
            css:{
                "padding-left":"4px",
                "padding-right":"4px",
                "padding-bottom":"4px",
                "padding-top":"4px",
                "text-align":"center"
            },
            html : v
        });
        if(k===indice){
            $(th).addClass(classOpc);
        }
        $(tabla).append(th);
        //    $(tabla).append("<th style=\"padding-left: 4px;padding-right: 4px;padding-top: 2px;padding-bottom: 2px;\">"+v+"</th>");
    });

    switch (tablatemp){
        case '#tablaAccesoriosOrden':
            $(tabla).append("<th>Recibido</th>");
            break;
        case '#tablaHosts':
            $(tabla).append("<th style='text-align: center'>OPERACION</th>");

            break;
        case '#tabla_redes':
            $(tabla).append("<th style='text-align: center'>Operacion</th>");

            break;

        default:
            $(tabla).append("<th style='text-align: center'>Acción</th>");


    }

}

function cargarTablas(action,data,tabla,cambiarDiseno,columnasvisibles,url,urlIdioma,sDefaultContent){
    //console.log(data);
    var header=[];
    datos = {
        action          : action,
        accion          : action,
        data            : data
    }
    var tabla=tabla;
    if(urlIdioma==null){
        urlIdioma="http://rec.vtelca.gob.ve/datatables/lang/Spanish.json";
    }
    if(url==null){
        dir="./BD/swtichprepared.php";
    }else{
        dir=url;
    }
    if(sDefaultContent==null){

        sDefaultContent ="<button style='padding:3px' class='botonRow  btn btn-danger '>Editar</span></button>";

    }



    $.ajax({
        url:dir,
        data:datos,
        dataType:"json",
        type:"POST",
        async:true,
        error:function(req,err){
            console.log(req);
            $(tabla).hide();
        },
        success: function(resp) {
            //console.log(resp);
            var data =[];
            var data2=[];
            var ih=0;
            var op=0;
            var datostr=[];
            if(resp.length==0){

                switch (tabla){
                    case "#tablaUsuariosConsultaMorosos":
                        $(".colmorosos").hide();
                        break;
                    case "#tablaHosts":
                        alert("No hay datos");
                        break;

                }

                return 0;
            }
            Keys = Object.keys(resp[0]);
            var cont=0;
            var cont=0;
            Keys.map(function(v){
                Keys[cont]=v.charAt(0).toUpperCase()+v.slice(1);
                cont++;
            })
            cont=0;
            crearTh(Keys,tabla);//Añadir Thead a la Tabla, con los object Key obtenidos

            $.each(resp, function (ix, itemx) {
                op++;
                data=[];
                $.each(itemx, function (ixx, itemxx) {
                    ih++;
                    data.push(itemxx);
                });
                data2[ix]=data;//creo el array con el array del tr dentro..
                ih=0;
            });
            //console.log(data);
            if(cambiarDiseno!=null){
                sScrollY  = cambiarDiseno['tamano'];
                bPaginate = cambiarDiseno['bPaginate'];
                bScrollCollapse = cambiarDiseno['bScrollCollapse'];
                searching = cambiarDiseno['searching'];
                bLengthChange = cambiarDiseno['bLengthChange'];
                iDisplayLength = cambiarDiseno['iDisplayLength'];
                bJQueryUI: cambiarDiseno['bJQueryUI'];
                ancho= cambiarDiseno['ancho'];
                //bSort = cambiarDiseno['bSort'];
            }
            else{
                bJQueryUI: true,
                    bPaginate = true ;
                bScrollCollapse= false;
                sScrollY= "";
            }

            $(tabla).dataTable( {
                "bRetrieve" :true,
                "iDisplayLength": iDisplayLength ,
                "bSort" :"true",
                "sScrollY": sScrollY,
                "bScrollCollapse": bScrollCollapse,
                "bPaginate":bPaginate,
                "searching": searching,
                "bLengthChange": bLengthChange,
                "data": data2,
                "bJQueryUI":false,
                "async": false,
                "oLanguage" : {
                    "sUrl": "http://rec.vtelca.gob.ve/datatables/lang/Spanish.json"
                },"columns": ancho,
                "aoColumnDefs": [
                    {
                        "aTargets": [-1],
                        "mData": null,
                        "sDefaultContent" :sDefaultContent,
                        "mRender": function (data, type, full) {
                        }
                    },
                    {
                        "targets": columnasvisibles,
                        "visible": false,
                        "searchable": false
                    }
                ],



                "fnRowCallback":function( nRow, aData, iDisplayIndex, iDisplayIndexFull ){

                    if(tabla==="#tablaHosts"){
                        var boton = $(nRow).find(".botonRow");
                        $(boton).parent().attr('style','text-align:center');

                        var btnEditar = $(nRow).find(".editip").off();
                        var btnEliminar = $(nRow).find(".eliminarip").off();

                        $(btnEditar).on("click",function () {
                            //    abrirmodal();
                           editarIp(aData);
                        });
                        $(btnEliminar).on("click",function () {
                            EliminarHost(aData);
                           // console.log(aData);
                        });

                        $(btnEditar).parent().attr('style','text-align:center');


                    }

                    if(tabla==="#tabla_redes"){


                        var btnEditar = $(nRow).find(".editip").off();
                        var btnEliminar = $(nRow).find(".eliminarip").off();

                        $(btnEditar).on("click",function () {
                            //console.log(aData);
                        //    abrirmodal();
                            editarSubNet(aData);
                        });
                        $(btnEliminar).on("click",function () {
                           eliminarSubNet(aData);
                        });

                        $(btnEditar).parent().attr('style','text-align:center');



                        $(nRow).children().each(function(index, td) {
                            if(index == 3)  {
                                if ($(td).html().length>0) {
                                }else{
                                    $(td).html("No Definido").attr("style","text-align: center;");
                                }
                               /* if ($(td).html() == "") {
                                    $(nRow).children().each(function(index, td) {
                                            console.log($(td).html());
                                        if(index == 1)  {
                                            $(td).attr("style","background-color:rgb(103, 255, 33)")
                                        }});
                                }else{
                                    $(td).attr("style","background-color:rgb(255,151,142)")
                                }*/
                            }
                            if(index == 4)  {
                                if ($(td).html().length>0) {
                                }else{
                                    $(td).html("No Definido").attr("style","text-align: center;");
                                }
                            }
                        });

                    }

                    var tabla1 = $(tabla).DataTable();
                    var cadenatabla = tabla + " tbody";
                    $(cadenatabla).on( 'click', 'tr', function () {
                        if ( $(this).hasClass('selected') ) {
                        }
                        else {
                            tabla1.$('tr.selected').removeClass('selected');
                            $(this).addClass('selected');
                        }
                    });
                }
                //aoColumns..
            });  // datatable
        }//succes
    });//ajax
}
