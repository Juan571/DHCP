<?php

include ("../../../clases_generales/conexion.php");

/**
 *
 * Archivo para Gestionar los PC's donde se visualizarán los videos (CRUD)
 *
 *
 * @author Juan Romero  <jromero@vtelca.gob.ve>
 * @copyright 2015
 * @version 1
 *
 * dependiendo la $action recibido por post se ejecuta la accion,
 * si no se recibe nada por $REQUEST['action'] cancela la operacion de este archivo
 * y devuelve "Ninguna accion ha sido a definida"
 *
 *
 **/

$date = date('Y-m-d ');

if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
} else {
    die("Ninguna accion ha sido a definida");
}

$ejecuta  = new conexion();

switch ($action){

    /**
     * case $action == 'guardarPC': --> si se cumple esta condicion, arma un sql, y guarda un pc dependiendo los
     * parametros recibidos
     *
     * @var $ippc = contiene la ip de la pc recibido por $_REQUEST['ip_pc'];
     * @var $despc = descripcion de la pc, recibido por  $_REQUEST['descripcion_pc'];
     *
     * @return Objeto JSON
     *
     **/
    case $action == 'guardarPC':
        if(isset($_REQUEST['ip_pc'])){
            $ippc = $_REQUEST['ip_pc'];
        } else {
            die("no se define la ip de la pc");
        }
        if(isset($_REQUEST['descripcion_pc'])){
            $despc = $_REQUEST['descripcion_pc'];
        } else {
            die("no se define la descripcion de la pc");
        }
        $sql1 = ("INSERT INTO pcs values ('','$ippc','$despc','1')");
        $sql= str_replace("''","null", $sql1);

        echo $ejecuta->ejecutar($sql,$action);
        break;

    /**
     * case $action == 'editarPC': --> si se cumple esta condicion, arma un sql, y edita un pc dependiendo los
     * parametros recibidos
     *
     * @var $idpc = contiene la id de la pc para ser editado
     * @var $ippc = contiene la ip de la pc recibido por $_REQUEST['ip_pc'];
     * @var $despc = descripcion de la pc, recibido por  $_REQUEST['descripcion_pc'];
     *
     * @return Objeto JSON
     *
     **/
    case $action == 'editarPC':
        if(isset($_REQUEST['ip_pc'])){
            $ippc = $_REQUEST['ip_pc'];
        } else {
            die("no se define la ip de la pc");
        }
        if(isset($_REQUEST['descripcion_pc'])){
            $despc = $_REQUEST['descripcion_pc'];
        } else {
            die("no se define la descripcion de la pc");
        }
        if(isset($_REQUEST['id_pc'])){
            $idpc = $_REQUEST['id_pc'];
        } else {
            die("no se define la descripcion de la pc");
        }
        $despc=strtoupper($despc);
        $sql1 = ("UPDATE pcs set ip_pc = '$ippc',descripcion_pc_multimedia='$despc' where id_pc='$idpc'");
        $sql= str_replace("''","null", $sql1);

        echo $ejecuta->ejecutar($sql,$action);
        break;

    /**
     * case $action == 'obtenerPCS': --> si se cumple esta condicion, arma un sql para devolver un JSON con los
     * PC's registrados del sistema
     *
     * @return Objeto JSON
     **/
    case $action == 'obtenerPCS':

        $sql1 = ("SELECT id_pc,
                           descripcion_pc_multimedia as Descripcion,
                           ip_pc as IP,
                           activo FROM  pcs");
        $sql= str_replace("''","null", $sql1);

        echo $ejecuta->obtener($sql,$action);
        break;


    default :
        break;

}
?>