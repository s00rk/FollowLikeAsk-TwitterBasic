<?php

class Usuario extends Conexion
{

	var $id;
	var $nombre;
	var $email;
	var $contrasena;
	var $err;

	function login($em, $con)
	{
		parent::__construct();
		$stmt = $this->con->prepare("SELECT IDUsuario, Nombre, Email, Contrasena FROM Usuario WHERE Email = ?");
		$stmt->bind_param('s', $em);
		$stmt->execute();
		$stmt->bind_result($this->id, $this->nombre, $this->email, $this->contrasena);
		$stmt->fetch();
		if(empty($this->id))
		{
			$this->err = 'El Email No Se Encuentra en la Base de Datos';
		}else{
			if($this->contrasena != $con)
			{
				$this->id = null;
				$this->err = 'La Contraseña es Incorrecta';
			}else{
				$_SESSION['ME'] = serialize($this);
			}
		}
		$stmt->close();
	}

	function getByID($id)
	{
		parent::__construct();
		$stmt = $this->con->prepare("SELECT IDUsuario, Nombre, Email, Contrasena FROM Usuario WHERE IDUsuario = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($this->id, $this->nombre, $this->email, $this->contrasena);
		$stmt->fetch();
		$stmt->close();
	}

	function getAll()
	{
		parent::__construct();
		$result = $this->con->query("SELECT a.IDUsuario, a.Nombre, b.idSeguidor as 'seguidor' FROM Usuario a LEFT JOIN Seguidor b 
ON a.IDUsuario=b.idUsuario WHERE a.idUsuario != ".$this->id." Order By a.Nombre ASC");
		$usuarios = array();
		while($r = $result->fetch_object())
		{
			if(empty($r->seguidor))
				$r->seguidor = 0;
			else
				$r->seguidor = 1;
			$usuarios[] = $r;
		}
		$result->close();
		return $usuarios;
	}

	function seguir($idUser)
	{
		parent::__construct();
		$result = $this->con->query("SELECT IDUsuario FROM Seguidor WHERE idSeguidor = ".$this->id." AND idUsuario = ".$idUser);
		if($result->num_rows == 0)
		{
			$result->close();
			$this->con->query("INSERT INTO Seguidor (idSeguidor, IDUsuario) VALUES (".$this->id.", ".$idUser.")");
		}else{
			$result->close();
			$this->con->query("DELETE FROM Seguidor WHERE idSeguidor = ".$this->id." AND IDUsuario = ".$idUser);
		}
		return true;
	}

}

?>