<?php
namespace App\Controllers;
use App\Models\usuarios_model;
use CodeIgniter\Controller;

class Usuario_controller extends Controller {

    protected $modelo;

    public function __construct() {
    helper(['form', 'url']);
    $this->modelo = new \App\Models\Usuarios_model();
    }


    // Mostrar formulario de registro
    public function create() {
        $dato['titulo'] = 'registrar';
        echo view('Header', $dato);
        echo view('Barradenavegacion');
        echo view('Formulario_usuario');
        echo view('Footer');
    }

    // Guardar nuevo usuario
    public function formValidation() {
        $input = $this->validate([
            'nombre'     => 'required|min_length[3]',
            'apellido'   => 'required|min_length[3]|max_length[25]',
            'usuario'    => 'required|min_length[3]',
            'email'      => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'contraseña' => 'required|min_length[3]|max_length[10]'
        ]);

        if (!$input) {
            $data['titulo'] = 'registrar';
            echo view('Header', $data);
            echo view('Barradenavegacion');
            echo view('Formulario_usuario', ['validation' => $this->validator]);
            echo view('Footer');
        } else {
            $this->modelo->save([
                'nombre'     => $this->request->getVar('nombre'),
                'apellido'   => $this->request->getVar('apellido'),
                'usuario'    => $this->request->getVar('usuario'),
                'email'      => $this->request->getVar('email'),
                'contraseña' => password_hash($this->request->getVar('contraseña'), PASSWORD_DEFAULT),
                'perfil_id'  => $this->request->getVar('perfil_id'),
                'baja'       => 'NO',
            ]);

            session()->setFlashdata('success', 'Usuario registrado con éxito');
            return redirect()->route('productos');
        }
    }

    // Mostrar formulario de login
    public function login() {
        $data = ["titulo" => "Leblanc - Iniciar Sesión"];
        echo view("Header", $data);
        echo view("Barradenavegacion");
        echo view("Login");
        echo view("Footer");
    }

    // Procesar login
    public function inicioSesion() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $critValidacion = $this->validate([
                "usuario"    => "required",
                "contraseña" => "required"
            ], [
                "usuario" => ["required" => 'Campo de usuario obligatorio'],
                "contraseña" => ["required" => 'Campo de contraseña obligatorio']
            ]);

            if ($critValidacion) {
                $datosUser = $this->modelo->where('usuario', $_POST['usuario'])->first();

                if ($datosUser != null && password_verify($_POST['contraseña'], $datosUser['contraseña'])) {
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
                    $datos['errores'] = "Usuario o contraseña incorrectos";
                }
            } else {
                $datos["validation"] = $this->validator->getErrors();
            }

            $data = ["titulo" => "Leblanc - Iniciar Sesión"];
            echo view("Header", $data);
            echo view("Barradenavegacion");
            echo view("Login", $datos ?? []);
            echo view("Footer");
        }
    }

    // Cerrar sesión
    public function cerrarSesion() {
        session()->destroy();
        return redirect()->to(base_url(''));
    }

    // Mostrar todos los usuarios no eliminados
    public function index() {
        $data['usuarios'] = $this->modelo->where('baja', 'NO')->findAll();
        $data['titulo'] = 'Listado de Usuarios';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Crud_usuarios', $data);
        echo view('Footer');
    }

    // Mostrar formulario para que el usuario edite sus datos
    public function editar() {
        $id_usuario = session('id');

        if (!$id_usuario) {
            session()->setFlashdata('error', 'Debes iniciar sesión para editar tu perfil.');
            return redirect()->to('login');
        }

        $usuario = $this->modelo->find($id_usuario);

        if (!$usuario) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Usuario no encontrado');
        }

        $data = [
            'titulo' => 'Editar Perfil',
            'usuario' => $usuario
        ];

        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('formularios', $data);
        echo view('Footer');
    }

    
    // Actualizar los datos del usuario
public function actualizar() {
    $id_usuario = session('id');

    $nombre     = $this->request->getPost('nombre');
    $apellido   = $this->request->getPost('apellido');
    $email      = $this->request->getPost('email');
    $contraseña = $this->request->getPost('contraseña');

    $data = [
        'id_usuario' => $id_usuario, // NECESARIO para validación única
        'nombre'     => $nombre,
        'apellido'   => $apellido,
        'email'      => $email,
    ];

    if (!empty($contraseña)) {
        $data['contraseña'] = password_hash($contraseña, PASSWORD_BCRYPT);
    }

    if ($this->modelo->update($id_usuario, $data)) {
        session()->set('nombre', $nombre);
        session()->set('apellido', $apellido);
        session()->set('email', $email);

        return redirect()->to('/')->with('mensaje', 'Datos actualizados correctamente.');
    } else {
        return redirect()->back()->withInput()->with('validation', $this->modelo->errors());
    }
}


    // Eliminar usuario (lógico)
    public function eliminar($id) {
        $this->modelo->update($id, ['baja' => 'SI']);
        session()->setFlashdata('success', 'Usuario eliminado correctamente');
        return redirect()->to(base_url('Crud_usuarios'));
    }

    // Mostrar usuarios eliminados
    public function eliminados() {
        $data['usuarios'] = $this->modelo->where('baja', 'SI')->findAll();
        $data['titulo'] = 'Usuarios Eliminados';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Usuarios_Eliminados', $data);
        echo view('Footer');
    }

    // Reactivar usuario eliminado
    public function activar($id) {
        $this->modelo->update($id, ['baja' => 'NO']);
        session()->setFlashdata('success', 'Usuario activado correctamente');
        return redirect()->to(base_url('usuariosEliminados'));
    }
}
