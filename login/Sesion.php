<?php
namespace  login;
require_once dirname(__FILE__).'/../clases_generales/Sql.php';
use clases_generales\Sql as Conexion;

	class Sesion {
		public $id_usuario = NULL;
		public $login = NULL;
		public $cedula_usuario = NULL;
		public $nombre_usuario = NULL;
		public $apellido_usuario = NULL;
		public $tipo_usuario = NULL;
		
		function __construct()
		{
			session_start();
			
			if($this->sesion_iniciada()==true)
			{
				$this->setId_usuario($_SESSION["id_usuario"]);
				$this->setLogin($_SESSION["login"]);
				$this->setCedula_usuario($_SESSION["cedula_usuario"]);
				$this->setNombre_usuario($_SESSION["nombre_usuario"]);
				$this->setApellido_usuario($_SESSION["apellido_usuario"]);
				$this->setTipo_usuario($_SESSION["tipo_usuario"]);
			}
			return true;
		}
		
		function sesion_iniciada()
		{
			if(!empty($_SESSION["id_usuario"]))
				return true;
			else
				return false;
		}
		
		function crear_sesion($login,$password)
		{


			$clsSql = new Conexion();
			//$sql="SELECT * FROM usuarios WHERE baneado=0 AND intentos_fallidos<=10 AND login=? AND password=SHA1(?) ";
			$sql="SELECT * FROM usuarios WHERE login=? AND password=md5(?) ";
				try{
					$clsSql->abrir_conexion();
			
					$result = $clsSql->consulta_preparada($sql, array($login,$password));
			
					if ($info=$clsSql->obtener_fila_consulta($clsSql->pdo_statement,Conexion::ARRAY_ASOCIATIVO) )
					{
						$this->setId_usuario($info["id_usuario"]);
						$this->setLogin($info["login"]);
						$this->setCedula_usuario($info["cedula_usuario"]);
						$this->setNombre_usuario($info["nombre_usuario"]);
						$this->setApellido_usuario($info["apellido_usuario"]);
						$this->setTipo_usuario($info["tipo_usuario"]);
						
					//	$sql="UPDATE usuarios set intentos_fallidos=0 where id_usuario=".$info["id_usuario"];
						//$clsSql->consulta_bd($sql);
						//$clsSql->cerrar_conexion();
						return true;
					}
					else{
						return false;
					}
				}
				catch (Exception $e)
				{
					echo $e->getMessage();
				}
		}
		
		function destruir_sesion()
		{
			$this->setId_usuario(NULL);
			$this->setLogin(NULL);
			$this->setCedula_usuario(NULL);
			$this->setNombre_usuario(NULL);
			$this->setApellido_usuario(NULL);
			$this->setTipo_usuario(NULL);
			return session_destroy();
		}
		
		function __toString()
		{
			return $this->getId_usuario()." ".$this->getLogin()." ".$this->getCedula_usuario()." ".$this->getNombre_usuario()." ".$this->getApellido_usuario()." ".$this->getTipo_usuario();
		}
	
		public function getId_usuario()
		{
		    return $this->id_usuario;
		}

		public function setId_usuario($id_usuario)
		{
			$_SESSION["id_usuario"] = $id_usuario;
		    $this->id_usuario = $id_usuario;
		}

		public function getCedula_usuario()
		{
		    return $this->cedula_usuario;
		}

		public function setCedula_usuario($cedula_usuario)
		{
			$_SESSION["cedula_usuario"] = $cedula_usuario;
			return $this->cedula_usuario = $cedula_usuario;
		}

		public function getNombre_usuario()
		{
		    return $this->nombre_usuario;
		}

		public function setNombre_usuario($nombre_usuario)
		{
			$_SESSION["nombre_usuario"] = $nombre_usuario;
		    $this->nombre_usuario = $nombre_usuario;
		}

		public function getApellido_usuario()
		{
		    return $this->apellido_usuario;
		}

		public function setApellido_usuario($apellido_usuario)
		{
			$_SESSION["apellido_usuario"] = $apellido_usuario;
		    $this->apellido_usuario = $apellido_usuario;
		}

		public function getLogin()
		{
			return $this->login;
		}
		
		public function setLogin($tipo_usuario)
		{
			$_SESSION["login"] = $tipo_usuario;
			$this->login = $tipo_usuario;
		}
		
		public function getTipo_usuario()
		{
		    return $this->tipo_usuario;
		}

		public function setTipo_usuario($tipo_usuario)
		{
			$_SESSION["tipo_usuario"] = $tipo_usuario;
		    $this->tipo_usuario = $tipo_usuario;
		}
}