<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Empleado;
class AutenticacionController extends Controller{

    public function index(){
        $datos['head']= view('templates/head');
        $datos['footer']= view('templates/footer');
        return view('login',$datos);
    }

    public function login(){
        $username = $this->request->getVar('username');
        $passwd = $this->request->getVar('passwd');
        $empleado= new Empleado();
        $login= $empleado->where('username',$username)->first();
        if($login == null){
            print_r("0");
        }
        else{
            $hashed = $login["passwd"];
            if (password_verify($passwd,$hashed))
                print_r("2");
            else
                print_r("1");
        }
    }

    public function password(){
        $datos['head']= view('templates/head');
        $datos['cabecera']= view('templates/cabecera');
        $datos['footer']= view('templates/footer');
        return view('contrasenha',$datos);
    }

    public function cambiar(){
        $username = $this->request->getVar('username');
        $passwd = $this->request->getVar('passwd');
        $passwdn = $this->request->getVar('passwdn');
        $empleado = new Empleado();
        $login= $empleado->where('username',$username)->first();
        //Se intenta recuperar la información del empleado
        if($login == null){
            print_r("0");
        }
        else{
            //Se comprueba que la contraseña introducida sea correcta
            $hashed = $login["passwd"];
            if (password_verify($passwd,$hashed)){
                $options = [
                    'memory_cost' => 1024,
                    'time_cost'   => 1,
                    'threads'     => 1,
                ];
		        $hash = password_hash($passwdn, PASSWORD_ARGON2ID, $options);
                $datos=[
                    'nombre'=>$login["nombre"],
                    'apellidos'=>$login["apellidos"],
                    'dni'=>$login["dni"],
                    'username'=>$username,
                    'email'=>$login["email"],
                    'passwd'=>$hash
                ];
                $id= $login["id"];
                $empleado->update($id,$datos);
                print_r("2");
            }
            else
                print_r("1");
        }
    }

}