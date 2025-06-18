<?php
namespace App\Models;

use CodeIgniter\Model;

class VentasCabeceraModel extends Model
{
    protected $table = 'ventas_cabecera';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fecha', 'total_venta', 'usuario_id'];
}
