<?php

namespace App\Models;
use CodeIgniter\Model;

class contacto_model extends Model
{
    protected $table = 'contacto';
    protected $primaryKey = 'id';
    protected $allowedFields = ['correo', 'tipo', 'descripcion', 'leido'];
}
