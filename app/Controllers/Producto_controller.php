<?php

namespace App\Controllers;

use App\Models\productos_model;
use CodeIgniter\Controller;

class Producto_controller extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function create()
    {
        echo view('Header');
        echo view('Formulario_producto');
        echo view('Footer');
    }

public function formValidation()
    {
        $validation = $this->validate([
            'nombre_prod'   => 'required|min_length[3]',
            'categoria_id'  => 'required|integer',
            'precio'        => 'required|decimal',
            'precio_vta'    => 'required|decimal',
            'stock'         => 'required|integer',
            'stock_min'     => 'required|integer',
            'imagen'        => 'uploaded[imagen]|max_size[imagen,2048]|is_image[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/png]',
          ]);

        $productoModel = new productos_model();

        if (!$validation) {
            $data['titulo'] = 'Registrar Producto';
            echo view('Header', $data);
            echo view('Barradenavegacion');
            echo view('Formulario_producto', ['validation' => $this->validator]);
            echo view('Footer');
        } else {
            $img = $this->request->getFile('img');
            $nombreImg = null;

            if ($img->isValid() && !$img->hasMoved()) {
                $nombreImg = $img->getRandomName();
                $img->move('uploads/productos', $nombreImg);
            }

        $productoModel->save([
            'nombre_prod'   => $this->request->getPost('nombre_prod'),
            'imagen'        => $nombreImagen,
            'categoria_id'  => $this->request->getPost('categoria_id'),
            'precio'        => $this->request->getPost('precio'),
            'precio_vta'    => $this->request->getPost('precio_vta'),
            'stock'         => $this->request->getPost('stock'),
            'stock_min'     => $this->request->getPost('stock_min'),
            'eliminado'     => $this->request->getPost('eliminado') ? 1 : 0
        ]);

        session()->setFlashdata('success', 'Producto registrado con éxito');
        return redirect()->to(base_url('producto/create'));
    }
}
}