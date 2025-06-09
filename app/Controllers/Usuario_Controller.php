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

   public function login()
    {
        $data = ["titulo" => "Leblanc - Iniciar Sesión"];
        echo view('Header', $data);
        echo view("Login");
        echo view('Footer');
    }


    // Se verifica los datos ingresados para iniciar, si cumple la verificación inicia sesión
    public function inicioSesion()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $critValidacion = $this->validate(
            [
                "usuario"     => "required",
                "contraseña"  => "required"
            ],
            [
                "usuario" => [
                    "required" => 'Campo de usuario obligatorio',
                ],
                "contraseña" => [
                    "required" => 'Campo de contraseña obligatorio',
                ]
            ]
        );

        if ($critValidacion) {
            $userModel = new usuarios_model();
            $datosUser = $userModel->where('usuario', $_POST['usuario'])->first();

            if ($datosUser != null) {
                if (password_verify($_POST['contraseña'], $datosUser['contraseña'])) {
                    session()->set([
                        'id'         => $datosUser['id_usuario'],
                        'usuario'    => $datosUser['usuario'],
                        'perfil_id'  => $datosUser['perfil_id'],
                        'nombre'     => $datosUser['nombre'],
                        'apellido'   => $datosUser['apellido'],
                        'email'      => $datosUser['email'],
                        'is_logged'  => true
                    ]);

                    return redirect()->to(base_url(''))->with('alertaExitosa', 'Inicio de sesión exitoso!');
                } else {
                    $datos['errores'] = "Contraseña incorrecta";
                }
            } else {
                $datos['errores'] = "Usuario incorrecto";
            }
        } else {
            $datos["validation"] = $this->validator->getErrors();
        }

        $data = ["titulo" => "Leblanc - Iniciar Sesión"];
        echo view("Barradenavegacion", $data);
        echo view("Login", $datos ?? []);
        echo view("Footer");
    }
}

    
    // Se cierra la sesión
    public function cerrarSesion()
    {
        session()->destroy();
        return redirect()->to(base_url('').'/');
    }
}
