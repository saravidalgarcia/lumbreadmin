<?php

//Controlador para las operaciones sobre usuarios
class UsuarioController extends Usuario
{

	//Función que carga la vista general
	function index()
	{
		require_once('view/general/header.php');
		require_once('view/general/main.php');
		require_once('view/usuario/footer.php');
	}

	//Función que carga la vista para el formulario de creación de usuario
	function creacion()
	{
		require_once('view/usuario/creacion.php');
	}

	//Función que carga la vista para el formulario de edición de usuario
	function actualizacion($id, $username, $email)
	{
		require_once('view/usuario/edicion.php');
		?>
		<script type="text/javascript">
			document.formUpdateUsuario.id.value = "<?php echo $id; ?>";
			document.formUpdateUsuario.oldusername.value = "<?php echo $username; ?>";
			document.formUpdateUsuario.oldemail.value = "<?php echo $email; ?>";
			document.formUpdateUsuario.newusername.value = "<?php echo $username; ?>";
			document.formUpdateUsuario.newemail.value = "<?php echo $email; ?>";
		</script>
		<?php
	}

	//Función que llama al modelo para crear un usuario dados su username y email
	//Nota: La contraseña por defecto es "LUMBRE"
	function crear_usuario()
	{
		$password = 'LUMBRE';
		$options = [
			'memory_cost' => 1024,
			'time_cost'   => 1,
			'threads'     => 1,
		];
		$hash = password_hash($password, PASSWORD_ARGON2ID, $options);
		$data = array(
			'username' => $_REQUEST['username'],
			'email' => $_REQUEST['email'],
			'passwd' => $hash
		);
		parent::crear_usuario_modelo($data);
	}

	//Función que llama al modelo para actualizar la información de un usuario
	function update_usuario()
	{
		$data = array(
			'id' => $_REQUEST['id'],
			'username' => $_REQUEST['username'],
			'email' => $_REQUEST['email']
		);
		parent::update_usuario_modelo($data);
	}

	//Función que llama al modelo para eliminar un usuario dado su id
	function delete_usuario()
	{
		parent::delete_usuario_modelo($_REQUEST['id']);
	}

	//Función que obtiene, en formato JSON, el username y el email de todos los usuarios
	function get_usuarios()
	{
		$info = array();
		foreach (parent::get_usuarios_modelo()	as $data) {
			$usuario = array(
				"username" => $data->username,
				"email" => $data->email
			);
			array_push($info, $usuario);
		}
		echo json_encode($info);
	}

	//Función que obtiene la información de los usuarios y introduce en una tabla
	function set_usuarios()
	{
		require_once('view/usuario/listado.php');
		$data = parent::get_usuarios_modelo();
		if (count($data) > 0) {
		?>
			<table>
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Username</th>
						<th scope="col">Email</th>
						<th scope="col">Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach (parent::get_usuarios_modelo()	as $data) {
					?>
						<tr>
							<td class="user-table"><?php echo $data->id; ?> </td>
							<td class="user-table"><?php echo $data->username; ?> </td>
							<td class="user-table"><?php echo $data->email; ?> </td>
							<td class="user-table">
								<div>
									<button onclick="getActualizacion('<?php echo $data->id; ?>','<?php echo $data->username; ?>','<?php echo $data->email; ?> ');">Actualizar</button>
									<button onclick="deleteUsuario('<?php echo $data->id; ?>');">Borrar</button>
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
			<p class="mensaje">No hay usuarios registrados en el sistema</p>
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