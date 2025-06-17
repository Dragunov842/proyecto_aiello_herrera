<?php

namespace App\Models;
use CodeIgniter\Model;

class Usuarios_model extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['nombre', 'apellido', 'email', 'usuario', 'contraseña', 'perfil_id', 'baja'];


 protected $validationRules = [
        "nombre"       => "required|min_length[3]|max_length[50]",
        "apellido"   => "required|min_length[3]|max_length[50]",
        "email"      => "required|valid_email|is_unique[usuarios.email,id_usuario,{id_usuario}]", 
        "usuario"      => "required|is_unique[usuarios.usuario,id_usuario,{id_usuario}]",
        "contraseña" => "permit_empty|min_length[4]",
        "perfil_id"  => "required|is_natural_no_zero",
    ];  

    protected $validationMessages = [
            "nombre"           => [
            "required"      => 'Campo nombre obligatorio',
            "min_length"    => 'El Nombre debe tener mínimo 3 caracteres',
            "max_length"    => 'El Nombre debe tener máximo 50 caracteres',
        ],
        "apellido"       => [
            "required"      => 'Campo apellido obligatorio',
            "min_length"    => 'El Apellido debe tener mínimo 3 caracteres',
            "max_length"    => 'El Apellido debe tener máximo 50 caracteres',
        ],
        "email" => [
            "required"      => 'Campo email electrónico obligatorio',
            "valid_email"   => 'Debe ingresar una dirección de correo válida',
            "is_unique"     => 'Dirección de correo ya asociada a una cuenta',
        ],

        "usuario"           => [
            "required"      => 'Campo usuario obligatorio',
            "is_unique"     => 'Nombre de usuario ya existente',
        ],
        
    ];

    public function buscarUsuarios($term)
    {
        $builder = $this->db->table($this->table);
        $builder->where('baja IS NULL');
        $builder->groupStart();
        $builder->like('nombre', $term);
        $builder->orLike('apellido', $term);
        $builder->orLike('email', $term);
        $builder->orLike('usuario', $term);
        $builder->groupEnd();

        return $builder->get()->getResultArray();
    }
    public function getUsuariosActivos()
    {
        return $this->where('baja', null)->findAll();
    }
}