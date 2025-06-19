<?php
namespace App\Models;

use CodeIgniter\Model;

class productos_model extends Model
{
    protected $table         = 'productos';
    protected $primaryKey    = 'id';
    protected $allowedFields = [
        'nombre_prod',
        'descripcion',
        'imagen',
        'categoria_id',
        'precio',
        'precio_vta',
        'stock',
        'stock_min',
        'eliminado'
    ];

    protected $validationRules = [
        'nombre_prod'   => 'required|min_length[3]',
        'descripcion'   => 'required|max_length[250]',
        'precio'        => 'required|decimal',
        'precio_vta'    => 'required|decimal',
        'categoria_id'  => 'permit_empty|integer',
        'stock'         => 'required|integer',
        'stock_min'     => 'required|integer',
        'imagen'        => 'permit_empty|is_image[imagen]|max_size[imagen,4096]',
        'eliminado'     => 'permit_empty|in_list[0,1]',
    ];

    protected $validationMessages = [
        'nombre_prod' => [
            'required'   => 'El nombre es obligatorio',
            'min_length' => 'El nombre debe tener al menos 3 caracteres',
        ],
        'descripcion' => [
            'required'   => 'La descripción es obligatoria',
            'max_length' => 'La descripción debe tener máximo 250 caracteres',
        ],
        'precio' => [
            'required' => 'El precio es obligatorio',
            'decimal'  => 'El precio debe ser un número decimal válido',
        ],
        'precio_vta' => [
            'required' => 'El precio de venta es obligatorio',
            'decimal'  => 'El precio de venta debe ser un número decimal válido',
        ],
        'categoria_id' => [
            'integer'  => 'La categoría debe ser un número entero',
        ],
        'stock' => [
            'required' => 'El stock es obligatorio',
            'integer'  => 'El stock debe ser un número entero',
        ],
        'stock_min' => [
            'required' => 'El stock mínimo es obligatorio',
            'integer'  => 'El stock mínimo debe ser un número entero',
        ],
        'imagen' => [
            'is_image' => 'El archivo debe ser una imagen válida',
            'max_size' => 'La imagen no puede superar los 4MB',
        ],
        'eliminado' => [
            'in_list' => 'El campo eliminado debe ser 0 o 1',
        ],
    ];

    public function desvalidarImagen()
    {
        unset($this->validationRules['imagen']);
    }

    public function getAllProductosByCategoria($categoriaId)
    {
        return $this->where('categoria_id', $categoriaId)
                    ->where('eliminado', 0)
                    ->findAll();
    }

    public function buscarProductos($buscar = null)
    {
        $builder = $this->db->table('productos p');
        $builder->select('p.*, c.nombre as categoria_nombre');
        $builder->join('categorias c', 'p.categoria_id = c.id', 'left');

        if ($buscar) {
            $builder->like('p.nombre_prod', $buscar);
            $builder->orLike('c.nombre', $buscar);
        }

        return $builder->get()->getResultArray();
    }

    public function obtenerProductosActivos()
    {
        return $this->where('eliminado', 0)->findAll();
    }
}
