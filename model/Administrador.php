<?php

//Clase Administrador
class Administrador extends BD
{

	//Función que accede a BD para confirmar la validez de las credenciales de login
	private function login_BD($username, $passwd)
	{
		try {
			$SQL = "SELECT * FROM administrador WHERE username = ? AND passwd = ?";
			$result = $this->connect()->prepare($SQL);
			$result->execute(array(
				$username,
				$passwd
			));
			return $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die('Error: Administrador(acceso) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	function login_modelo($username, $passwd)
	{
		return $this->login_BD($username, $passwd);
	}
}
?>