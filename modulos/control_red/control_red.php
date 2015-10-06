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
    <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/css/jquery.dataTables.css">
    <script src="../../js/dataTables/media/js/jquery.dataTables.js"></script>

    <script type="text/javascript" src="./JS/funciones_control_red.js"></script>
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


    <title>Control de Equipos</title>
</head>
<header>
    <script>

    </script>
</header>
<body>



    <?php
    echo "<div style='text-align:right;color: aliceblue'><span class='glyphicon glyphicon-user'>&nbsp;</span><h2  style='font-size: large;float: right;color: aliceblue;margin-right: 1%;'>". $_SESSION["nombre_usuario"]." ".$_SESSION["apellido_usuario"]."</h2></div>";
    ?>
<div id="perspective" class="perspective full effect-airbnb" style="overflow-y: inherit;">
    <a class="glyphicon glyphicon-tasks" id="showMenu" style="text-decoration: none; position: fixed;font-size: xx-large; padding-left: 95%; padding-top: 8%; color: aliceblue;" ></a>
    <div id="" class="container" style="-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; /*background-color: silver;*/">
        <div class="wrapper" style="top: 23px;height: 1px;">

            <div class="fluid">
                <div class="row-fluid">
                    <div style="width:auto;/*background-color: #c0c0c0*/" class="" id="" align="center" >

                        <form id="form1" name="formulario" enctype="application/x-www-form-urlencoded">

                            <fieldset style="border: none" >
                                <div style="text-align: left;height:45%;" class="" align="center">
                        <input style="display: none" name=="id_red" id="id_red" >
                                    <h2 style="color: white; ">Gestion de Redes</h2>
                                        <span class="col-md-4">
                                           <b style="color: white;">IP de RED</b>
                                           <input  style='text-transform:uppercase;width: 80%' name="ip_red" type="text" id="ip_red" class="ip form-control" value="" size="12" placeholder="Ej: 192.168.100.92" >
                                        </span>
                                        <span class="col-md-4">
                                           <b style="color: white;">Mascara de RED</b>
                                           <input  style='text-transform:uppercase;width: 80%' name="mask" type="text" id="mask" class="ip form-control" value="" size="12" placeholder="Ej: 255.255.255.0" >
                                        </span>
                                        <span class="col-md-4">
                                           <b style="color: white;">Descripción de la Subnet</b>
                                           <input  style='text-transform:uppercase;width: 80%' name="descripcionSubnet" type="text" id="descripcionSubnet" class="form-control" value="" size="12" placeholder="Ej: Subnet LAN PRODUCCION" >
                                        </span>
                                        <span class="col-md-4">
                                           <b style="color: white;">Puerta de Enlace (Option Router)</b>
                                           <input  style='text-transform:uppercase;width: 80%' name="gateway" type="text" id="gateway" class="ip form-control" value="" size="12" placeholder="Ej: 192.168.100.91" >
                                        </span>
                                        <span class="col-md-4">
                                            <b style="color: white;">Rango Minimo IP (opcional)</b>
                                            <input  style='text-transform:uppercase;width: 80%' name="rangemin" type="text" id="rangemin" class="ip form-control" value="" size="12" placeholder="Ej: 192.168.100.1 " >
                                        </span>
                                        <span class="col-md-4">
                                            <b style="color: white;">Rango Maximo IP (opcional)</b>
                                            <input  style='text-transform:uppercase;width: 80%' name="rangemax" type="text" id="rangemax" class="ip form-control" value="" size="12" placeholder="Ej: 192.168.100.254 " >
                                        </span>

                                        <span class="col-md-12" style="text-align: center;">
                                            <div style="margin-top: 2%">
                                                <input style="display:none;width: 9%;" class="btn btn-warning submit" type="submit" id="btneditarRED" value="EDITAR">
                                                <input class="btn btn-info submit"  id="guardar" type="submit" value="GUARDAR">
                                                <input type="reset" value="LIMPIAR " title="Limpiar Campos" id="botonlimpiar" class="btn botonlimpiar btn-danger">
                                            </div>
                                        </span>
                                </div>
                            </fieldset>
                        </form>
                        <h3 style="color: white;">Redes Registradas</h3>
                        <div class="col-md-12" style="margin-top: -3%">
                            <table id="tabla_redes" class="display" cellspacing="0"  style="min-height:2%;  font-size: inherit;text-align: center"></table>
                        </div>
                    </div>
                </div>
            </div>


        </div><!-- wrapper -->
    </div><!-- /container -->
    <nav class="outer-nav left vertical">
        <a href="../index.php" class="icon-home">Inicio</a>
        <a href="control_red.php"  class="icon-programar">Gestionar Redes</a>
        <a href="../control_ip/control_ip.php" class="icon-RegPc">Gestionar IP's</a>
        <!--a href="../control_archivos/control_archivos.php" class="icon-RegCont">Agregar Contenido</a-->
        <?php
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


</html>