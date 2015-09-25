
<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>SYSADMIN</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="http://rec.vtelca.gob.ve/img/favicon.ico" />
    <script src="http://rec.vtelca.gob.ve/jquery/2.1.1/jquery.min.js"></script>



    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://rec.vtelca.gob.ve/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="http://rec.vtelca.gob.ve/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/estilos_personalizados.css" type="text/css" media="screen">



    <style>
        body {
            background-color: #f5f5f5;
            background: #f5f5f5 url(img/madera.jpg) center fixed no-repeat;
        }



        header {

            height: 80px;
            background: url(http://rec.vtelca.gob.ve/img/cintillo-movilnet.png) left no-repeat,
            url(http://rec.vtelca.gob.ve/img/vtelca-transparente.png) center no-repeat,
            url(http://rec.vtelca.gob.ve/img/pueblo-victorioso.jpg) right no-repeat;
            background-color: #fff;
            background-size: auto 40px;
            margin: 0px;
            border-bottom: 4px solid #f00;
        }
        footer {
            position: absolute;
            bottom: 0;
            left: 0;
            text-align: center;
            width: 100%;
            border-top: 1px solid #f00;
            height: 21px;
            line-height: 20px;
            background-color: #fff;
            font-size: 12px;
        }
        #objMain {
            position: absolute;
            border: 0;
            width: 100%;
            height: calc(100% - 143px);
            background: #fff url(http://rec.vtelca.gob.ve/img/fondo-claro.png) center no-repeat;
            background-size: cover;
        }

    </style>
</head>
<body>
<!-- HEADER -->
<header>

    <script>
        $(document).ready(function () {

            $("#txtCedula").focus();
        });
    </script>
</header>
<div id="full" class="container">
    <h1 style="color: #fdfdfd; text-align:center">ADMINISTRAR DHCP</h1>
    <br>
    <form class="form-signin" action="login/iniciar_sesion.php" method="post">
        <input type="hidden" name="accion" value="iniciarSesion">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default"  style="margin: 35px;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-lock"></span> Acceso de Usuario</h3>
                    </div>
                    <div class="panel-body" >
                        <div class="row">
                            <div class="col-md-12">Usuario:</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="txtCedula" name="usuario">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">Contraseña:</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="password" class="form-control" id="txtClave" name="clave">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-danger" style="width: 100%" id="btnEnviar" name="btnEnviar" value="Ingresar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </form>
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <?php if (isset($_GET["error"]) && $_GET["error"] == 1) { ?>
            <div class="col-md-4 alert alert-danger" style="text-align:center">
                <span class="glyphicon glyphicon-warning-sign"></span>
                El Usuario y la Contraseña no coninciden..
            </div>
        <?php } ?>
        <div class="col-md-4"></div>
    </div>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12 pie_pagina" style="text-align: right; padding: 3px 15px 3px 5px;">
            © Copyleft - Venezolana de Telecomunicaciones 2015
        </div>
    </div>
</div>
