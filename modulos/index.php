

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
    <link rel="stylesheet" href="../js/foundation/css/foundation.css">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../css/component.css" />
    <link rel="stylesheet" type="text/css" href="../plugins/parallaxSlide/css/style2.css" />
    <link rel="stylesheet" type="text/css" href="../css/estilos_personales.css" />
    <script src="../js/modernizr.custom.25376.js"></script>

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
    <style>
        a{
            color: #0000FF;
        }
    </style>

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

                            <div  id="da-slider" class="da-slider" style=" border-radius: 70px;">
                                <div style="top: 10%" class="da-slide">
                                    <h2 style="font-size: 280%;">Gestionar Administrar Servidor DHCP</h2>
                                    <p>Esta Aplicacion te Permite administrar el Servidor DHCP... </p>
                                    <!--a href="#" class="da-link">Read more</a-->
                                    <div class="da-img"><img src="http://rec.vtelca.gob.ve/img/hecho-en-socialismo.png" alt="image01" /></div>
                                </div>
                                <div  style="top: 10%" class="da-slide">
                                    <h2 style="font-size: 280%;">Gestionar IP's</h2>
                                    <p>Módulo para consulta y registro de HOSTS (ip's)</p>
                                    <a href="control_ip/control_ip.php" class="da-link">Ir al Modulo</a>
                                    <div class="da-img"><img src="../img/Setser.png" alt="Administrar Hosts" /></div>
                                </div>
                                <div style="top: 10%" class="da-slide">
                                    <h2 style="font-size: 280%;">Gestionar Redes</h2>
                                    <p>Módulo de gestión de Redes..</p>
                                    <a href="control_red/control_red.php" class="da-link">Ir&nbsp;al&nbsp;Modulo</a>
                                    <div class="da-img"><img src="../img/agregarpc.png" alt="Registrar Pc's" /></div>
                                </div>
                                <div style="top: 10%" class="da-slide">
                                    <h2 style="font-size: 280%;">Reportes Sarg</h2>
                                    <p>Módulo para consultar los reportes generados por Sarg, para el consumo del ancho de banda</p>
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
<script src="../js/classie.js"></script>
<script src="../js/menu.js"></script>

</body>


</html>