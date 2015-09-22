<?php
/**
 *
 * Archivo para Gestionar usuarios, crear y modicar usuarios,
 * Existen 2 tipo de usuarios "Administrador y Normal"
 * "El Usuario administrador tiene todos los privilegios al igual que el
 * usuario normal excepto poder gestionar usuarios(este modulo)
 *
 * @author Juan Romero  <jromero@vtelca.gob.ve>
 * @copyright 2015

 * @version 1
 *
 */



include ("../../../clases_generales/conexion.php");


$date = date('Y-m-d ');
$ejecuta = new conexion();


if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
} else {
    die("Ninguna accion ha sido a definida");
}


/**
 * dependiendo la $action recibido por post se ejecuta la accion,
 * si no se recibe nada por $REQUEST['action'] cancela la operacion de este archivo
 * y devuelve "Ninguna accion ha sido a definida"
 *
 *
**/
switch ($action){

    /**
     *  case $action == 'cambiarClave': --> si se cumple esta condicion, arma un sql y cambia la clave del usuario
     * del id_usuario
     * @var $acual = clave que tiene actualmente el usuario
     * @var $clave = clave nueva para establecer
     * @var $id_usuario = contiene el id del usuario en cuestion
     * @var $sql = contiene la la sentencia para aplicar a la BD
     * @return Objeto JSON
     *
     **/
    case $action == 'cambiarClave':


        $actual = md5($_REQUEST['actual']);
        $clave = md5($_REQUEST['password']);

        $id_usuario = $_REQUEST['id_usuario'];
        $sql = ("SELECT * from usuarios where id_usuario = '$id_usuario' and password= '$actual'");
        $rowcont=$ejecuta->numerodefilasAfectadas($sql,$action);
        if ( $rowcont>0){
            $sql1 = ("UPDATE usuarios  set password='$clave' WHERE id_usuario= '$id_usuario';");
            $sql= str_replace("''","null", $sql1);

            echo $ejecuta->ejecutar($sql,$action);
        }else{
            $result = array("respuesta"=>"claveInvalida","evento"=>$action,"row"=>"No conincide la contraseña Actual".$id_usuario);

            echo json_encode($result);
        }
        break;


    /**
     * case $action == 'guardarUsuario': --> si se cumple esta condicion, arma un sql y registra un usuario dependiendo
     * los parametros recibidos:
     *
     * @var $login = usuario del sistema para el logueo, se recibe por $_REQUEST['login']
     * @var $nombre = nombre del usuario , se recibe por $_REQUEST['nombre_usuario']
     * @var $apellido = apellido del usuario , se recibe por $_REQUEST['apellido_usuario']
     * @var $clave = clave del usuario para el logueo, recibido por $_REQUEST['password']
     * @var $tipo_usuario = define si el usuario es administrador o no, (true = S , FALSE = N ) recibido por $_REQUEST['tipo_usuario']
     * @var $sql = contiene la la sentencia para aplicar a la BD
     *
     * @return Objeto JSON
     *
     **/
    case $action == 'guardarUsuario':

        $login = $_REQUEST['login'];
        $nombre = strtoupper($_REQUEST['nombre_usuario']);
        $apellido = strtoupper($_REQUEST['apellido_usuario']);
        $cedula = $_REQUEST['cedula_usuario'];
        $clave = md5($_REQUEST['password']);
        $tipo_usuario = ($_REQUEST['tipo_usuario']=='true') ? "S":"N";

        $sql1 = ("INSERT INTO usuarios values ('','$login','$clave','$tipo_usuario','$cedula','$nombre','$apellido','0','0')");
        $sql= str_replace("''","null", $sql1);

        echo $ejecuta->ejecutar($sql,$action);
        break;
    /**
     * case $action == 'editarUsuario': --> si se cumple esta condicion, arma un sql y edita un usuario dependiendo
     * los parametros recibidos, especialmente el id_usuario
     *
     * @var $login = usuario del sistema para el logueo, se recibe por $_REQUEST['login']
     * @var $nombre = nombre del usuario , se recibe por $_REQUEST['nombre_usuario']
     * @var $apellido = apellido del usuario , se recibe por $_REQUEST['apellido_usuario']
     * @var $clave = clave del usuario para el logueo, recibido por $_REQUEST['password']
     * @var $tipo_usuario = define si el usuario es administrador o no, (true = S , FALSE = N ) recibido por $_REQUEST['tipo_usuario']
     * @var $sql = contiene la la sentencia para aplicar a la BD
     * @var $id_usuario = id del usuario para ser editado, recibido por $_REQUEST['id_usuario'];
     * @var $cedula = contiene la cedula del usuario recibido por $_REQUEST['cedula']
     *
     * @return Objeto JSON
     **/
    case $action == 'editarUsuario':
        $id_usuario = $_REQUEST['id_usuario'];
        $login = $_REQUEST['login'];
        $nombre = strtoupper($_REQUEST['nombre_usuario']);
        $apellido = strtoupper($_REQUEST['apellido_usuario']);
        $cedula = $_REQUEST['cedula_usuario'];
       // $clave = md5($_REQUEST['password']);
        $tipo_usuario = ($_REQUEST['tipo_usuario']=='true') ? "S":"N";

        $sql1 = ("UPDATE usuarios  set login='$login', tipo_usuario='$tipo_usuario',cedula_usuario='$cedula',nombre_usuario='$nombre',apellido_usuario='$apellido' WHERE id_usuario= '$id_usuario';");
        $sql= str_replace("''","null", $sql1);

        echo $ejecuta->ejecutar($sql,$action);
        break;

    /**
     * case $action == 'ResetClave': --> si se cumple esta condicion, arma un sql y resetea la clave de id_usuario
     * para que posteriormente el usuario resetee su clave desde el modulo cambiar clave
     *
     * @var $clave = clave del usuario para el logueo, se establece por defecto md5(123456), para que luego el usuario lo
     * @var $sql = contiene la la sentencia para aplicar a la BD
     * @var $id_usuario = id del usuario para ser editado, recibido por $_REQUEST['id_usuario'];
     *
     * @return Objeto JSON
     **/
    case $action == 'ResetClave':

        $id_usuario = (isset($_REQUEST['id_usuario'])) ? $_REQUEST['id_usuario'] : die("no se ha definido el Id de Usuario");
        $clave = md5("123456");
        $sql1 = ("UPDATE usuarios  set password='$clave' WHERE id_usuario= '$id_usuario';");
        $sql= str_replace("''","null", $sql1);

        echo $ejecuta->ejecutar($sql,$action);
        break;

    /**
     * case $action == 'obtenerUsuarios': --> si se cumple esta condicion, arma un sql para devolver un JSON con los
     * usuarios del sistema
     *
     *
     * @return Objeto JSON
     **/

    case $action == 'obtenerUsuarios':

        $sql1 = ("SELECT
                    id_usuario as id,
                    login as Login,
                    nombre_usuario as Nombre,
                    apellido_usuario as Apellido,
                    cedula_usuario as Cédula,
                    tipo_usuario as tipo

                          FROM  usuarios");
        $sql= str_replace("''","null", $sql1);

        echo $ejecuta->obtener($sql,$action);
        break;


    default :
        break;

}
?>