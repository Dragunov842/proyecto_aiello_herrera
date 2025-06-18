<?php

namespace App\Models;
use CodeIgniter\Model;

class Usuarios_model extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    
    // Campos permitidos para insert/update
    protected $allowedFields = [
        'nombre',
        'apellido',
        'email',
        'usuario',
        'contraseña',
        'perfil_id',
        'baja'
    ];

    // Reglas de validación
    protected $validationRules = [
        "id_usuario" => "permit_empty",
        'nombre'     => 'required|min_length[3]|max_length[50]',
        'apellido'   => 'required|min_length[3]|max_length[50]',
        'email'      => 'required|valid_email|is_unique[usuarios.email,id_usuario,{id_usuario}]',
        'usuario'    => 'required|is_unique[usuarios.usuario,id_usuario,{id_usuario}]',
        'contraseña' => 'permit_empty|min_length[4]',
        'perfil_id'  => 'permit_empty|is_natural_no_zero',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required'    => 'El campo nombre es obligatorio',
            'min_length'  => 'El nombre debe tener al menos 3 caracteres',
            'max_length'  => 'El nombre debe tener como máximo 50 caracteres'
        ],
        'apellido' => [
            'required'    => 'El campo apellido es obligatorio',
            'min_length'  => 'El apellido debe tener al menos 3 caracteres',
            'max_length'  => 'El apellido debe tener como máximo 50 caracteres'
        ],
        'email' => [
            'required'    => 'El campo email es obligatorio',
            'valid_email' => 'Debe ingresar un email válido',
            'is_unique'   => 'Este email ya está en uso'
        ],
        'usuario' => [
            'required'    => 'El campo usuario es obligatorio',
            'is_unique'   => 'Este nombre de usuario ya está en uso'
        ],
        'contraseña' => [
            'min_length'  => 'La contraseña debe tener al menos 4 caracteres',
        ]
    ];

    // Métodos personalizados
    public function buscarUsuarios($term)
    {
        return $this->where('baja', 'NO')
                    ->groupStart()
                        ->like('nombre', $term)
                        ->orLike('apellido', $term)
                        ->orLike('email', $term)
                        ->orLike('usuario', $term)
                    ->groupEnd()
                    ->findAll();
    }

    public function getUsuariosActivos()
    {
        return $this->where('baja', 'NO')->findAll();
    }
}
