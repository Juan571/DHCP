
$(document).ready(function() {

    // cargarDatePicker();
    $("#botonlimpiar").on("click",function(){
        $("#id_usuario").val("");
        $("#btneditarMaterial").hide();
        $("#guardar").show();
        $("#tipo_usuario").bootstrapSwitch('state',false);
        $("#password").attr('name',"password").removeAttr("disabled")
        $("#confirma_clave").attr('name',"confirma_clave").removeAttr("disabled");

    });
    var cambiarDiseno = {};

    cambiarDiseno['tamano']= null;
    cambiarDiseno['bPaginate'] = true;
    cambiarDiseno['bScrollCollapse'] = false;
    cambiarDiseno['searching'] = true;
    cambiarDiseno['bLengthChange'] = false;
    cambiarDiseno['iDisplayLength'] = 5;
    //bSort = cambiarDiseno['bSort'];

    sDefaultContent ="<button title='Editar' style='padding:3px' class='btnEditar  btn btn-warning'>" +
    "<span class='glyphicon glyphicon-pencil'></span>" +
    "</button>"+
    "<button title='Resetear Clave' style='padding:3px' class='btnReset btn btn-info '>" +
    "<span class='glyphicon glyphicon-refresh'></span>" +
    "</button>"
    ;
    cargarTablas("obtenerUsuarios", "", "#tabla_usuarios", cambiarDiseno, [0,-2],"./php/php_control_usuarios.php",null,sDefaultContent);

    $("#cedula_usuario").focus();
    $(".btnsw").bootstrapSwitch();
    $('.bootstrap-switch-handle-on').attr("class", "glyphicon glyphicon-ok-sign bootstrap-switch-handle-on bootstrap-switch-info");
    $('.bootstrap-switch-handle-off').attr("class", "glyphicon glyphicon-remove bootstrap-switch-handle-on bootstrap-switch-danger");

    $("#perspective").hide();

    setInterval(function(){
        $("#perspective").fadeIn(500);
    }, 0);


    $("#form1").validate({
        rules:{
            login:{
                required:true,
                minlength: 4
            },
            cedula_usuario:{
                required:true,
                minlength: 6
            },
            nombre_usuario:{
                required:true,
                minlength: 4
            },
            apellido_usuario:{
                required:true,
                minlength: 4
            },
            password:{

                minlength: 5
            },
            confirma_clave:{
                required:true,
                minlength: 5,
                equalTo: "#password"
            }
        },
        messages:{
            login:{
                required:"Ingresa nombre de Usuario con el que iniciará sesión",
                minlength: "El nombre de usuario debe tener un minimo de 4 caracteres"
            },
            cedula_usuario:{
                required:"Ingresa la cédula",
                minlength: "La cédula debe de tener un minimo de 6 caracteres"
            },
            nombre_usuario:{
                required:"Ingrese el nombre del usuario",
                minlength: "La Descripción debe de tener un minimo de 4 caracteres"
            },
            apellido_usuario:{
                required:"Ingresa el Apellido del Usuario",
                minlength: "La Descripción debe de tener un minimo de 4 caracteres"
            },
            password:{
                minlength: "La clave debe de tener un minimo de 5 caracteres"
            },
            confirma_clave:{
                required:"Ingresa una clave valida",
                minlength: "La clave debe de tener un minimo de 5 caracteres",
                equalTo:"Las contraseñas deben conincidir."
            }
        },
        debug:true,
        submitHandler:function(){
            datosformulario1 = $("#form1").serializeArray();
            datos={};
            if($("#id_usuario").val()==""){
                datos["action"]="guardarUsuario";
            }
            else{
                datos["action"]="editarUsuario";
                datos["id_usuario"]=$("#id_usuario").val();
            }

            $.each(datosformulario1, function (i, a) {
                if(a.value===""){
                    a.value=null;
                }
                datos[a.name]=a.value;
            });
            datos["tipo_usuario"]=$("#tipo_usuario").bootstrapSwitch('state');
            console.log(datos);
            ajax(datos);

        }
    });

});
function ajax(data){


    $.ajax({
        url: "./php/php_control_usuarios.php",
        async: false,
        data: data,
        dataType: "JSON",
        type: "post",
        error: function (err) {
            error = err;
            console.log(error);
            alert("Este Registro ya existe..");
        },
        success: function (resp) {
            console.log(resp);

            switch (resp.evento) {

                case "guardarUsuario":
                    PNotify.removeAll();

                    new PNotify({
                        title: 'Exito',
                        text: 'Usuario registrado Exitosamente',
                        hide: true,
                        type: 'success',
                        buttons: {
                            sticker: false
                        }
                    });
                    break;
                case "editarUsuario":
                    PNotify.removeAll();

                    new PNotify({
                        title: 'Exito',
                        text: 'Usuario Editado Exitosamente',
                        hide: true,
                        type: 'success',
                        buttons: {
                            sticker: false
                        }
                    });
                    break;
                case "ResetClave":
                    PNotify.removeAll();

                    new PNotify({
                        title: 'Clave Reseteada',
                        text: 'La clave nueva del usuario será 123456 ',
                        hide: true,
                        type: 'info',
                        buttons: {
                            sticker: false
                        }
                    });
                    break;

            }

            if ($("#tabla_usuarios").children().length > 0) {
                $("#tabla_usuarios").dataTable().fnClearTable();
                $("#tabla_usuarios").dataTable().fnDestroy();
                $("#tabla_usuarios thead > tr >  th").hide();
            }
            var cambiarDiseno = {};

            cambiarDiseno['tamano']= null;
            cambiarDiseno['bPaginate'] = true;
            cambiarDiseno['bScrollCollapse'] = false;
            cambiarDiseno['searching'] = true;
            cambiarDiseno['bLengthChange'] = false;
            cambiarDiseno['iDisplayLength'] = 5;
            //bSort = cambiarDiseno['bSort'];


            sDefaultContent ="<button style='padding:3px' class='btnEditar  btn btn-warning'>" +
            "<span class='glyphicon glyphicon-pencil'></span>" +
            "</button>"+
            "<button style='padding:3px' class='btnReset btn btn-info'>" +
            "<span class='glyphicon glyphicon-refresh'></span>" +
            "</button>"
            ;
            cargarTablas("obtenerUsuarios", "", "#tabla_usuarios", cambiarDiseno, [0,-2],"./php/php_control_usuarios.php",null,sDefaultContent);
            $("#botonlimpiar").trigger("click");
        }
    });
}
function seleccionarUsuario(data){
    $("#password").attr('name',"tempname").attr("disabled",'true');
    $("#confirma_clave").attr('name',"tempname2").attr("disabled",'true');
    $("#btneditarMaterial").show();
    $("#guardar").hide();

    $("#id_usuario").val(data[0]);
    $("#nombre_usuario").val(data[2]);
    $("#apellido_usuario").val(data[3]);
    $("#login").val(data[1]);
    $("#cedula_usuario").val(data[4]);

    if (data[5]=='S'){
        $("#tipo_usuario").bootstrapSwitch('state',true);
    }else{
        $("#tipo_usuario").bootstrapSwitch('state',false);
    }
}

function ResetClave(data){
    datos["action"]="ResetClave";
    datos["id_usuario"]=data[0];
    ajax(datos);
}