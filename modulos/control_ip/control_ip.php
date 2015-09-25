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

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="http://rec.vtelca.gob.ve/img/favicon.ico" />
    <script src="http://rec.vtelca.gob.ve/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://rec.vtelca.gob.ve/jquery/2.1.1/jquery.js"></script>
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="http://rec.vtelca.gob.ve/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../js/dataTables/media/css/jquery.dataTables.css">
    <script src="../../js/dataTables/media/js/jquery.dataTables.js"></script>
    <script src="JS/funciones_control_ip.js"></script>
    <script type="text/javascript" src="../../js/foundation/js/foundation.min.js"></script>
    <link rel="stylesheet" href="../../js/foundation/css/foundation.css">
    <link rel="stylesheet" href="../../js/foundation/css/foundation.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/pnotify.custom.min.css">
    <script type="text/javascript" src="../../js/pnotify.custom.min.js"></script>
    <script type="text/javascript" src="../../js/tablas.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../../css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../../css/component.css" />
    <script src="../../js/jquery.validate.js"></script>
    <script src="../../js/jquery.mask.min.js"></script>
    <script src="../../js/morris-0.4.1.min.js"></script>
    <script src="../../js/raphael-min.js"></script>
    <script src="../../js/modernizr.custom.25376.js"></script>

    <style type="text/css">
        .container{
            width: 90%;
        }
        html{
            position: fixed;
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

        #mac_ip-error  {
            color: #c00000;
        }
        #nombre_ip-error  {
            color: #c00000;
        }
        #descripcion_ip-error{
            color: #c00000;
        }
        #ip-error{
            color: #c00000;
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

        .horas{
            font-family: 'BebasNeueRegular';

        }
        .btnmarcar1{

            position: absolute;
            margin-left: 66px%;


        }
        .redText { color: red; }
       /* html,body { height: 100%;  }*/
        .full1 {
            background: transparent url(../../img/back1-blur.jpg) center fixed no-repeat;

            background-attachment: fixed;
            overflow: auto;

        }
        #imagenFlotante {
            bottom:10px;
            right:0px;
            position: fixed;
            _position:absolute;
            clip:inherit;
            _top:expression(document.documentElement.scrollTop+document.documentElement.clientHeight-this.clientHeight);
            _right:expression(document.documentElement.scrollLeft+ document.documentElement.clientWidth - offsetWidth);
        }
        #imagenFlotante a img { border: none; }

        #showMenu:hover{
            color: red;
        }
        input[type="search"]{
            float: right;
            text-align: center;
            height: 15px;
        }
        .estadisticasred{
            color: #c00000;

        }
        #donut-articulos, #donut-usuarios {
            min-height: 200px;
            margin-left: 21%;
        }
        ul{
            box-shadow: 1px 2px 2px 2px rgba(0,0,0,0.4);
        }
        .list-group-item, .panel {
            background-color: rgba(255, 247, 255, 0.4);
        }
        .step_menu1 {
            z-index: 1000;
            float: left;
            width: 100%;
            min-width: auto;
            max-width: auto;
            _width: 160px;
            padding: 4px 0;
            margin: 0px 0px 0px 0px;
            list-style: none;
            background-color: rgba(255,255,255,0.8);
        }

        .step_menu1 a {
            display: block;
            padding: 5px 15px;
            clear: both;
            font-weight: bold;
            font-size: 12px;
            line-height: 18px;
            color: #333;
            white-space: nowrap;
        }

        .step_menu1 li {
            text-align: center;
            padding: 4px 0;
            font-size: 1px;
            font-family: Arial, Helvetica, sans-serif;
            font-style: normal;
            line-height: 18px;
            background: rgba(255,255,255,0.8);
            -moz-transition: all 0.26s ease-out;
            -o-transition: all 0.26s ease-out;
            -webkit-transition: all 0.26s ease-out;
            -ms-transition: all 0.26s ease-out;
        }

        /* Giving border to even LI */
        .step_menu1 li:nth-child(even) {
            background: rgba(255,255,255,0.4);
            border: solid #CCC;
            border-width: 0 1px 1px 0;
        }

        /* Hover Action Here */
        .step_menu1 li:hover {
            -moz-box-shadow: 1px 1px #CCC, 2px 2px #CCC, 3px 3px #CCC, 4px 4px #CCC,
            5px 5px #CCC, 6px 6px #CCC, 7px 7px #CCC, 8px 8px #CCC;
            -webkit-box-shadow: 1px 1px #CCC, 2px 2px #CCC, 3px 3px #CCC, 4px 4px
            #CCC, 5px 5px #CCC, 6px 6px #CCC, 7px 7px #CCC, 8px 8px #CCC;
            box-shadow: 1px 1px #CCC, 2px 2px #CCC, 3px 3px #CCC, 4px 4px #CCC, 5px
            5px #CCC, 6px 6px #CCC, 7px 7px #CCC, 8px 8px #CCC;
            -webkit-transform: translate(-10px, -10px);
            -moz-transform: translate(-10px, -10px);
            -o-transform: translate(-10px, -10px);
            -ms-transform: translate(-10px, -10px);
            text-decoration: none;
        }
        .ipslibrebadge{
            background-color: #B22222;
        }
        .ipslibrebadge:hover{
            background-color: #0000FF;
            font-size: large;
        }

    </style>



    <script>
        $(document).ready(function () {

            var res="";

            var delay = ( function() {
                var timer = 0;
                return function(callback, ms) {
                    clearTimeout (timer);
                    timer = setTimeout(callback, ms);
                };
            })();
        });
        <?php
            if (!isset($_SESSION["usuarioId"])) {
             //   print "parent.location.replace('../../index.php');";
            }
        ?>
    </script>

    <title>Gestion de IP's</title>
