<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\productos_model;
use App\Models\categorias_model;

class Listado_Productos extends Controller
{
    protected $productos;
    protected $categorias;
    
    // Constructor de la clase ListaCatalogo
    public function __construct()
    {
        $this->productos    = new productos_model();
        $this->categorias   = new categorias_model();
    }

    // Se listan los productos registrados/guardados en la base de datos
    public function listarProductos()
    {
        $datosProductos['productos'] = $this->productos->findAll();
        $datosProductos['categorias'] = $this->categorias->findAll();
        $datosProductos['titulo'] = "Producto";

        $data['titulo'] = "Productos Leblanc";
        $mainContent = view("Catalogo", $datosProductos, ['returnType' => 'string']);
        return $this->_cargarVistasComunes($mainContent, $data);
    }

    // Se buscan los productos en relación a la categoria de las mismas
    public function filtrarProducto()
    {    
        $id_categoria = $this->request->getPost("categoria_id");

        if($id_categoria == ""){
            $datosProductos['productos'] = $this->productos->getProductos();
            $datosProductos['categorias'] = $this->categorias->getCategorias();
            $datosProductos['titulo'] = "Producto";
        }else{
            $datosProductos['productos'] = $this->productos->like("categoria_id", $id_categoria)->getProductos();
            $datosProductos['categorias'] = $this->categorias->getCategorias();
            $datosProductos['titulo'] = "Producto";
        }  

        $data['titulo'] = "Productos Leblanc";
        $mainContent = view("Catalogo", $datosProductos, ['returnType' => 'string']);
        return $this->_cargarVistasComunes($mainContent, $data);
    }

    // Función que carga las vistas comunes
    private function _cargarVistasComunes($mainContent, $data = [])
    {
        $defaultData = [
            'titulo' => "Leblanc Cafeteria"
        ];
        $data = array_merge($defaultData, $data);
        echo view("Header");
        echo view("Barradenavegacion");
        echo $mainContent;
        echo view("Footer");
    }
}