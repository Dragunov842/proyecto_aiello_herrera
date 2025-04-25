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
        echo view('Footer');
    }

    public function principio()
    {
        $data['titulo']='inicio';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Productos');
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

}
