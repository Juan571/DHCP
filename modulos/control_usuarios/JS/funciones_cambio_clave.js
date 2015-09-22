
$(document).ready(function() {

    // cargarDatePicker();
    $("#botonlimpiar").on("click",function(){
        $("#id_usuario").val("");

    });

    $("#perspective").hide();

    setInterval(function(){
        $("#perspective").fadeIn(500);
    }, 0);

    $("#form1").validate({
        rules:{
            actual:{
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
            actual:{
                required:"Ingresa nombre de Usuario con el que iniciará sesión",
                minlength: "La contraseña debe de tener un minimo de 4 caracteres"
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
            datos["action"]="cambiarClave";
            datos["id_usuario"]=$("#id_usuario").val();
            $.each(datosformulario1, function (i, a) {
                if(a.value===""){
                    a.value=null;
                }
                datos[a.name]=a.value;
            });
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
            switch (resp.evento) {
                case "cambiarClave":
                    if (resp.respuesta=='claveInvalida'){
                        PNotify.removeAll();
                        new PNotify({
                            title: 'Error',
                            text: 'Las Conraseña actual no coincide',
                            hide: true,
                            type: 'error',
                            buttons: {
                                sticker: false
                            }
                        });
                    }else{
                        PNotify.removeAll();
                        new PNotify({
                            title: 'Exito',
                            text: 'Clave Cambiada Exitosamente',
                            hide: true,
                            type: 'success',
                            buttons: {
                            sticker: false
                            }
                        });
                    }
                    break;
            }
         $("#botonlimpiar").trigger("click");
        }
    });
}