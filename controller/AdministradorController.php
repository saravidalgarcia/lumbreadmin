<?php

//Controlador para las operaciones sobre administradores
class AdministradorController extends Administrador
{

	//Función que carga la vista general
	function index()
	{
		require_once('view/general/header.php');
		require_once('view/general/main.php');
		require_once('view/administrador/footer.php');
	}

	//Función que carga la vista para el formulario de creación de administrador
	function creacion()
	{
		require_once('view/administrador/creacion.php');
	}

	//Función que llama al modelo para crear un administrador
	function crear_admin()
	{
		$password = $_REQUEST['passwd'];
		$options = [
			'memory_cost' => 1024,
			'time_cost'   => 1,
			'threads'     => 1,
		];
		$hash = password_hash($password, PASSWORD_ARGON2ID, $options);
		$data = array(
			'dni' => $_REQUEST['dni'],
			'nombre' => $_REQUEST['nombre'],
			'apellidos' => $_REQUEST['apellidos'],
			'username' => $_REQUEST['username'],
			'email' => $_REQUEST['email'],
			'passwd' => $hash
		);
		parent::crear_admin_modelo($data);
	}

	//Función que llama al modelo para eliminar un administrador dado su id
	function delete_admin()
	{
		parent::delete_admin_modelo($_REQUEST['id']);
	}

	//Función que obtiene, en formato JSON, el DNI, username e email de los administradores
	function get_admins()
	{
		$info = array();
		foreach (parent::get_admins_modelo()	as $data) {
			$admin = array(
				"dni" => $data->dni,
				"username" => $data->username,
				"email" => $data->email
			);
			array_push($info, $admin);
		}
		echo json_encode($info);
	}

	//Función que obtiene la información de los administradores y introduce en una tabla
	function set_admins()
	{
		require_once('view/administrador/listado.php');
		$data = parent::get_admins_modelo();
		if (count($data) > 0) {
		?>
			<table>
				<thead>
					<tr>
						<th scope="col">DNI</th>
						<th scope="col">Nombre</th>
						<th scope="col">Username</th>
						<th scope="col">Email</th>
						<th scope="col">Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach (parent::get_admins_modelo() as $data) {
					?>
						<tr>
							<td><?php echo $data->dni; ?> </td>
							<td><?php echo ($data->nombre . ' ' . $data->apellidos); ?> </td>
							<td><?php echo $data->username; ?> </td>
							<td><?php echo $data->email; ?> </td>
							<td>
								<div>
									<button onclick="deleteAdmin('<?php echo $data->id; ?>');">Borrar</button>
								</div>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		<?php
		} else {
		?>
			<p class="mensaje">No hay administradores registrados en el sistema</p>
		<?php
		}
	}

	//Función que cierra la sesión del administrador
	function cerrar_sesion()
	{
		session_unset();
		session_destroy();
	}

	//Función que establece la variable de sesión para usar el AdministradorController
	function admins()
	{
		$_SESSION['c'] = "Administrador";
	}

	//Función que establece la variable de sesión para usar el UsuarioController
	function usuarios()
	{
		$_SESSION['c'] = "Usuario";
	}
}
?>