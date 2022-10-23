<?php

//Clase Usuario
class Usuario extends BD
{

	//Ver la lista de usuarios
	private function get_usuarios_BD()
	{
		try {
			$SQL = "SELECT id,username,email FROM usuario";
			$result = $this->connect()->prepare($SQL);
			$result->execute();
			return $result->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die('Error: Usuario(get_usuarios) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	function get_usuarios_modelo()
	{
		return $this->get_usuarios_BD();
	}


	//Crear usuario
	private function crear_usuario_BD($data)
	{
		try {
			$SQL = 'INSERT INTO usuario (username,email,passwd) VALUES (?,?,?)';
			$result = $this->connect()->prepare($SQL);
			$result->execute(array(
				$data['username'],
				$data['email'],
				$data['passwd']
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