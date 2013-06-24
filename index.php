<?php
	require_once('config.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Tutorial - Seguir</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

		<link rel="stylesheet" type="text/css" href="css/custom.css">
		
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>

	</head>
	<body>

		<?php
			// ID Sera el Identificador de la persona Logueada
			$me = null;
			if(!empty($_SESSION['ME']))
			{
				$me =  unserialize($_SESSION['ME']);
			}
			if(!is_a($me, 'Usuario'))
			{
				require_once('login.php');
			}else{
				require_once('seguir.php');
			}
		?>
		
	</body>
</html>