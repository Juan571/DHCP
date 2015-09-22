<?php
namespace login;
require_once 'Sesion.php';


$sesion = new Sesion();
try{
	if($sesion->sesion_iniciada()==true)
		$sesion->destruir_sesion();
	
		header("Location: ../index.php");

}catch (Exception $e){
	echo $e->getMessage();
}