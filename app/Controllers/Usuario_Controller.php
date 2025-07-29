<?php
namespace App\Controllers;
use App\Models\usuarios_model;
use CodeIgniter\Controller;

class Usuario_controller extends Controller {

    public function __construct() {
        helper(['form', 'url']);
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
                'baja'  => 'NO',
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
                $userModel = new usuarios_model();
                $datosUser = $userModel->where('usuario', $_POST['usuario'])->first();

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
        return redirect()->to(base_url('').'/');
    }

    // Mostrar todos los usuarios no eliminados
    public function index() {
        $modelo = new usuarios_model();
        $data['usuarios'] = $modelo->where('baja', 'NO')->findAll();
        $data['titulo'] = 'Listado de Usuarios';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Crud_usuarios', $data);
        echo view('Footer');
    }

    // Mostrar formulario de edición
    public function editar($id = null) {
        $modelo = new usuarios_model();
        $data['usuario'] = $modelo->where('id_usuario', $id)->first();

        if (!$data['usuario']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Usuario no encontrado');
        }

        $dato['titulo'] = 'Editar Usuario';
        echo view("Header", $dato);
        echo view("Barradenavegacion");
        echo view("formularios", $data);
        echo view("Footer");
    }
    
    public function actualizar($id) {
        $modelo = new usuarios_model();
    
        // Obtener los datos actuales
        $usuarioExistente = $modelo->find($id);
        if (!$usuarioExistente) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Usuario no encontrado');
        }
    
        // Recoger los datos enviados por POST
        $datosForm = [
            'nombre'    => $this->request->getPost('nombre'),
            'apellido'  => $this->request->getPost('apellido'),
            'usuario'   => $this->request->getPost('usuario'),
            'email'     => $this->request->getPost('email'),
            'perfil_id' => $this->request->getPost('perfil'),
        ];
    
        // Eliminar campos vacíos o que no cambiaron (opcional)
        $datosActualizados = [];
        foreach ($datosForm as $campo => $valor) {
            if ($valor !== null && $valor !== '' && $valor !== $usuarioExistente[$campo]) {
                $datosActualizados[$campo] = $valor;
            }
        }
    
        // Solo actualizar si hay cambios
        if (!empty($datosActualizados)) {
            $modelo->update($id, $datosActualizados);
            session()->setFlashdata('success', 'Usuario actualizado correctamente');
        } else {
            session()->setFlashdata('info', 'No se realizaron cambios en el usuario');
        }
    
        return redirect()->to(base_url('Crud_usuarios'));
    }
    

    // Eliminar usuario (lógico)
    public function eliminar($id) {
        $modelo = new usuarios_model();
        $modelo->update($id, ['baja' => 'SI']);
        session()->setFlashdata('success', 'Usuario eliminado correctamente');
        return redirect()->to(base_url('Crud_usuarios'));
    }

    // Mostrar usuarios eliminados
    public function eliminados() {
        $modelo = new usuarios_model();
        $data['usuarios'] = $modelo->where('baja', 'SI')->findAll();
        $data['titulo'] = 'Usuarios Eliminados';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Usuarios_Eliminados', $data);
        echo view('Footer');
    }

    // Reactivar usuario eliminado
    public function activar($id) {
        $modelo = new usuarios_model();
        $modelo->update($id, ['baja' => 'NO']);
        session()->setFlashdata('success', 'Usuario activado correctamente');
        return redirect()->to(base_url('usuariosEliminados'));
    }

    public function clienteEditar()
{
    $session = session();
    $id = $session->get('id');

    $modelo = new Usuarios_model();
    $usuario = $modelo->find($id);

    if (!$usuario) {
        return redirect()->to('listado-productos')->with('mensaje', 'Usuario no encontrado');
    }

    return view('Header')
    . view('Barradenavegacion')
    . view('clienteEditar', ['usuario' => $usuario])
    . view('Footer');
}


    public function clienteActualizar()
    {
        $session = session();
    $id = $session->get('id');

    $modelo = new usuarios_model();

    $nombre = $this->request->getPost('nombre');
    $apellido = $this->request->getPost('apellido');
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('contraseña');
    $password_confirm = $this->request->getPost('contraseña_confirm');

    $datos = [
        'nombre'   => $nombre,
        'apellido' => $apellido,
        'email'    => $email
    ];

    // Validar y agregar nueva contraseña solo si fue proporcionada
    if (!empty($password)) {
        if ($password !== $password_confirm) {
            return redirect()->back()->withInput()->with('mensaje', 'Las contraseñas no coinciden.');
        }

        if (strlen($password) < 6) {
            return redirect()->back()->withInput()->with('mensaje', 'La contraseña debe tener al menos 6 caracteres.');
        }

        $datos['contraseña'] = password_hash($password, PASSWORD_DEFAULT);
    }
    if ($modelo->update($id, $datos)) {
        $session->set(['nombre' => $nombre, 'apellido' => $apellido, 'email' => $email]);
        return redirect()->to('clienteEditar')->with('mensaje', 'Datos actualizados correctamente.');
    } else {
        return redirect()->back()->with('mensaje', 'Error al actualizar los datos.');
    }
    }    




}
