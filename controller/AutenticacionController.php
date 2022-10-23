<?php

//Controlador para la autenticación
class AutenticacionController extends Administrador
{

	//Función que carga la vista de la página de login
	function index()
	{
		require_once('view/acceso/login.php');
	}

	//Función que realiza el login
	function login()
	{
		$username = $_REQUEST['username'];
		$passwd = $_REQUEST['passwd'];
		$data = parent::login_modelo($username);
		if (count($data) == 0)
			echo "0";
		else{
			$hashed = $data[0]->passwd;
			if (password_verify($passwd,$hashed)) {
				$_SESSION['auth'] = 'true';
				echo "1";
			}
			else echo "0";
		}
	}
}
