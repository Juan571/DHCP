<?php

use login\Sesion;

require_once '../../login/Sesion.php';
$sesion = new Sesion();


if($sesion->sesion_iniciada()==false)
    header("Location: ../../index.php");

//$info_ultima_sesion = "Ultima sesión iniciada el dia ".date("d-m-Y");

?>
<?php //if (!isset($_SESSION)){session_start();} ?>

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
    <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../../js/dataTables/TableTools-2.2.4/css/dataTables.tableTools.css">
    <script src="../../js/dataTables/media/js/jquery.dataTables.js"></script>
    <script src="../../js/dataTables/TableTools-2.2.4/js/dataTables.tableTools.js"></script>
    <script src="JS/funciones_auditorias.js"></script>
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
        $(document).ready(function () {

        });

        <?php
            if (!isset($_SESSION["usuario_id"])) {
             //   print "parent.location.replace('../../index.php');";
            }
        ?>
    </script>

    <title>Auditorias</title>
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
                        <input style="display: none" id="id_usuario" >

                        <h1 style="color: white;">Registro de Movimientos</h1>

                        <div class="col-md-12" style="margin-top: 3%">
                            <table id="tabla_auditorias" class="display" cellspacing="0"  style="min-height:2%;  font-size: inherit;text-align: center"></table>
                        </div>


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
            echo "<a href='auditorias.php.php' class='icon-auditoria'>Auditorías</a>";
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