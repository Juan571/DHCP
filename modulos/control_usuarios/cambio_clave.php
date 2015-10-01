<?php
/**
 *
 * Archivo que se encargar de la vista del modulo de cambiar clave
 *
 * @author Juan Romero  <jromero@vtelca.gob.ve>
 * @copyright 2015

 * @version 1
 */
use login\Sesion;

require_once '../../login/Sesion.php';
$sesion = new Sesion();
/**
 * valida si la sesion esta iniciada para dejar acceder, de lo contrario redirecciona la pagina de logueo
 *
 **/
if($sesion->sesion_iniciada()==false)
    header("Location: ../../index.php");


?>


<!DOCTYPE html>

<html >
<head>






    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="http://rec.vtelca.gob.ve/img/favicon.ico" />
    <script src="http://rec.vtelca.gob.ve/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="http://rec.vtelca.gob.ve/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="http://rec.vtelca.gob.ve/bootstrap-switch/master/js/bootstrap-switch.min.js"></script>
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap-switch/master/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap-switch/master/css/bootstrap2/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/css/jquery.dataTables.css">
    <script src="../../js/dataTables/media/js/jquery.dataTables.js"></script>
    <script src="JS/funciones_cambio_clave.js"></script>
    <script type="text/javascript" src="../../js/foundation/js/foundation.min.js"></script>
    <link rel="stylesheet" href="../../js/foundation/css/foundation.css">
    <link rel="stylesheet" href="../../js/foundation/css/foundation.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/pnotify.custom.min.css">
    <script type="text/javascript" src="../../js/pnotify.custom.min.js"></script>
    <script type="text/javascript" src="../../js/tablas.js"></script>

    <link rel="stylesheet" type="text/css" href="../../css/component.css" />
    <script src="../../js/jquery.validate.js"></script>
    <script src="../../js/jquery.mask.min.js"></script>
    <script src="../../js/morris-0.4.1.min.js"></script>
    <script src="../../js/raphael-min.js"></script>
    <script src="../../js/modernizr.custom.25376.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/estilos_personales.css" />

    <style type="text/css">


    </style>



    <script>

    </script>

    <title>Cambio de Clave</title>
</head>
<header>
    <script>

    </script>
</header>
<body>



<div id="perspective" class="perspective full effect-airbnb" style="overflow-y: inherit;">
    <a class="glyphicon glyphicon-tasks" id="showMenu" style="text-decoration: none; position: fixed;font-size: xx-large; padding-left: 95%; padding-top: 8%; color: aliceblue;" ></a>
    <?php
    echo "<div style='text-align: right;color: aliceblue;position: absolute;width: 100%;'><span class='glyphicon glyphicon-user'>&nbsp;</span><h2  style='font-size: large;float: right;color: aliceblue;margin-right: 1%;'>". $_SESSION["nombre_usuario"]." ".$_SESSION["apellido_usuario"]."</h2></div>";
    ?>
    <div id="" class="container" style="-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; /*background-color: silver;*/">
        <div class="wrapper" style="top: 23px;height: 1px;">

            <div class="fluid">
                <div class="row-fluid">
                    <div style="width:auto;/*background-color: #c0c0c0*/" class="" id="" align="center" >
                        <input style="display: none" id="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>" >

                        <h1  style="color: white;">Gestión de Usuarios</h1>
                        <form id="form1" name="formulario" enctype="application/x-www-form-urlencoded"  >

                            <fieldset style="border: none" >
                            <div style="width:40%;" class="" id="" align="center" >
                                <div class="col-md-12">
                                    <b style="color: white;">Contraseña Actual</b>
                                    <input   name="actual" type="text" id="actual" class="form-control" value="" size="12" placeholder="Indique la contraseña Actual" >
                                </div>

                                <div class="col-md-12">
                                  <b style="color: white;">Clave</b>
                                  <input  name="password" type="password" id="password" class="form-control" value="" maxlength="30" placeholder="Nueva Contraseña">
                                </div>
                                <div class="col-md-12">
                                  <b style="color: white;">Confirmar Clave</b>
                                  <input name="confirma_clave" type="password" id="confirma_clave" class="form-control" maxlength="30" value="" maxlength="100"  placeholder="Confirma Clave">
                                </div>


                                <div class="col-md-12" style="margin-top: 1%">
                                    <input class="btn btn-info submit"  id="guardar" type="submit" value="GUARDAR">
                                    <input type="reset" value="LIMPIAR " title="Limpiar Campos" id="botonlimpiar" class="btn botonlimpiar btn-danger">
                                </div>
                            </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>


        </div><!-- wrapper -->
    </div><!-- /container -->
    <nav class="outer-nav left vertical">
        <a href="../index.php" class="icon-home">Inicio</a>
        <a href="../control_red/control_red.php"  class="icon-programar">Gestionar Redes</a>
        <a href="../control_ip/control_ip.php" class="icon-RegPc">Gestionar IP's</a>
        <!--a href="../control_archivos/control_archivos.php" class="icon-RegCont">Agregar Contenido</a-->
        <?php
        if ($_SESSION['tipo_usuario']=='S'){
            echo "<a href='control_usuarios.php' class='icon-GesUsuarios'>Gestión de Usuarios</a>";
        }
        ?>
        <a href='/cambio_clave.php' class='icon-cambiarClave'>Cambiar Contraseña</a>
        <a href="../login/cerrar_sesion.php" class="icon-CerrarSesion">Cerrar Sesión</a>
    </nav>

</div><!-- /perspective -->
<script src="../../js/classie.js"></script>
<script src="../../js/menu.js"></script>

</body>
<script type="text/javascript">

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>

</html>