<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuario;
class UsuarioController extends Controller{

    public function index(){
        $usuario = new Usuario();
        $datos['head']= view('templates/head');
        $datos['cabecera']= view('templates/cabecera');
        $datos['footer']= view('templates/footer');
        $datos['usuarios']= $usuario->orderBy('id','ASC')->findAll();
        return view('usuario/listar',$datos);
    }

    public function crear(){
        $datos['head']= view('templates/head');
        $datos['cabecera']= view('templates/cabecera');
        $datos['footer']= view('templates/footer');
        return view('usuario/crear',$datos);
    }

    public function editar($id=null){
        $usuario= new Usuario();
        $datos['usuario']=$usuario->where('id',$id)->first();
        $datos['head']= view('templates/head');
        $datos['cabecera']= view('templates/cabecera');
        $datos['footer']= view('templates/footer');
        return view('usuario/editar',$datos);
    }

    public function guardar(){
        $usuario= new Usuario();
        //La contraseña por defecto es "LUMBRE"
        $password = 'LUMBRE';
		$options = [
			'memory_cost' => 1024,
			'time_cost'   => 1,
			'threads'     => 1,
		];
		$hash = password_hash($password, PASSWORD_ARGON2ID, $options);
        $datos=[
            'username'=>$this->request->getVar('username'),
            'email'=>$this->request->getVar('email'),
            'passwd'=>$hash
        ];
        $usuario->insert($datos);
        return $this->response->redirect(base_url('/usuarios'));
    }

    public function actualizar(){
        $usuario= new Usuario();
        $datos=[
            'username'=>$this->request->getVar('username'),
            'email'=>$this->request->getVar('email')
        ];
        $id= $this->request->getVar('id');
        $usuario->update($id,$datos);
        return $this->response->redirect(base_url('/usuarios'));
    }

    public function borrar($id=null){
        $usuario= new Usuario();
        $usuario->where('id',$id)->delete($id);
        return $this->response->redirect(base_url('/usuarios'));
    }

    public function getusuarios(){
        $usuario = new Usuario();
        $datos['usuarios']= $usuario->orderBy('id','ASC')->findAll();
        print_r(json_encode($datos));
    }

    public function getusuario($id=null){
        $usuario = new Usuario();
        $datos['usuario']=$usuario->where('id',$id)->first();
        print_r(json_encode($datos));
    }

}