<?php
	$err = '';
	if(!empty($_POST['email']))
	{
		$email = trim($_POST['email']);
		$contrasena = trim($_POST['contrasena']);

		// Nuevas Capcidades de PHP ;), No mas RegEx! xD
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$usuario = new Usuario();
			$usuario->login($email, $contrasena);
			if($usuario->id == null)
			{
				$err = $usuario->err;
			}else{
				echo "<script>window.location = './';</script>";
				die();
			}
		}else{
			$err = 'Email Invalido!';
		}

	}
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="container">
	<form class="form-signin" method="post" autocomplete="off">
		<h2 class="form-signin-heading">Login</h2>
		<input type="email" name="email" class="input-block-level" placeholder="Email" required />
		<input type="password" name="contrasena" class="input-block-level" placeholder="Contraseña" required />
		<button class="btn btn-large btn-primary" type="submit">Entrar</button>

		<?php
		if(!empty($err))
		{
			echo '<br /><br /><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>'.$err.'</strong></div>';
		}
		?>

	</form>
</div>