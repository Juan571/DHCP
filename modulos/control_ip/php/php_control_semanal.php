<?php

include ("../../../clases_generales/conexion.php");


/**
 *
 * Archivo para gestionar la programación semanal,   (CRUD)
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

    $ejecuta = new conexion();

    
    if(isset($_REQUEST['action'])){
	$action = $_REQUEST['action'];
    } else {
	die("Ninguna accion ha sido a definida");
    }

    switch ($action){

        /**
         * case $action == 'programacion_semanal': --> si se cumple esta condicion, arma un sql, y genera un JSON de
         * toda la programacion semanal de la pc con el idpc =$_REQUEST['idpc']
         *
         * @var $idpc = contiene la id de la pc para ser consultada la programación
         *
         * @return Objeto JSON
         *
         **/
        case $action == 'programacion_semanal':
            if(isset($_REQUEST['idpc'])){
                $idpc = $_REQUEST['idpc'];
            } else {
                $idpc = 0;
            }

            $sql1 = ("SELECT * FROM  programacion_semanal where pc_id = $idpc GROUP BY hora");
            $sql= str_replace("''","null", $sql1);

            echo $ejecuta->obtener($sql,$action);
            break;

        /**
         * case $action == 'obtenerPCS': --> si se cumple esta condicion, arma un sql, y genera un JSON de
         * toda los equipos registrados
         *
         * @return Objeto JSON
         *
         **/
        case $action == 'obtenerPCS':

                $sql1 = ("SELECT * FROM  pcs");
                $sql= str_replace("''","null", $sql1);

                echo $ejecuta->obtener($sql,$action);
                break;
        /**
         * case $action == 'obtenerArchivos': --> si se cumple esta condicion, arma un sql, y genera un JSON de
         * toda los archivos registrados
         *
         * @return Objeto JSON
         *
         **/
        case $action == 'obtenerArchivos':

            $sql1 = ("SELECT * FROM  archivos_multimedia");
            $sql= str_replace("''","null", $sql1);

            echo $ejecuta->obtener($sql,$action);
            break;

        /**
         * case $action == 'guardarProgramacion': --> si se cumple esta condicion, arma un sql, y guarda la programacion dependiendo los
         * parametros recibidos de la id_pc
         *
         * este archivo recibe un array con toda la programacion del equipo, es recorrido y dicha programacion existe la edita , de lo
         * contrario la inserta, se realiza por medio de una transaccion, en aras de que si existe un error al momento de registrar una
         * programacion, se haga un rollback , de lo contrario si esta todo bien, se re realiza un commit
         *
         * @var $ippc = contiene la ip de la pc recibido por $_REQUEST['ip_pc'];
         * @var $data = contiene el arraty generado desde el javascript en la vista
         *
         * @return Objeto JSON
         *
         **/
        case $action == 'guardarProgramacion':

            if(isset($_REQUEST['data'])){
                $data = $_REQUEST['data'];
            } else {
                $data = "";
            }
            if(isset($_REQUEST['idpc'])){
                $idpc = $_REQUEST['idpc'];
            } else {
                $idpc = "";
            }
            try {
                // First of all, let's begin a transaction
                $ejecuta->beginTransaction();

                foreach ($data as $valor=> $td) {

                    $sql = "SELECT * from programacion_semanal where hora = '$td[6]' and pc_id = '$idpc' ";
                    $reg= $ejecuta->numerodefilasAfectadas($sql,$action);
                    if ($reg==0){
                        $sql = "INSERT INTO  programacion_semanal values (null,'$td[0]','$td[1]','$td[2]','$td[3]','$td[4]','0','0','$idpc','$td[5]','$td[6]','$td[7]');";
                    }else{
                        $sql = "UPDATE programacion_semanal SET lunes='$td[0]',martes='$td[1]',miercoles='$td[2]',jueves='$td[3]',viernes='$td[4]',archivo_multimedia_id='$td[5]',activo='$td[7]'  WHERE hora='$td[6]' and pc_id='$idpc';";
                    }
                    $ejecuta->ejecutar($sql,$action);
                }
                if ($sql==null){
                    throw new Exception("Error");
                }
                $ejecuta->commit();
                $result = array("respuesta"=>"Registrado","evento"=>$action,"sql"=>$sql."->".$reg);

            } catch (Exception $e) {
                $ejecuta->rollBack();
                $result = array("respuesta"=>"Error","evento"=>"guardarProgramacion");
            }
            echo json_encode($result);
            break;


                break;
	default :
                break;
        
    }
    ?>