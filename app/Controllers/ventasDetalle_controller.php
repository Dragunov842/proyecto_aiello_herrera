<?php

namespace App\Controllers;

use App\Models\ventasDetalle_model;
use App\Models\ventasCabecera_model;
use App\Models\productos_model;
use App\Models\usuarios_model;
use CodeIgniter\Controller;



class ventasDetalle_controller extends Controller
{

    public function verDetalle($ventaId)
    {
        $ventaModel = new ventasCabecera_model();
        $detalleModel = new ventasDetalle_model();
        $productoModel = new productos_model();
        $usuarioModel = new usuarios_model();

        $venta = $ventaModel->find($ventaId);

        if (!$venta) {
            return redirect()->back()->with('error', 'Venta no encontrada');
        }

        $usuario = $usuarioModel->find($venta['usuario_id']);

        $detalles = $detalleModel->where('ventas_id', $ventaId)->findAll();

        $detalleConProductos = [];

        foreach ($detalles as $detalle) {
            $producto = $productoModel->find($detalle['producto_id']);

            $detalleConProductos[] = [
                'producto_descripcion' => $producto['nombre_prod'] ?? 'Producto desconocido',
                'cantidad' => $detalle['cantidad'],
                'precio' => $detalle['precio']
            ];
        }

        return view('Header')
        . view('Barradenavegacion')
        . view('ventasDetalle', [
            'venta' => $venta,
            'usuario' => $usuario,
            'detalles' => $detalleConProductos
        ])
        . view('Footer');
    }

    public function crear($ventaId, $productoId, $cantidad, $precio)
    {
        $detalleModel = new ventasDetalle_model();

        return $detalleModel->insert([
            'venta_id' => $ventaId,
            'producto_id' => $productoId,
            'cantidad' => $cantidad,
            'precio' => $precio
        ]);
    }


    public function ventaDetalle()
    {
        $session = session();

        if (!$session->has('id')) {
        
            return redirect()->to('login')->with('error', 'Debes iniciar sesión para ver el detalle de la venta.');
        }

        $usuarioModel = new usuarios_model();
        $productoModel = new productos_model();

        $carrito = $session->get('carrito') ?? [];
        $usuario = $usuarioModel->find($session->get('id'));

        $detalle = [];
        foreach ($carrito as $item) {
            $producto = $productoModel->find($item['id']);

            $detalle[] = [
                'descripcion' => $producto['nombre_prod'] ?? 'Producto desconocido',
                'cantidad' => $item['cantidad'],
                'precio' => $producto['precio'] ?? 0
            ];
        }
    

        return view('Header')
        . view('Barradenavegacion')
        . view('ventasUsuario', [
            'usuario' => $usuario,
            'detalle' => $detalle
        ])
        . view('Footer');
    }

    public function descargarFactura($ventaId)
    {
        // Cargar modelos
        $ventaModel = new ventasCabecera_model();
        $usuarioModel = new usuarios_model();
        $detalleModel = new ventasDetalle_model();

        // Obtener datos
        $venta = $ventaModel->find($ventaId);
        $usuario = $usuarioModel->find($venta['usuario_id']);
        $detalles = $detalleModel->where('ventas_id', $ventaId)->findAll();

        // Cargar Dompdf manualmente
        require_once(APPPATH . 'Libraries/dompdf/autoload.inc.php');

        // Inicializar Dompdf
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true); // para permitir imágenes externas
        $dompdf = new \Dompdf\Dompdf($options);

        // Generar HTML desde la vista
        $html = view('factura', [
            'venta' => $venta,
            'usuario' => $usuario,
            'detalles' => $detalles
        ]);

        // Generar PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Descargar el PDF
        return $dompdf->stream("Factura_Venta_{$ventaId}.pdf", ["Attachment" => true]);
    }

}
    

