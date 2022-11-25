<?php

namespace App\Controllers;

class Home extends BaseController
{
    /**
     * Devuelve la vista de login
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Devuelve la vista de la página de información y contacto
     */
    public function about()
    {
        $datos['head'] = view('templates/head');
        $datos['cabecera'] = view('templates/cabecera');
        $datos['footer'] = view('templates/footer');
        return view('about', $datos);
    }
}
