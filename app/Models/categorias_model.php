<?php

namespace App\Models;
use CodeIgniter\Model;

class categorias_model extends Model
{
    protected $table= 'categorias';
    protected $primaryKey= 'id_categoria';
    protected $allowedFields    = ['nombre', 'descripcion','activo'];

    protected $validationMessages = [
        "ct_nombre"         => [
            "required"      => 'Campo de nombre obligatorio',
            "min_length"    => 'El campo nombre debe tener al menos 3 caracteres',
            "max_length"    => 'El campo nombre debe tener máximo 50 caracteres'
        ],
        "ct_descripcion"    => [
            "required"      => 'El campo de descripción es obligatorio',
            "max_length"    => 'El campo de descripción debe tener máximo 200 caracteres'
        ]
    ];

    public function obtenerCategorias($buscar = null)
    {
        if ($buscar) {
            $this->where('nombre LIKE', "%$buscar%");
        }
        return $this->findAll();
    }
}