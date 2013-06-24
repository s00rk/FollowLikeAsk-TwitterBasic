<?php
class Conexion
{
	var $con;

	function __construct()
	{
		//Datos de Conexion
		$host 			= 'localhost';
		$usuario	 	= 'root';
		$clave 			= '9876543210';
		$basededatos 	= 'seguir';

		// Ya no usaremos mysql, sino mysqli, mysql ya fue eliminado de las nuevas versiones de php asi que hay que acostumbrarse a este nuevo que trae muchos mas beneficios! :B

		$this->con = new mysqli($host, $usuario, $clave, $basededatos);
		if(mysqli_connect_error())
		{
			die('Error de Conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
		}
	}
}
	// Iniciamos las Sessiones
	@session_start();

	//Inlcuimos nuestras clases
	require_once('clases.php');

?>