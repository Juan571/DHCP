<?php
namespace login;
/**
 *
 * Este archivo crea la sesion, si resulta extiosa te redirecciona a modulos/index.php
 * si no, te redirige al index home del sistema pero enviando por get error=1, para validar el mensaje en la vista
 *
 * @author Juan Romero  <jromero@vtelca.gob.ve>
 * @copyright 2015

 * @version 1
 */
/**
 * @var string $usuario : Contiene el usuario recibido por post desd el formulario
 * @var string $usuario : Contiene el clave recibida por post desd el formulario
 */

require_once 'Sesion.php';

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

$sesion = new Sesion();

try{

$sesion->crear_sesion($usuario, $clave);
	//Wecho $sesion;
	if($sesion->sesion_iniciada()==true)

		header("Location: ../modulos/index.php");
	else
		header("Location: ../index.php?error=1");

}catch (Exception $e){
	echo $e->getMessage();

}