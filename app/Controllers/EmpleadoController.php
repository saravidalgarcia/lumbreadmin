<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Empleado;
use App\Models\Contacto;

class EmpleadoController extends Controller
{

    /**
     * Devuelve la vista principal de gestión de empleados recuperando
     * a través del modelo la información de los empleados
     */
    public function index()
    {
        $empleado = new Empleado();
        $datos['head'] = view('templates/head');
        $datos['cabecera'] = view('templates/cabecera');
        $datos['footer'] = view('templates/footer');
        $datos['empleados'] = $empleado->orderBy('id', 'ASC')->findAll();
        return view('empleado/listar', $datos);
    }

    /**
     * Devuelve la vista de creación de nuevo empleado
     */
    public function crear()
    {
        $datos['head'] = view('templates/head');
        $datos['cabecera'] = view('templates/cabecera');
        $datos['footer'] = view('templates/footer');
        return view('empleado/crear', $datos);
    }

    /**
     * Devuelve la vista de visualización de la ficha de
     * empleado recuperando los datos del empleado y de su
     * información de contacto a través del modelo dado su id
     */
    public function ver($id = null)
    {
        $empleado = new Empleado();
        $contacto = new Contacto();
        $datos['empleado'] = $empleado->where('id', $id)->first();
        $datos['contacto'] = $contacto->where('empleado', $datos['empleado']['id'])->first();
        $datos['head'] = view('templates/head');
        $datos['cabecera'] = view('templates/cabecera');
        $datos['footer'] = view('templates/footer');
        return view('empleado/ver', $datos);
    }

    /**
     * Devuelve la vista de edición de empleado recuperando
     * los datos del empleado y de su información de contacto
     * a través del modelo dado su id
     */
    public function editar($id = null)
    {
        $empleado = new Empleado();
        $contacto = new Contacto();
        $datos['empleado'] = $empleado->where('id', $id)->first();
        $datos['contacto'] = $contacto->where('empleado', $datos['empleado']['id'])->first();
        $datos['head'] = view('templates/head');
        $datos['cabecera'] = view('templates/cabecera');
        $datos['footer'] = view('templates/footer');
        return view('empleado/editar', $datos);
    }

    /**
     * Llama al modelo para crear un nuevo empleado con la
     * información recibida por post y redirige al usuario
     * tras la inserción
     */
    public function guardar()
    {
        $empleado = new Empleado();
        $password = $this->request->getVar('passwd');
        //Se encripta la contraseña
        $options = [
            'memory_cost' => 1024,
            'time_cost'   => 1,
            'threads'     => 1,
        ];
        $hash = password_hash($password, PASSWORD_ARGON2ID, $options);
        $datos = [
            'nombre' => $this->request->getVar('nombre'),
            'apellidos' => $this->request->getVar('apellidos'),
            'dni' => $this->request->getVar('dni'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'passwd' => $hash
        ];
        $empleado->insert($datos);
        //Se guarda la información de contacto recuperando primero el 
        //id del empleado para utilizarlo como clave foránea
        $contacto = new Contacto();
        $id = $empleado->where('dni', $datos['dni'])->first();
        $datos_contacto = [
            'telefono' => $this->request->getVar('telefono'),
            'direccion' => $this->request->getVar('direccion'),
            'poblacion' => $this->request->getVar('poblacion'),
            'cp' => $this->request->getVar('cp'),
            'pais' => $this->request->getVar('pais'),
            'empleado' => $id['id']
        ];
        $contacto->insert($datos_contacto);
        return $this->response->redirect(base_url('/empleados'));
    }

    /**
     * Llama al modelo para actualizar un empleado con la
     * información recibida por post y redirige al usuario
     * tras la actualización
     */
    public function actualizar()
    {
        $empleado = new Empleado();
        $datos = [
            'nombre' => $this->request->getVar('nombre'),
            'apellidos' => $this->request->getVar('apellidos'),
            'dni' => $this->request->getVar('dni'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
        ];
        $id = $this->request->getVar('id');
        $empleado->update($id, $datos);
        //Se actualizan los datos de contacto
        $contacto = new Contacto();
        $datos_contacto = [
            'telefono' => $this->request->getVar('telefono'),
            'direccion' => $this->request->getVar('direccion'),
            'poblacion' => $this->request->getVar('poblacion'),
            'cp' => $this->request->getVar('cp'),
            'pais' => $this->request->getVar('pais')
        ];
        $id_contacto = $contacto->where('empleado', $id)->first();
        $contacto->update($id_contacto['id'], $datos_contacto);
        return $this->response->redirect(base_url('/empleados'));
    }

    /**
     * Llama al modelo para eliminar un usuario
     */
    public function borrar($id = null)
    {
        $empleado = new Empleado();
        $empleado->where('id', $id)->delete($id);
        return $this->response->redirect(base_url('/empleados'));
    }

    /**
     * Llama al modelo para recuperar la información de los empleados
     * registrados en el sistema y la imprime en formato JSON
     */
    public function getempleados()
    {
        $empleado = new Empleado();
        $datos['empleados'] = $empleado->orderBy('id', 'ASC')->findAll();
        print_r(json_encode($datos));
    }

    /**
     * Llama al modelo para recuperar la información de un empleado
     * dado su id y la imprime en formato JSON
     */
    public function getempleado($id = null)
    {
        $empleado = new Empleado();
        $datos['empleado'] = $empleado->where('id', $id)->first();
        print_r(json_encode($datos));
    }
}
