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
    <script src="http://rec.vtelca.gob.ve/jquery/2.1.1/jquery.js"></script>

    <script src="http://rec.vtelca.gob.ve/bootstrap-switch/master/js/bootstrap-switch.min.js"></script>
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap-switch/master/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap-switch/master/css/bootstrap2/bootstrap-switch.min.css">

    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="http://rec.vtelca.gob.ve/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="http://rec.vtelca.gob.ve/bootstrap-select/1.6.0/dist/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap-select/1.6.0/dist/css/bootstrap-select.min.css">

    <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/css/jquery.dataTables.css">

    <script src="../../js/dataTables/media/js/jquery.dataTables.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Orbitron:500,700,900,400' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="../../js/foundation/js/foundation.min.js"></script>
    <link rel="stylesheet" href="../../js/foundation/css/foundation.css">
    <link rel="stylesheet" href="../../js/foundation/css/foundation.min.css">

    <link rel="stylesheet" type="text/css" href="../../css/pnotify.custom.min.css">
    <script type="text/javascript" src="../../js/pnotify.custom.min.js"></script>
    <script src="../../js/jquery.mask.js"></script>
    <script src="../../js/jquery.validate.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../../css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../../css/component.css" />

    <script type="text/javascript" src="./JS/funciones_cambio_clave.js"></script>
    <script src="../..//js/jquery.validate.js"></script>

    <script type="text/javascript" src="../../js/tablas.js"></script>
    <!-- csstransforms3d-shiv-cssclasses-prefixed-teststyles-testprop-testallprops-prefixes-domprefixes-load -->
    <script src="../../js/modernizr.custom.25376.js"></script>
    <style type="text/css">
        .container{
            width: 90%;

        }
        html{
            position: fixed;
        }
        input[type="search"] {
            height: 5%;
        }


        body{
            /* background-image: url("http://rec.vtelca.gob.ve/img/fondo-claro.png");*/
            background: transparent url(../../img/back1-blur.jpg) center fixed no-repeat;

            background-attachment: fixed;
            overflow: scroll;
            background-repeat:no-repeat;
            background-size:cover;
            opacity: 0.9;
        }
        header {
            height: 80px;
            background: url(http://rec.vtelca.gob.ve/img/cintillo-i.png) left no-repeat,
            url(http://rec.vtelca.gob.ve/img/vtelca-transparente.png) center no-repeat,
            url(http://rec.vtelca.gob.ve/img/pueblo-victorioso.jpg) right no-repeat;
            background-color: #fff;
            background-size: auto 50px;
            margin: 0px;
            margin-top: -10px;
            border-bottom: 4px solid #f00;
        }

        #imagenFlotante a img { border: none; }



    </style>



    <script>
        $(document).ready(function () {

        });
        /**
         * valida si la sesion esta iniciada para dejar acceder, de lo contrario redirecciona la pagina de logueo
         *
         **/

        <?php
            if (!isset($_SESSION["id_usuario"])) {
                print "parent.location.replace('../../index.php');";
            }
        ?>
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
                                    <input   name="actual" type="text" id="actual" class="form-control" value="" size="12" placeholder="Nombre de Usuario para Iniciar Sesion" >
                                </div>

                                <div class="col-md-12">
                                  <b style="color: white;">Clave</b>
                                  <input  name="password" type="password" id="password" class="form-control" value="" maxlength="30" placeholder="Clave">
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
        <a href="../control_ip/control_ip.php"  class="icon-programar">Programar Contenidos</a>
        <a href="../control_red/control_equipos.php" class="icon-RegPc">Registrar PC's</a>
        <a href="../control_archivos/control_archivos.php" class="icon-RegCont">Agregar Contenido</a>

        <?php
        /**
         * valido el tipo de usuario e imprimo la opcion del menú para poder Gestionar Usuarios
         *
         **/
        if ($_SESSION['tipo_usuario']=='S'){
            echo "<a href='../control_usuarios/control_usuarios.php' class='icon-GesUsuarios'>Gestión de Usuarios</a>";
        }
        ?>
        <a href='../control_usuarios/cambio_clave.php' class='icon-cambiarClave'>Cambiar Contraseña</a>
        <a href="../../login/cerrar_sesion.php" class="icon-CerrarSesion">Cerrar Sesión</a>

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