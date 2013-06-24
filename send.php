<?php
	require_once('config.php');

	$id = $_POST['id'];
	if(!is_numeric($id))
	{
		die('error');
	}

	$me =  unserialize($_SESSION['ME']);
	if(!is_a($me, 'Usuario'))
	{
		die('error');
	}

	$usuario = new Usuario();
	$usuario->getByID( $id );

	if(empty($usuario->id))
	{
		die('error');
	}

	$me->seguir( $usuario->id );
	die('done');

?>