<?php

//Clase Administrador
class Administrador extends BD
{

	//Función que accede a BD para confirmar la validez de las credenciales de login
	private function login_BD($username)
	{
		try {
			$SQL = "SELECT * FROM empleado WHERE username = ?";
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
			$SQL = "SELECT a.id,username,dni,nombre,apellidos,email,telefono,direccion,poblacion,cp,pais FROM empleado a JOIN info_contacto b ON a.id = b.empleado";
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
			//Se inserta su información básica
			$SQL = 'INSERT INTO empleado (nombre, apellidos, dni, email, username, passwd) VALUES (?,?,?,?,?,?)';
			$result = $this->connect()->prepare($SQL);
			$result->execute(array(
				$data['nombre'],
				$data['apellidos'],
				$data['dni'],
				$data['email'],
				$data['username'],
				$data['passwd']
			));
			//Se obtiene su id
			$nuevo = $this->login_BD($data['username']);
			if (count($nuevo) == 0)
				echo "Error: No se ha podido insertar la información de contacto (Error al determinar el id de empleado)";
			else{
				$id = $nuevo[0]->id;
				$SQL = 'INSERT INTO info_contacto (telefono,direccion,poblacion,cp,pais,empleado) VALUES (?,?,?,?,?,?)';
				$result = $this->connect()->prepare($SQL);
				$result->execute(array(
					$data['telefono'],
					$data['direccion'],
					$data['poblacion'],
					$data['cp'],
					$data['pais'],
					$id
				));
			}
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

	//Actualizar información de contacto de un administrador
	private function update_contacto_BD($data)
	{
		try {
			$SQL = 'UPDATE info_contacto SET telefono = ?, direccion = ?, poblacion = ?, cp = ?, pais = ? WHERE empleado = ?';
			$result = $this->connect()->prepare($SQL);
			$result->execute(array(
				$data['telefono'],
				$data['direccion'],
				$data['poblacion'],
				$data['cp'],
				$data['pais'],
				$data['id']
			));
		} catch (Exception $e) {
			die('Error: Administrador(update_contacto) ' . $e->getMessage());
		} finally {
			$result = null;
		}
	}

	function update_contacto_modelo($data)
	{
		$this->update_contacto_BD($data);
	}

	//Borrar administrador
	private function delete_admin_BD($id)
	{
		try {
			$SQL = 'DELETE FROM empleado WHERE id = ?';
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