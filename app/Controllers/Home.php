<?php

namespace App\Controllers;
use App\Models\productos_model;
use App\Models\categorias_model;
use App\Models\contacto_model;

class Home extends BaseController
{
    public function index()
    {
        $data['titulo']='principal';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Productos');
        echo view('Menudeproductos');
        echo view('Footer');
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
        echo view('Productos');
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
    public function enviar()
    {
        $correo = $this->request->getPost('correo');
        $tipo = $this->request->getPost('tipo');
        $descripcion = $this->request->getPost('descripcion');

        if (empty($correo) || empty($tipo) || empty($descripcion)) {
            session()->setFlashdata('mensaje', 'Todos los campos son obligatorios.');
            return redirect()->back()->withInput();
        }

        $modelo = new contacto_model();

        $modelo->insert([
            'correo' => $correo,
            'tipo' => $tipo,
            'descripcion' => $descripcion
        ]);

        session()->setFlashdata('mensaje', 'Gracias por tu suscripción.');
        return redirect()->back();
    }
    public function listar()
{
    $modelo = new contacto_model();
    $data['consultas'] = $modelo->findAll();

    return view('Header') .
           view('Barradenavegacion') .
           view('consultas', $data) .
           view('Footer');
}

public function marcarLeido($id)
{
    $modelo = new contacto_model();
    $modelo->update($id, ['leido' => 1]);

    session()->setFlashdata('mensaje', 'Consulta marcada como leída.');
    return redirect()->to(base_url('contactenosListar'));
}

}
