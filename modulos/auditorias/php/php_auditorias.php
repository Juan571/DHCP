<?php

include ("../../../clases_generales/conexion.php");


$date = date('Y-m-d ');
$ejecuta = new conexion();


if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
} else {
    die("Ninguna accion ha sido a definida");
}

switch ($action){



    case $action == 'obtenerAuditorias':
        $sql1 = ("SELECT
                        id as ID ,
                        CONCAT(usuarios.nombre_usuario,' ',usuarios.apellido_usuario) as USUARIO,
                        accion as OPERACIÓN,
                        descripcion as DESCRIPCIÓN,
                        fecha as FECHA,
                        ip_origen as IP
                        FROM  auditoria
                        join usuarios on (usuario_id = usuarios.id_usuario)
                        ORDER BY FECHA DESC ");
        //die($sql1);

        $sql= str_replace("''","null", $sql1);

        echo $ejecuta->obtener($sql,$action);
        break;




    default :
        break;

}
?>