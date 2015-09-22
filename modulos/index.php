

<?php

use login\Sesion;

require_once '../login/Sesion.php';
$sesion = new Sesion();


if($sesion->sesion_iniciada()==false)
    header("Location: ../index.php");

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
    <script src="http://rec.vtelca.gob.ve/jquery/2.1.1/jquery.js"></script>

    <script src="http://rec.vtelca.gob.ve/bootstrap-switch/master/js/bootstrap-switch.min.js"></script>
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap-switch/master/css/bootstrap3/bootstrap-switch.min.css">
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap-switch/master/css/bootstrap2/bootstrap-switch.min.css">

    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="http://rec.vtelca.gob.ve/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="http://rec.vtelca.gob.ve/bootstrap-select/1.6.0/dist/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap-select/1.6.0/dist/css/bootstrap-select.min.css">

    <link rel="stylesheet" type="text/css" href="../js/dataTables/media/css/jquery.dataTables.css">

    <script src="../js/dataTables/media/js/jquery.dataTables.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Orbitron:500,700,900,400' rel='stylesheet' type='text/css'>

    <script type="text/javascript" src="../js/foundation/js/foundation.min.js"></script>
    <link rel="stylesheet" href="../js/foundation/css/foundation.css">
    <link rel="stylesheet" href="../js/foundation/css/foundation.min.css">

    <link rel="stylesheet" type="text/css" href="../css/pnotify.custom.min.css">
    <script type="text/javascript" src="../js/pnotify.custom.min.js"></script>


    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/reveal/1.0/reveal.css">

    <script src="http://rec.vtelca.gob.ve/reveal/1.0/jquery.reveal.js"></script>

    <script src="http://rec.vtelca.gob.ve/jplayer/2.6.0/jquery.jplayer.min.js"></script>
    <script src="http://rec.vtelca.gob.ve/jplayer/2.6.0/add-on/jplayer.playlist.min.js"></script>
    <script src="http://rec.vtelca.gob.ve/jplayer/2.6.0/add-on/jquery.jplayer.inspector.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../css/component.css" />


    <link rel="stylesheet" type="text/css" href="../plugins/parallaxSlide/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../plugins/parallaxSlide/css/style2.css" />
    <script type="text/javascript" src="../plugins/parallaxSlide/js/modernizr.custom.28468.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Economica:700,400italic' rel='stylesheet' type='text/css'>
    <noscript>
        <link rel="stylesheet" type="text/css" href="../plugins/parallaxSlide/css/nojs.css" />
    </noscript>
    <script src="../js/modernizr.custom.25376.js"></script>

    <style type="text/css">
        .container{
            width: 90%;

        }
        html{
            position: fixed;
        }

        body{
            /* background-image: url("http://rec.vtelca.gob.ve/img/fondo-claro.png");*/
            background: transparent url(../img/back1-blur.jpg) center fixed no-repeat;

            background-attachment: fixed;
            overflow: scroll;
            background-repeat:no-repeat;
            background-size:cover;
            opacity: 0.9;
        }
        header {


            height: 80px;
            background: url(http://rec.vtelca.gob.ve/img/cintillo-movilnet.png) left no-repeat,
            url(http://rec.vtelca.gob.ve/img/vtelca-transparente.png) center no-repeat,
            url(http://rec.vtelca.gob.ve/img/pueblo-victorioso.jpg) right no-repeat;
            background-color: #fff;
            background-size: auto 40px;
            margin: 0px;
            margin-top: -10px;
            border-bottom: 4px solid #f00;
        }

        #imagenFlotante a img { border: none; }



    </style>



    <script>
        $(document).ready(function () {
            $("#perspective").hide();

            setInterval(function(){
                $("#perspective").fadeIn(500);
            }, 0);
        });
        <?php
            if (!isset($_SESSION["id_usuario"])) {
             //   print "parent.location.replace('../../index.php');";
            }
        ?>
    </script>

    <title>Administrar Servidor DHCP</title>
</head>
<header>

    <script>

    </script>
</header>
<body>




<div id="perspective" class="perspective full effect-airbnb" style="overflow-y: inherit;">

    <a class="glyphicon glyphicon-tasks" id="showMenu" style="text-decoration: none; position: fixed;font-size: xx-large; padding-left: 95%; padding-top: 8%; color: aliceblue;" ></a>

            <?php
              echo "<div style='text-align: right;color: aliceblue'><span class='glyphicon glyphicon-user'>&nbsp;</span><h2  style='font-size: large;float: right;color: aliceblue;margin-right: 1%;'>". $_SESSION["nombre_usuario"]." ".$_SESSION["apellido_usuario"]."</h2></div>";
            ?>
    <div id="" class="container" style="-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px; /*background-color: silver;*/">
        <div class="wrapper" style="top: 23px;height: 100%;">

            <div class="fluid">
                <div class="row-fluid">
                    <div style="width:auto;" class="" id="" align="center" >
                        <div class="codrops-top">

                            <div id="da-slider" class="da-slider" style="border-radius: 70px;">
                                <div style="top: 10%" class="da-slide">
                                    <h2>Gestionar Administrar Servidor DHCP</h2>
                                    <p>Esta Aplicacion te Permite administrar el Servidor DHCP... </p>
                                    <!--a href="#" class="da-link">Read more</a-->
                                    <div class="da-img"><img src="http://rec.vtelca.gob.ve/img/hecho-en-socialismo.png" alt="image01" /></div>
                                </div>
                                <div  style="top: 10%" class="da-slide">
                                    <h2>Gestionar IP's</h2>
                                    <p>Módulo para consulta y registro de HOSTS (ip's)</p>
                                    <a href="control_ip/control_ip.php" class="da-link">Ir al Modulo</a>
                                    <div class="da-img"><img src="../img/Setser.png" alt="Administrar Hosts" /></div>
                                </div>
                                <div style="top: 10%" class="da-slide">
                                    <h2>Gestionar Redes</h2>
                                    <p>Módulo de gestión de Redes..</p>
                                    <a href="control_red/control_red.php" class="da-link">Ir&nbsp;al&nbsp;Modulo</a>
                                    <div class="da-img"><img src="../img/agregarpc.png" alt="Registrar Pc's" /></div>
                                </div>
                                <div style="top: 10%" class="da-slide">
                                    <h2>Agregar Contenidos</h2>
                                    <p>Módulo para agregar, modificar, visualizar y eliminar los diferentes videos</p>
                                    <a href="./control_archivos/control_archivos.php" class="da-link">Ir&nbsp;al&nbsp;Modulo</a>
                                    <div class="da-img"><img src="../img/agregarContenido.png" alt="Agregar Contenidos" /></div>
                                </div>
                                <nav class="da-arrows">
                                    <span class="da-arrows-prev"></span>
                                    <span class="da-arrows-next"></span>
                                </nav>
                            </div>
                        </div>
                        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
                        <script type="text/javascript" src="../plugins/parallaxSlide/js/jquery.cslider.js"></script>
                        <script type="text/javascript">
                            $(function() {

                                $('#da-slider').cslider({
                                    autoplay	: true,
                                    bgincrement	: 450
                                });

                            });
                        </script>
                    </div>
                </div>
            </div>


        </div><!-- wrapper -->
    </div><!-- /container -->
    <nav class="outer-nav left vertical" style=" font-family: 'Lato', Calibri, Arial, sans-serif; font-size: xx-large;">
        <a href="index.php" class="icon-home">Inicio</a>
        <a href="control_ip/control_ip.php"  class="icon-programar">Programar Contenidos</a>
        <a href="control_red/control_equipos.php" class="icon-RegPc">Registrar PC's</a>
        <a href="./control_archivos/control_archivos.php" class="icon-RegCont">Agregar Contenido</a>
        <?php
            if ($_SESSION['tipo_usuario']=='S'){
                echo "<a href='./control_usuarios/control_usuarios.php' class='icon-GesUsuarios'>Gestión de Usuarios</a>";
            }
        ?>
        <a href='./control_usuarios/cambio_clave.php' class='icon-cambiarClave'>Cambiar Contraseña</a>
        <a href="./../login/cerrar_sesion.php" class="icon-CerrarSesion">Cerrar Sesión</a>

    </nav>

</div><!-- /perspective -->
<script src="../js/classie.js"></script>
<script src="../js/menu.js"></script>

</body>


</html>