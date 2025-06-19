<?php 
namespace App\Models;

use CodeIgniter\Model;

class productos_model extends Model{
    protected $table            = 'productos';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nombre_prod', 'imagen','categoria_id','precio','precio_vta','stock', "stock_min", "eliminado"
];

    protected $validationRules  = [

        'nombre_prod'    => 'required|min_length[3]',
        'imagen'         => 'uploaded[imagen]|is_image[imagen]|max_size[imagen,2048]',
        'categoria_id'   => 'required',
        'precio'         => 'required|numeric',
        'precio_vta'     => 'required|numeric',
        'stock'          => 'required',
        'stock_min'      => 'required',
    ]; 

    protected $validationMessages = [

        'nombre_prod'       => [
            'required'      => 'Campo de nombre del producto es obligatorio',
            'min_length'    => 'El campo nombre del producto debe tener al menos 3 caracteres'
        ],
        'imagen'           => [
            'is_image'      => 'Se debe ingresar una imagen jpg/png',
            'max_size'      => 'El máximo tamaño es de 4096'
        ],
        'categoria_id'     =>[
            'required'     => 'Campo de categoria es obligatorio'
        ],
        'precio'         => [
            'required'      => 'Campo de precio es obligatorio',
            'numeric'       => 'el valor ingresado debe ser numerico'
        ],
        'precio_vta'        => [
            'required'      => 'Campo de precio de venta es obligatorio',
            'numeric'       => 'el valor ingresado debe ser numerico'
        ],
        'stock'             => [
            'required'      => 'Campo de stock es obligatorio',
        ],
        'stock_min'       => [
            'required'      => 'El campo de stock minimo es obligatorio',
        ],
    ];

    public function desvalidarImagen(){
        unset($this->validationRules["pd_img"]);
    }

    public function getAllProductos($categoria){
        return $this->where('ct_id', $categoria)->findAll();
    }

    public function buscarProductos($buscar = null) {
        $sql = "SELECT p.*, c.ct_nombre FROM productos p
                    INNER JOIN categoria c ON p.id = c.id"; 
        
        if ($buscar)
        {
            $sql .= " WHERE p.pd_nombre LIKE '%".$buscar."%' OR c.ct_nombre LIKE '%".$buscar."%'";
        }
        
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function getProductos() {
        $sql = "SELECT p.* FROM productos p";
        
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
}