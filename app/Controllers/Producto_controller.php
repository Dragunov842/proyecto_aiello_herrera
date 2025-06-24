<?php
namespace App\Controllers;
use App\Models\Usuario_model;
use App\Models\productos_model;
use CodeIgniter\Controller;
use App\Models\categorias_model;

class Producto_controller extends Controller {

    public function __construct() {
        helper(['form', 'url']);
        $session = session();
    }

    //mostrar los productos en lista
    public function mostrar()
    {
        $productoModel = new productos_model();
        //realizo la consulta para mostrar todos los productos
        $data['producto'] = $productoModel->getProductos(); //funcion en el modelo

        $dato['titulo'] = 'Crud_productos';
        echo view("Header", $dato);
        echo view("Barradenavegacion");
        echo view("Crud_productos", $data);
        echo view("footer");
    }

    // Mostrar formulario de registro
    public function crearProducto() {
        $categoriasmodel = new categorias_model();
        $data['categorias'] = $categoriasmodel->getCategorias();

        $productoModel = new productos_model();
        $data['producto'] = $productoModel->getProductos();

        $dato['titulo']='Alta producto';
        echo view('Header', $dato);
        echo view('Barradenavegacion');
        echo view('Formulario_producto',$data);
        echo view('Footer');

    }
    public function guardarProd()
    {
        $input = $this->validate([
            'nombre_prod'=> 'required|min_length[3]',
            'categoria_id'=>'is_not_unique[categorias.id]',
            'precio'=>'required|numeric',
            'precio_vta'=>'required|numeric',
            'stock'=>'required',
            'stock_min'=>'required',
            'imagen'=>'uploaded[imagen]'
        ]);

        $productoModel = new productos_model();
        if(!$input){
            $categoriaModel = new categoria_model();
            $data['categorias'] = $categoriaModel->getCategorias();
            $data['validation'] = $this->validator;

            $dato['titulo']='Alta';
            echo view('Header',$dato);
            echo view('Barradenavegacion');
            echo view('crearProducto');
            echo view('Footer');
        }else{

        if (!$this->validate($productoModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('fail', 'Verifica los datos ingresados.');
        }

        // Subir la imagen
        $imagen = $this->request->getFile('imagen');
        $nombreImagen = $imagen->getRandomName();
        $imagen->move(ROOTPATH.'assets/uploads', $nombreImagen);

        // Guardar producto
        $datos =[
            'nombre_prod' => $this->request->getVar('nombre_prod'),
            'categoria_id' => $this->request->getVar('categoria_id'),
            'precio' => $this->request->getVar('precio'),
            'precio_vta' => $this->request->getVar('precio_vta'),
            'stock' => $this->request->getVar('stock'),
            'stock_min' => $this->request->getVar('stock_min'),
            'eliminado' => 'NO',
            'imagen' => $nombreImagen 
        ];
        $producto = new productos_model();
        $producto->insert($datos);
        session()->setFlashdata('success', 'Alta exitosa...');
        return $this->response->redirect(site_url('crearProducto'));
    }
  }

  // show single producto (mostrar un producto por id)
public function singleproducto($id = null){

    $productoModel = new productos_Model();
    $data['old'] = $productoModel->where('id', $id)->first();
    if (empty($data['old'])) {
        // lanzar error
        throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encontró el producto seleccionado');
    }

    // instancio el modelo de categorias
    $categoriasM = new categoria_model();
    $data['categorias'] = $categoriasM->getCategorias(); //traigo categorias

    $dato['titulo'] = 'Crud_productos';
    echo view('Header', $dato);
    echo view('Barradenavegacion');
    echo view('back/productos/edit', $data);
    echo view('Footer');
}

}
