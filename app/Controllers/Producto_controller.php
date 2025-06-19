<?php
namespace App\Controllers;

use App\Models\productos_model;
use App\Models\categorias_model;
use CodeIgniter\Controller;

class Producto_controller extends Controller
{
    protected $productoModel;
    protected $categoriaModel;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->productoModel = new productos_model();
        $this->categoriaModel = new categorias_model();
    }

    public function index()
    {
        $data['productos'] = $this->productoModel->findAll();
        $data['categorias'] = $this->categoriaModel->where('activo', 1)->findAll();
        $data['titulo'] = 'Catálogo de Productos';

        echo view('Header');
        echo view('Barradenavegacion');
        echo view('Catalogo', $data);
        echo view('Footer');
    }

    public function create()
    {
        $data['categorias'] = $this->categoriaModel->where('activo', 1)->findAll();
        $data['titulo'] = 'Registrar Producto';

        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Formulario_producto', $data);
        echo view('Footer');
    }

        public function guardar()
    {
        $rules = [
            'nombre_prod'   => 'required|min_length[3]',
            'descripcion'   => 'required|max_length[250]',
            'precio'        => 'required|numeric',
            'precio_vta'    => 'required|numeric',
            'categoria_id'  => 'required|numeric',
            'stock'         => 'required|integer',
            'stock_min'     => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            $data['titulo'] = 'Registrar Producto';
            $data['validation'] = $this->validator;
            $data['categorias'] = $this->categoriaModel->where('activo', 1)->findAll();

            echo view('Header', $data);
            echo view('Barradenavegacion');
            echo view('Formulario_producto', $data);
            echo view('Footer');
            return;
        }

        $imgFile = $this->request->getFile('imagen');
        $imgName = null;

        if ($imgFile && $imgFile->getError() !== UPLOAD_ERR_NO_FILE) {
            if (!$imgFile->isValid()) {
                return $this->imagenError('Error en la carga de la imagen.');
            }

            if ($imgFile->getSize() > 4 * 1024 * 1024) {
                return $this->imagenError('La imagen supera el tamaño máximo permitido (4MB).');
            }

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($imgFile->getMimeType(), $allowedTypes)) {
                return $this->imagenError('Tipo de archivo no permitido. Solo JPG, PNG y GIF.');
            }

            $imgName = $imgFile->getRandomName();
            $imgFile->move(WRITEPATH . 'uploads/productos', $imgName);
        }

        $this->productoModel->save([
            'nombre_prod'   => $this->request->getVar('nombre_prod'),
            'descripcion'   => $this->request->getVar('descripcion'),
            'precio'        => $this->request->getVar('precio'),
            'precio_vta'    => $this->request->getVar('precio_vta'),
            'categoria_id'  => $this->request->getVar('categoria_id'),
            'stock'         => $this->request->getVar('stock'),
            'stock_min'     => $this->request->getVar('stock_min'),
            'imagen'        => $imgName,
            'eliminado'     => 0,
        ]);

        session()->setFlashdata('success', 'Producto registrado con éxito');
        return redirect()->to('producto');
    }

    private function imagenError($mensaje)
    {
        $data['titulo'] = 'Registrar Producto';
        $data['validation'] = \Config\Services::validation();
        $data['validation']->setError('imagen', $mensaje);
        $data['categorias'] = $this->categoriaModel->where('activo', 1)->findAll();

        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Formulario_producto', $data);
        echo view('Footer');
        return;
    }

    public function editar($id = null)
    {
        $producto = $this->productoModel->find($id);
        if (!$producto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto no encontrado: $id");
        }

        $data['producto'] = $producto;
        $data['categorias'] = $this->categoriaModel->where('activo', 1)->findAll();
        $data['titulo'] = 'Editar Producto';

        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('editarProducto', $data);
        echo view('Footer');
    }

    public function actualizar($id = null)
    {
        $rules = [
            'nombre_prod'   => 'required|min_length[3]',
            'descripcion'   => 'required|max_length[250]',
            'precio'        => 'required|numeric',
            'precio_vta'    => 'required|numeric',
            'categoria_id'  => 'required|numeric',
            'stock'         => 'required|integer',
            'stock_min'     => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $producto = $this->productoModel->find($id);
        if (!$producto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto no encontrado: $id");
        }

        $imgFile = $this->request->getFile('imagen');
        $imgName = $producto['imagen'];

        if ($imgFile && $imgFile->getError() !== UPLOAD_ERR_NO_FILE) {
            $imgRules = ['imagen' => 'is_image[imagen]|max_size[imagen,4096]'];
            if (!$this->validate($imgRules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            if ($imgFile->isValid() && !$imgFile->hasMoved()) {
                $imgName = $imgFile->getRandomName();
                $imgFile->move(WRITEPATH . 'uploads/productos', $imgName);
            }
        }

        $this->productoModel->update($id, [
            'nombre_prod'   => $this->request->getPost('nombre_prod'),
            'descripcion'   => $this->request->getPost('descripcion'),
            'precio'        => $this->request->getPost('precio'),
            'precio_vta'    => $this->request->getPost('precio_vta'),
            'categoria_id'  => $this->request->getPost('categoria_id'),
            'stock'         => $this->request->getPost('stock'),
            'stock_min'     => $this->request->getPost('stock_min'),
            'imagen'        => $imgName,
        ]);

        session()->setFlashdata('success', 'Producto actualizado correctamente');
        return redirect()->to('producto');
    }

    public function eliminar($id = null)
    {
        $producto = $this->productoModel->find($id);
        if (!$producto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto no encontrado: $id");
        }

        $this->productoModel->update($id, ['eliminado' => 1]);

        session()->setFlashdata('success', 'Producto desactivado correctamente');
        return redirect()->to('producto');
    }

    public function restaurar($id = null)
    {
        $producto = $this->productoModel->find($id);
        if (!$producto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto no encontrado: $id");
        }

        $this->productoModel->update($id, ['eliminado' => 0]);

        session()->setFlashdata('success', 'Producto restaurado correctamente');
        return redirect()->to('eliminados');
    }

    public function eliminados()
    {
        $data['productos'] = $this->productoModel->where('eliminado', 1)->findAll();
        $data['titulo'] = 'Productos Eliminados';

        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Productos_eliminados', $data);
        echo view('Footer');
    }
}
