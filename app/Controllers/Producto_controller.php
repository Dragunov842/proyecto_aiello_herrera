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
        $data['productos'] = $productoModel->getProductos(); //funcion en el modelo

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
        $productoModel = new productos_model();
        $imagen = $this->request->getFile('imagen');

        $input = $this->validate([
            'nombre_prod'=> 'required|min_length[3]',
            'categoria_id'=>'is_not_unique[categorias.id]',
            'precio'=>'required|numeric',
            'precio_vta'=>'required|numeric',
            'stock'=>'required',
            'stock_min'=>'required',
            'imagen'=>'uploaded[imagen]|is_image[imagen]|max_size[imagen,4096]',
        ]);

        
        if(!$input){
            $categoriaModel = new categorias_model();
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
        $datos = $this->request->getPost();

        // Subir la imagen
        $nombreImagen = $imagen->getRandomName();
        $datos['imagen'] = $nombreImagen;
        // Guardar producto
       /* $datos =[
            'nombre_prod' => $this->request->getPost('nombre_prod'),
            'categoria_id' => $this->request->getPost('categoria_id'),
            'precio' => $this->request->getPost('precio'),
            'precio_vta' => $this->request->getPost('precio_vta'),
            'stock' => $this->request->getPost('stock'),
            'stock_min' => $this->request->getPost('stock_min'),
            'eliminado' => 'NO',
            'imagen' => $imagen->getName(),
        ]; */
        $productoModel->save($datos);
        $imagen->move(ROOTPATH . 'assets\img\catalogo/', $nombreImagen);
        session()->setFlashdata('success', 'Alta exitosa...');
        return redirect()->to(base_url('crearProducto'));
    }
  }

  // show single producto (mostrar un producto por id)
public function singleproducto($id = null){

    $productoModel = new productos_model();
    $data['old'] = $productoModel->where('id', $id)->first();
    if (empty($data['old'])) {
        // lanzar error
        throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encontró el producto seleccionado');
    }

    // instancio el modelo de categorias
    $categoriasM = new categorias_model();
    $data['categorias'] = $categoriasM->getCategorias(); //traigo categorias

    $dato['titulo'] = 'Crud_productos';
    echo view('Header', $dato);
    echo view('Barradenavegacion');
    echo view('editarProducto', $data);
    echo view('Footer');
}

public function modifica($id){
    $productoModel = new productos_model();
    $id = $productoModel->where('id', $id)->first();
    $img = $this->request->getFile('imagen');

    // Verifica si se cargó un archivo de imagen válido
    if ($img && $img->isValid()) {
        // Se cargó una imagen válida correctamente
        $nombre_aleatorio = $img->getRandomName();
        $data = [
            'nombre_prod' => $this->request->getVar('nombre_prod'),
            'imagen' => $nombre_aleatorio,
            // completar con los demás campos
            'categoria_id' => $this->request->getVar('categoria'),
            'precio' => $this->request->getVar('precio'),
            'precio_vta' => $this->request->getVar('precio_vta'),
            'stock' => $this->request->getVar('stock'),
            'stock_min' => $this->request->getVar('stock_min'),
        ];

        
    } else {
        // No se cargó una nueva imagen, solo actualiza los datos del producto sin sobrescribir el campo imagen
        $data = [
            'nombre_prod' => $this->request->getVar('nombre_prod'),
            // completar con los demás campos
            'categoria_id' => $this->request->getVar('categoria'),
            'precio' => $this->request->getVar('precio'),
            'precio_vta' => $this->request->getVar('precio_vta'),
            'stock' => $this->request->getVar('stock'),
            'stock_min' => $this->request->getVar('stock_min'),
        ];
        
    }

    $productoModel->update($id, $data);
    session()->setFlashdata('success', 'Modificación Exitosa...');
    if ($img && $img->isValid()){ 
    $img->move(ROOTPATH . 'assets\img\catalogo/', $nombre_aleatorio);
}
    return redirect()->to(base_url('Crud_productos'));
}
// eliminar lógicamente
public function borrarProducto($id)
{
    $productoModel = new productos_model();
    $data['eliminado'] = $productoModel->where('id', $id)->first();
    $data['eliminado'] = 'SI';
    $productoModel->update($id, $data);
    return $this->response->redirect(site_url('Crud_productos'));
}

public function eliminados()
{
    $productoModel = new productos_model();
    $data['producto'] = $productoModel->getProductos();
    // $data['producto'] = $productoModel->orderBy('id', 'DESC')->findAll();
    $dato['titulo'] = 'Crud_productos';
    echo view('Header', $dato);
    echo view('Barradenavegacion');
    echo view('Productos_eliminados', $data);
    echo view('Footer');
}

public function activarProducto($id)
{
    $productoModel = new productos_model();
    $data['eliminado'] = $productoModel->where('id', $id)->first();
    $data['eliminado'] = 'NO';
    $productoModel->update($id, $data);
    session()->setFlashdata('success', 'Activación Exitosa...');
    return $this->response->redirect(site_url('Crud_productos'));
    // return $this->response->redirect(site_url('crear'));
}



}
