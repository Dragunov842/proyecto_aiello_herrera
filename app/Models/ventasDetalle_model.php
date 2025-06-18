<?php

namespace App\Models;

use CodeIgniter\Model;

class VentasDetalleModel extends Model
{
    protected $table = 'ventas_detalle';   
    protected $primaryKey = 'id';         

    protected $allowedFields = [
        'venta_id',      
        'producto_id',   
        'cantidad',      
        'precio'        
    ];

    protected $useTimestamps = false; 

    protected $validationRules = [
        'venta_id'    => 'required|integer',
        'producto_id' => 'required|integer',
        'cantidad'    => 'required|integer|greater_than[0]',
        'precio'      => 'required|decimal'
    ];

    protected $validationMessages = [
        'venta_id' => [
            'required' => 'El ID de la venta es obligatorio',
            'integer'  => 'El ID de la venta debe ser un número entero',
        ],
        'producto_id' => [
            'required' => 'El ID del producto es obligatorio',
            'integer'  => 'El ID del producto debe ser un número entero',
        ],
        'cantidad' => [
            'required'    => 'La cantidad es obligatoria',
            'integer'     => 'La cantidad debe ser un número entero',
            'greater_than'=> 'La cantidad debe ser mayor que cero',
        ],
        'precio' => [
            'required' => 'El precio es obligatorio',
            'decimal'  => 'El precio debe ser un número decimal válido',
        ],
    ];
}

