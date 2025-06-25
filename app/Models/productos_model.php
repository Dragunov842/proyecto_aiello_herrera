<?php

namespace App\Models;

use CodeIgniter\Model;

class productos_model extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre_prod',
        'categoria_id',
        'precio',
        'precio_vta',
        'stock',
        'stock_min',
        'eliminado',
        'imagen',
    ];

    protected $returnType = 'array';
    protected $useTimestamps = false;

    protected $validationRules = [
        'nombre_prod' => 'required|min_length[3]',
        'categoria_id' => 'required|integer|greater_than[0]',
        'precio' => 'required|numeric',
        'precio_vta' => 'required|numeric',
        'stock' => 'required|integer',
        'stock_min' => 'required|integer',
        'imagen' => 'uploaded[imagen]|is_image[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/png]',
    ];
public function getBuilderProductos(){

    $db = \config\Database::connect();

    $builder = $db->table('productos');

    $builder->select('*');
    $builder->join('categorias', 'categorias.id = productos.categoria_id');

    return $builder;
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
        return $this->findAll();
    }

    public function getProducto($id = null){
        $builder = $this->getBuilderProductos();
        $builder->where('productos.id', $id);
        $query= $builder->get();
        return $query->getRowArray();
    }
    public function updateStock($id = null, $stock_actual = null){
        $builder = $this->getBuilderProductos();
        $builder->where('productos.id', $id);
        $builder->set('productos.stock', $stock_actual);
        $builder->update();
    }
    public function obtenerProductosActivos()
    {
        return $this->where('eliminado', 'NO')->findAll();
    }
}