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

	function contacto($id, $telefono, $direccion, $poblacion, $cp, $pais)
	{
		require_once('view/administrador/edicion.php');
		?>
		<script type="text/javascript">
			document.formUpdateContacto.id.value = "<?php echo $id; ?>";
			document.formUpdateContacto.telefono.value = "<?php echo $telefono; ?>";
			document.formUpdateContacto.direccion.value = "<?php echo $direccion; ?>";
			document.formUpdateContacto.poblacion.value = "<?php echo $poblacion; ?>";
			document.formUpdateContacto.cp.value = "<?php echo $cp; ?>";
			document.formUpdateContacto.pais.value = "<?php echo $pais; ?>";
		</script>
		<?php
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
			'passwd' => $hash,
			'telefono' => $_REQUEST['telefono'],
			'direccion' => $_REQUEST['direccion'],
			'poblacion' => $_REQUEST['poblacion'],
			'cp' => $_REQUEST['cp'],
			'pais' => $_REQUEST['pais']
		);
		parent::crear_admin_modelo($data);
	}

	//Función que llama al modelo para actualizar la información de contacto de un administrador
	function update_contacto()
	{
		$data = array(
			'id' => $_REQUEST['id'],
			'telefono' => $_REQUEST['telefono'],
			'direccion' => $_REQUEST['direccion'],
			'poblacion' => $_REQUEST['poblacion'],
			'cp' => $_REQUEST['cp'],
			'pais' => $_REQUEST['pais']
		);
		parent::update_contacto_modelo($data);
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
						<th scope="col">Teléfono</th>
						<th scope="col">Dirección</th>
						<th scope="col">Opciones</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach (parent::get_admins_modelo() as $data) {
					?>
						<tr>
							<td class="admin-table"><?php echo $data->dni; ?> </td>
							<td class="admin-table"><?php echo ($data->nombre . ' ' . $data->apellidos); ?> </td>
							<td class="admin-table"><?php echo $data->username; ?> </td>
							<td class="admin-table"><?php echo $data->email; ?> </td>
							<td class="admin-table"><?php echo $data->telefono; ?> </td>
							<td class="admin-table smaller"><?php 
								$completo = '-';
								$direccion = $data->direccion;
								$poblacion = $data->poblacion;
								$cp = $data->cp;
								$pais = $data->pais;
								if ($direccion != null)
									$completo = $direccion;
								if ($poblacion != null)
									$completo .= ', '.$poblacion;
								if ($cp != null)
									$completo .= ', '.$cp;
								if ($pais != null)
									$completo .= ' ('.$pais.')';
								echo $completo; ?> </td>
							<td class="admin-table t-opciones">
								<button class="b-opcion-tabla" onclick="getContacto('<?php echo $data->id; ?>',
								'<?php echo $data->telefono; ?>',
								'<?php echo $data->direccion; ?>',
								'<?php echo $data->poblacion; ?>',
								'<?php echo $data->cp; ?>',
								'<?php echo $data->pais; ?>');">Actualizar contacto</button>
								<button class="b-opcion-tabla" onclick="deleteAdmin('<?php echo $data->id; ?>');">Borrar</button>
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