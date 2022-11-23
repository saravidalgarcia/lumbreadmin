<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Empleado;
use App\Models\Contacto;
class EmpleadoController extends Controller{

    public function index(){
        $empleado = new Empleado();
        $datos['head']= view('templates/head');
        $datos['cabecera']= view('templates/cabecera');
        $datos['footer']= view('templates/footer');
        $datos['empleados']= $empleado->orderBy('id','ASC')->findAll();
        return view('empleado/listar',$datos);
    }

    public function crear(){
        $datos['head']= view('templates/head');
        $datos['cabecera']= view('templates/cabecera');
        $datos['footer']= view('templates/footer');
        return view('empleado/crear',$datos);
    }

    public function ver($id=null){
        $empleado= new Empleado();
        $contacto= new Contacto();
        $datos['empleado']=$empleado->where('id',$id)->first();
        $datos['contacto']=$contacto->where('empleado',$datos['empleado']['id'])->first();
        $datos['head']= view('templates/head');
        $datos['cabecera']= view('templates/cabecera');
        $datos['footer']= view('templates/footer');
        return view('empleado/ver',$datos);
    }

    public function editar($id=null){
        $empleado= new Empleado();
        $contacto= new Contacto();
        $datos['empleado']=$empleado->where('id',$id)->first();
        $datos['contacto']=$contacto->where('empleado',$datos['empleado']['id'])->first();
        $datos['head']= view('templates/head');
        $datos['cabecera']= view('templates/cabecera');
        $datos['footer']= view('templates/footer');
        return view('empleado/editar',$datos);
    }

    public function guardar(){
        $empleado= new Empleado();
        $password = $this->request->getVar('passwd');
		$options = [
			'memory_cost' => 1024,
			'time_cost'   => 1,
			'threads'     => 1,
		];
		$hash = password_hash($password, PASSWORD_ARGON2ID, $options);
        $datos=[
            'nombre'=>$this->request->getVar('nombre'),
            'apellidos'=>$this->request->getVar('apellidos'),
            'dni'=>$this->request->getVar('dni'),
            'username'=>$this->request->getVar('username'),
            'email'=>$this->request->getVar('email'),
            'passwd'=>$hash
        ];
        $empleado->insert($datos);
        //Se guarda la información de contacto
        $contacto = new Contacto();
        $id = $empleado->where('dni',$datos['dni'])->first();
        $datos_contacto=[
            'telefono'=>$this->request->getVar('telefono'),
            'direccion'=>$this->request->getVar('direccion'),
            'poblacion'=>$this->request->getVar('poblacion'),
            'cp'=>$this->request->getVar('cp'),
            'pais'=>$this->request->getVar('pais'),
            'empleado'=>$id['id']
        ];
        $contacto->insert($datos_contacto);
        return $this->response->redirect(base_url('/empleados'));
    }

    public function actualizar(){
        $empleado= new Empleado();
        $datos=[
            'nombre'=>$this->request->getVar('nombre'),
            'apellidos'=>$this->request->getVar('apellidos'),
            'dni'=>$this->request->getVar('dni'),
            'username'=>$this->request->getVar('username'),
            'email'=>$this->request->getVar('email'),
        ];
        $id= $this->request->getVar('id');
        $empleado->update($id,$datos);
        //Se actualizan los datos de contacto
        $contacto= new Contacto();
        $datos_contacto=[
            'telefono'=>$this->request->getVar('telefono'),
            'direccion'=>$this->request->getVar('direccion'),
            'poblacion'=>$this->request->getVar('poblacion'),
            'cp'=>$this->request->getVar('cp'),
            'pais'=>$this->request->getVar('pais')
        ];
        $id_contacto= $contacto->where('empleado',$id)->first();
        $contacto->update($id_contacto['id'],$datos_contacto);
        return $this->response->redirect(base_url('/empleados'));
    }

    public function borrar($id=null){
        $empleado= new Empleado();
        $empleado->where('id',$id)->delete($id);
        return $this->response->redirect(base_url('/empleados'));
    }

    public function getempleados(){
        $empleado = new Empleado();
        $datos['empleados']= $empleado->orderBy('id','ASC')->findAll();
        print_r(json_encode($datos));
    }

    public function getempleado($id=null){
        $empleado = new Empleado();
        $datos['empleado']=$empleado->where('id',$id)->first();
        print_r(json_encode($datos));
    }

}