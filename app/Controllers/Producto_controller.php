<?php
namespace App\Controllers;
use App\Models\Usuario_model;
use App\Models\productos_model;
use CodeIgniter\Controller;
use App\Models\categorias_model;

class Producto_controller extends Controller {

    public function __construct() {
        helper(['form', 'url']);
        $session = session();
    }

    //mostrar los productos en lista
    public function mostrar()
    {
        $productoModel = new productos_Model();
        //realizo la consulta para mostrar todos los productos
        $data['producto'] = $productoModel->getProductos(); //funcion en el modelo

        $dato['titulo'] = 'Crud_productos';
        echo view("Header", $dato);
        echo view("Barradenavegacion");
        echo view("Crud_productos");
        echo view("footer");
    }

    // Mostrar formulario de registro
    public function crearProducto() {
        $categoriasmodel = new categorias_model();
        $data['categorias'] = $categoriasmodel->getCategorias();

        $productoModel = new productos_Model();
        $data['producto'] = $productoModel->getProductos();

        $dato['titulo']='Alta producto';
        echo view("Header", $dato);
        echo view("Barradenavegacion");
        echo view("Formulario_producto",$data);
        echo view("Footer");

    }
    // Guardar nuevo usuario
     public function Store() {

        $input = $this->validate([
        'nombre_prod'    => 'required|min_length[3]',
        'imagen'         => 'uploaded[imagen]|is_image[imagen]|max_size[imagen,4096]',
        'categoria_id'   => 'required|is_not_unique[categorias.id]',
        'precio'         => 'required|numeric',
        'precio_vta'     => 'required|numeric',
        'stock'          => 'required',
        'stock_min'      => 'required',

        ]);

        $productoModel = new productos_model(); //se instancia el modelo

        if (!$input) {
            $categoria_model = new categorias_model();
            $data['categorias'] = $categoria_model->getCategorias();
            $data['validation'] = $this->validator;

            $dato['titulo'] = 'Alta';
            echo view('Header', $dato);
            echo view('Barradenavegacion');
            echo view('Formulario_producto', $data );
            echo view('Footer');
        } else {
            $img = $this-> request->getFile('imagen');
            //este codigo genera un numero aleatorio para el archivo
            $nombre_aleatorio = $img->getRandomName();
            //mueve el archivo de imagen a una uicacion especifica en el servido metodo Move()
            $img ->move(ROOTPATH.'assets/uploads', $nombre_aleatorio);

            $data = [
                'nombre_prod' => $this->request->getVar('nombre_prod'),
                'imagen'      => $nombre_aleatorio, 
                'categoria_id'=> $this->request->getVar('categoria_id'),
                'precio'      => $this->request->getVar('precio'),
                'precio_vta'  => $this->request->getVar('precio_vta'),
                'stock'       => $this->request->getVar('stock'),
                'stock_min'   => $this->request->getVar('stock_min'),
                'eliminado'   => 'NO',
            ];
            $productoModel = new productos_model();
            $productoModel->insert($data);
            session()->setFlashdata('success', 'Producto registrado con éxito');
            return redirect()->route('listado-productos');
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
        $data['productos'] = $modelo->where('eliminado', 'NO')->findAll();
        $data['titulo'] = 'Listado de Productos';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Crud_productos', $data);
        echo view('Footer');
    }

    // Mostrar formulario de edición
    public function editar($id) {
        $modelo = new usuarios_model();
        $data['usuario'] = $modelo->find($id);

        if (!$data['usuario']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Usuario no encontrado');
        }

        $data['titulo'] = 'Editar Usuario';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Formulario_usuario', $data);
        echo view('Footer');
    }

    // Actualizar usuario
    public function actualizar($id) {
        $modelo = new usuarios_model();

        $input = $this->validate([
            'nombre'   => 'required|min_length[3]',
            'apellido' => 'required|min_length[3]|max_length[25]',
            'usuario'  => 'required|min_length[3]',
            'email'    => 'required|min_length[4]|max_length[100]|valid_email'
        ]);

        if (!$input) {
            $data['validation'] = $this->validator;
            $data['usuario'] = $modelo->find($id);
            $data['titulo'] = 'Editar Usuario';
            echo view('Header', $data);
            echo view('Barradenavegacion');
            echo view('Formulario_usuario', $data);
            echo view('Footer');
        } else {
            $datos = [
                'nombre'    => $this->request->getVar('nombre'),
                'apellido'  => $this->request->getVar('apellido'),
                'usuario'   => $this->request->getVar('usuario'),
                'email'     => $this->request->getVar('email'),
                'perfil_id' => $this->request->getVar('perfil_id')
            ];

            if ($this->request->getVar('contraseña')) {
                $datos['contraseña'] = password_hash($this->request->getVar('contraseña'), PASSWORD_DEFAULT);
            }

            $modelo->update($id, $datos);
            session()->setFlashdata('success', 'Usuario actualizado correctamente');
            return redirect()->to(base_url('usuarios'));
        }
    }

    // Eliminar usuario (lógico)
    public function eliminar($id) {
        $modelo = new usuarios_model();
        $modelo->update($id, ['eliminado' => 'SI']);
        session()->setFlashdata('success', 'Usuario eliminado correctamente');
        return redirect()->to(base_url('usuarios'));
    }

    // Mostrar usuarios eliminados
    public function eliminados() {
        $modelo = new usuarios_model();
        $data['usuarios'] = $modelo->where('eliminado', 'SI')->findAll();
        $data['titulo'] = 'Usuarios Eliminados';
        echo view('Header', $data);
        echo view('Barradenavegacion');
        echo view('Usuarios_eliminados', $data);
        echo view('Footer');
    }

    // Reactivar usuario eliminado
    public function activar($id) {
        $modelo = new usuarios_model();
        $modelo->update($id, ['eliminado' => 'NO']);
        session()->setFlashdata('success', 'Usuario activado correctamente');
        return redirect()->to(base_url('usuarios/eliminados'));
    }
}
