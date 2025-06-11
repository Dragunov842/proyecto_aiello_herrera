<?php

namespace App\Controllers;
use App\Models\categorias_model;
use CodeIgniter\Controller;

class Categoria_controller extends Controller
{
    public function __construct()
    {
        helper(['form']);
    }

    public function nueva()
    {
        // Muestra el formulario
        echo view('Header');
        echo view('Formulario_categoria');
        echo view('Footer');
    }

    public function guardar()
    {
        $validation = \Config\Services::validation();

        $reglas = [
            'nombre' => 'required|min_length[3]|max_length[50]',
            'descripcion' => 'required|max_length[200]'
        ];

        if (!$this->validate($reglas)) {
            return view('Header')
                . view('Formulario_categoria', ['validation' => $this->validator])
                . view('Footer');
        }

        $model = new categorias_model();
        $model->save([
            'nombre' => $this->request->getVar('nombre'),
            'descripcion' => $this->request->getVar('descripcion'),
            'activo' => 1 // por defecto activo
        ]);

        session()->setFlashdata('success', 'Categoría registrada correctamente');
        return redirect()->to('nueva-categoria');
    }
}
