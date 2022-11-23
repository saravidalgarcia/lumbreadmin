<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function about(){
        $datos['head']= view('templates/head');
        $datos['cabecera']= view('templates/cabecera');
        $datos['footer']= view('templates/footer');
        return view('about',$datos);
    }
}
