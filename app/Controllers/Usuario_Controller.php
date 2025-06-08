<?php
namespace App\Controllers;
use App\Models\usuarios_model;
use CodeIgniter\Controller;

class Usuario_controller extends Controller{

    public function __construct(){
        helper(['form', 'url']);
    }

    public function create() {
        $dato['titulo'] = 'registrar';
        echo view('Header', $dato);
        echo view('Barradenavegacion');
        echo view('Formulario_usuario');
        echo view('Footer');
    }

    public function formValidation() {

        $input = $this->validate([
            'nombre'    => 'required|min_length[3]',
            'apellido'  => 'required|min_length[3]|max_length[25]',
            'usuario'   => 'required|min_length[3]',
            'email'     => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'contraseña'  => 'required|min_length[3]|max_length[10]'
        ],
    );


$formModel = new usuarios_model();

if (!$input) {
    $data['titulo'] = 'registrar';
    echo view('Header', $data);
    echo view('Barradenavegacion');
    echo view('Formulario_usuario', ['validation' => $this->validator]);
    echo view('Footer');

} else {
$formModel->save([
    'nombre'     => $this->request->getVar('nombre'),
    'apellido'   => $this->request->getVar('apellido'),
    'usuario'    => $this->request->getVar('usuario'),
    'email'      => $this->request->getVar('email'),
    'contraseña' => password_hash($this->request->getVar('contraseña'), PASSWORD_DEFAULT),
    'perfil_id'  => $this->request->getVar('perfil_id'),
]);


    // Flashdata funciona solo en redirigir la función en el controlador en la vista de carga.
    session()->setFlashdata('success', 'Usuario registrado con exito');
    return redirect()->route('productos');  
    }
}
}