</head>
<header>
    <script>

    </script>
</header>
<body>



<div  id="perspective" class="perspective full effect-airbnb" style="overflow-y: inherit;">
    <a class="glyphicon glyphicon-tasks" id="showMenu" style="text-decoration: none; position: fixed;font-size: xx-large; padding-left: 94%; padding-top: 8%; color: aliceblue;" ></a>

        <div id="" class="container" >
            <div class="wrapper">

                <div class="fluid">
                    <div class="row-fluid">
                        <div class="span12" style="">
                            <h2 style="color: white">Seleccione el Segmento de la RED</h2>
                            <div class="col-md-8">
                                <select data-width="50%" data-live-search="true" id="comboSEGRED">
                                </select>
                            </div>
                            <div class="col-md-4" style="text-align: right;">
                                <a id="btnGuardarHost" class='btn btn-info btn-lg' onclick='GuardarHost()'><span class="glyphicon glyphicon-floppy-save" ></span>Nuevo Host</a>
                            </div>

                                <div class="col-md-8" style="text-align: right;">
                                    <div id ="rowTabla" class="row tabla" style="margin-top: 2%;max-width: 97%;">
                                        <div class="row">
                                            <div id="tabla_wrapper" class="dataTables_wrapper" role="grid">
                                                <div id="divSelectHeaders" style="margin-bottom: 2%; text-align: -webkit-center;"></div>
                                                <table id="tablaHosts"  class="display dataTable " cellspacing="0" width="100%" style="font-size:xx-small;"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="text-align: center;margin-top: 1%">
                                    <div style="width: 60%"  id="donut-articulos"></div>

                                        <div class="panel-heading">
                                            <h3 class="" style=" color: whitesmoke;height: 20px">Estadisticas de la Red</h3>
                                        </div>
                                        <ul  class="list-group step_menu1">
                                            <li class="list-group-item"><a>Total de Hosts<span class="badge"><strong id="numhosts"></strong></span></a></li>
                                            <li class="list-group-item"><a><span class="badge"><strong id="hostusados"></strong></span> Host Usados</a></li>
                                            <li class="list-group-item"><a><span class="badge"><strong id="hostlibres"></strong></span> Hosts Libres</a></li>
                                            <li class="list-group-item"><a><span class="badge"><strong id="gateway"></strong></span> Puerta de Enlace</a></li>
                                        </ul>

                                </div>
                        </div>
                        <div id="modalIpLibres" class="reveal-modal xlarge" style="max-width: 78%" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                            <h2 id="modalTitle">Ips Libres</h2>

                            <div id="ipslibresmodal">

                            </div>

                            <a class="close-reveal-modal" aria-label="Cerrar">&#215;</a>
                        </div>
                        <div id="modalEditarPc" class="reveal-modal " style="" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                            <h2 id="modalTitleIP">JUAN</h2>

                            <form id="form1" name="formulario" enctype="application/x-www-form-urlencoded">

                                <fieldset style="border: none" >
                                    <div style="text-align: left;height:45%;" class="" align="center">
                                        <input style="display: none" name="id_sel" id="id_sel" >
                                        <span class="col-md-6">
                                           <b style="">Nombre</b>
                                           <input  style='text-transform:uppercase;width: 80%' name="nombre_ip" type="text" id="nombre_ip" class="form-control" value="" size="12" placeholder="Ej: Fulanito Pérez"  onkeypress='solotexto(event)'>
                                        </span>
                                        <span class="col-md-6">
                                           <b style="">Descripción</b>
                                           <input  style='text-transform:uppercase;width: 80%' name="descripcion_ip" type="text" id="descripcion_ip" class="form-control" value="" size="12" placeholder="Ej: 255.255.255.0" >
                                        </span>
                                        <span class="col-md-6">
                                           <b style="">MAC</b>
                                           <input  style='text-transform:uppercase;width: 80%' name="mac_ip" type="text" id="mac_ip" class="form-control" value="" size="12" placeholder="Ej: 11:11:11:11:11:11" >
                                        </span>
                                        <span class="col-md-6">
                                           <b style="">IP</b>
                                           <input  style='text-transform:uppercase;width: 80%' name="ip" type="text" id="ip" class="ip form-control" value="" size="12" placeholder="Ej: 192.168.100.92" >
                                        </span>
                                        <span class="col-md-12" style="text-align: center;">
                                            <div style="">
                                                <input style="" class="btn btn-warning submit" type="submit" id="btneditarIP" value="EDITAR">
                                                <input class="btn btn-info submit"  id="guardar" type="submit" value="GUARDAR">
                                                <input type="reset" value="LIMPIAR " title="Limpiar Campos" id="botonlimpiar" class="btn botonlimpiar btn-danger">
                                            </div>
                                        </span>
                                    </div>
                                </fieldset>
                            </form>

                            <a class="close-reveal-modal" aria-label="Cerrar">&#215;</a>
                        </div>
                    </div>
                </div>
            </div><!-- wrapper -->
        </div><!-- /container -->
    <nav class="outer-nav left vertical">
        <a href="../index.php" class="icon-home">Inicio</a>
        <a href="../control_red/control_red.php"  class="icon-programar">Gestionar Redes</a>
        <a href="../control_ip/control_ip.php" class="icon-RegPc">Gestionar IP's</a>
        <a href="../control_archivos/control_archivos.php" class="icon-RegCont">Agregar Contenido</a>
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