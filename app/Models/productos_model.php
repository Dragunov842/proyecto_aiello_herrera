<?php 
namespace App\Models;

use CodeIgniter\Model;

class productos_model extends Model{
    protected $table            = 'productos';
    protected $primaryKey       = 'producto_id';
    protected $allowedFields    = ['nombre', 'descripcion', 'precio', 'descuento','id_categoria', 'cantidad', "img", "activo"];

    protected $validationRules  = [

        "nombre"         => "required|min_length[3]",
        "descripcion"    => "required|max_length[250]",
        "precio"         => "required",
        "descuento"      => "required",
        "id_categoria"             => "required",
        "cantidad"       => "required",
        "img"            => "is_image[pd_Imagen]",
    ]; 

    protected $validationMessages = [

        "nombre"         => [
            "required"      => 'Campo de nombre del producto es obligatorio',
            "min_length"    => 'El campo nombre del producto debe tener al menos 3 caracteres'
        ],
        "descripcion"    => [
            "required"      => 'Campo de descripción es obligatorio',
            "max_length"    => 'El campo descripción debe tener como máximo 250 caracteres'
        ],
        "precio"         => [
            "required"      => 'Campo de precio es obligatorio',
        ],
        "descuento"      => [
            "required"      => 'Campo de categoria es obligatorio',
        ],
        "id_categoria"             => [
            "required"      => 'Campo de categoria es obligatorio',
        ],
        "cantidad"       => [
            "required"      => 'El campo de cantidad es obligatorio',
        ],
        "img"            => [
            "is_image"      => 'Se debe ingresar una imagen jpg/png',
            "max_size"      => 'El máximo tamaño es de 4096'
        ]
    ];

    public function desvalidarImagen(){
        unset($this->validationRules["pd_img"]);
    }

    public function getAllProductosByCategoria($categoria){
        return $this->where('ct_id', $categoria)->findAll();
    }

    public function buscarProductos($buscar = null) {
        $sql = "SELECT p.*, c.ct_nombre FROM productos p
                    INNER JOIN categoria c ON p.ct_id = c.id"; 
        
        if ($buscar)
        {
            $sql .= " WHERE p.pd_nombre LIKE '%".$buscar."%' OR c.ct_nombre LIKE '%".$buscar."%'";
        }
        
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }

    public function obtenerProductosActivos() {
        $sql = "SELECT p.*, c.ct_nombre FROM productos p
                    INNER JOIN categoria c ON p.ct_id = c.id 
                    WHERE pd_activo IS NULL";
        
        $query = $this->db->query($sql);
        return $query->getResultArray();
    }
}