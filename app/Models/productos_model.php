<?php 
namespace App\Models;

use CodeIgniter\Model;

class modelo_producto extends Model{
    protected $table            = 'productos';
    protected $primaryKey       = 'pd_id';
    protected $allowedFields    = ['pd_nombre', 'pd_descripcion', 'pd_precio', 'pd_descuento','ct_id', 'pd_cantidad', "pd_img", "pd_activo"];

    protected $validationRules  = [

        "pd_nombre"         => "required|min_length[3]",
        "pd_descripcion"    => "required|max_length[250]",
        "pd_precio"         => "required",
        "pd_descuento"      => "required",
        "ct_id"             => "required",
        "pd_cantidad"       => "required",
        "pd_img"            => "is_image[pd_Imagen]",
    ]; 

    protected $validationMessages = [

        "pd_nombre"         => [
            "required"      => 'Campo de nombre del producto es obligatorio',
            "min_length"    => 'El campo nombre del producto debe tener al menos 3 caracteres'
        ],
        "pd_descripcion"    => [
            "required"      => 'Campo de descripción es obligatorio',
            "max_length"    => 'El campo descripción debe tener como máximo 250 caracteres'
        ],
        "pd_precio"         => [
            "required"      => 'Campo de precio es obligatorio',
        ],
        "pd_descuento"      => [
            "required"      => 'Campo de categoria es obligatorio',
        ],
        "ct_id"             => [
            "required"      => 'Campo de categoria es obligatorio',
        ],
        "pd_cantidad"       => [
            "required"      => 'El campo de cantidad es obligatorio',
        ],
        "pd_img"            => [
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