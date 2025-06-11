<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['titulo']='principal';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Productos');
        echo view('Menudeproductos');
        echo view('Formulario_usuario');
        echo view('Formulario_categoria');
        echo view('Formulario_producto');
        echo view('Login');
    }

    public function principio()
    {
        $data['titulo']='inicio';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Productos');
        echo view('Menudeproductos');
        echo view('Footer');
    }

    public function menuProductos()
    {
        $data['titulo']='Productos';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Menudeproductos');
        echo view('Footer');
    }

    public function sobreNosotros()
    {
        $data['titulo']='Sobre Nosotros';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('SobreNosotros');
        echo view('Footer');
    }
    public function contactenos()
    {
        $data['titulo']='Contactenos';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Contactenos');
        echo view('Footer');
    }

    public function condiciones()
    {
        $data['titulo']='condiciones';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('TerminosyCondiciones');
        echo view('Footer');
    }

    public function comercializacion()
    {
        $data['titulo']='comercializacion';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Comercializacion');
        echo view('Footer');
    }
    
}
