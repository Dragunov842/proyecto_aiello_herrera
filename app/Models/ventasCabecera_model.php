<?php
namespace App\Models;

use CodeIgniter\Model;

class ventasCabecera_model extends Model
{
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha', 'total_venta', 'usuario_id'];
}
