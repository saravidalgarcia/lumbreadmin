<?php

//Clase Administrador
class Administrador extends BD
{

	//Función que accede a BD para confirmar la validez de las credenciales de login
	private function login_BD($username)
	{
		try {
			$SQL = "SELECT * FROM administrador WHERE username = ?";
			$result = $this->connect()->prepare($SQL);
			$result->execute(array(
				$username
			));
			return $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die('Error: Administrador(acceso) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	function login_modelo($username)
	{
		return $this->login_BD($username);
	}

	//Ver la lista de administradores
	private function get_admins_BD()
	{
		try {
			$SQL = "SELECT id,username,dni,nombre,apellidos,email FROM administrador";
			$result = $this->connect()->prepare($SQL);
			$result->execute();
			return $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die('Error: Administrador(get_admins) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	function get_admins_modelo()
	{
		return $this->get_admins_BD();
	}

	//Crear administrador
	private function crear_admin_BD($data)
	{
		try {
			$SQL = 'INSERT INTO administrador (nombre, apellidos, dni, email, username, passwd) VALUES (?,?,?,?,?,?)';
			$result = $this->connect()->prepare($SQL);
			$result->execute(array(
				$data['nombre'],
				$data['apellidos'],
				$data['dni'],
				$data['email'],
				$data['username'],
				$data['passwd']
			));
		} catch (Exception $e) {
			die('Error: Administrador(crear_admin) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	function crear_admin_modelo($data)
	{
		$this->crear_admin_BD($data);
	}

	//Borrar administrador
	private function delete_admin_BD($id)
	{
		try {
			$SQL = 'DELETE FROM administrador WHERE id = ?';
			$result = $this->connect()->prepare($SQL);
			$result->execute(array($id));
		} catch (Exception $e) {
			die('Error Administrador(delete_admin) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	function delete_admin_modelo($id)
	{
		$this->delete_admin_BD($id);
	}
}
?>