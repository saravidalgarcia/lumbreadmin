<?php

//Clase Usuario
class Usuario extends BD
{

	//Ver la lista de usuarios
	private function get_usuarios_BD()
	{
		try {
			$SQL = "SELECT * FROM usuario";
			$result = $this->connect()->prepare($SQL);
			$result->execute();
			return $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die('Error: Usuario(ver_usuarios) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	function get_usuarios_modelo()
	{
		return $this->get_usuarios_BD();
	}


	//Crear usuario
	//Nota: la contraseña por defecto es "LUMBRE"
	private function crear_usuario_BD($data)
	{
		$password = 'LUMBRE';
		$options = [
			'memory_cost' => 1024,
			'time_cost'   => 1,
			'threads'     => 1,
		];
		$hash = password_hash($password, PASSWORD_ARGON2ID, $options);
		try {
			$SQL = 'INSERT INTO usuario (username,email,passwd) VALUES (?,?,?)';
			$result = $this->connect()->prepare($SQL);
			$result->execute(array(
				$data['username'],
				$data['email'],
				$hash
			));
		} catch (Exception $e) {
			die('Error: Usuario(crear_usuario) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	function crear_usuario_modelo($data)
	{
		$this->crear_usuario_BD($data);
	}


	//Actualizar un usuario (nombre y/o email)
	//Nota: Los administradores no pueden cambiar la contraseña de los usuarios
	private function update_usuario_BD($data)
	{
		try {
			$SQL = 'UPDATE usuario SET username = ?, email = ? WHERE id = ?';
			$result = $this->connect()->prepare($SQL);
			$result->execute(array(
				$data['username'],
				$data['email'],
				$data['id']
			));
		} catch (Exception $e) {
			die('Error: Usuario(update_usuario) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	function update_usuario_modelo($data)
	{
		$this->update_usuario_BD($data);
	}


	//Borrar usuario
	private function delete_usuario_BD($id)
	{
		try {
			$SQL = 'DELETE FROM usuario WHERE id = ?';
			$result = $this->connect()->prepare($SQL);
			$result->execute(array($id));
		} catch (Exception $e) {
			die('Error Usuario(delete_usuario) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	function delete_usuario_modelo($id)
	{
		$this->delete_usuario_BD($id);
	}
}
?>