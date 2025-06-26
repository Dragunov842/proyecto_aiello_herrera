<?php

namespace App\Controllers;

use App\Models\VentasDetalleModel;
use App\Models\VentasCabeceraModel;
use App\Models\productos_model;
use App\Models\usuarios_model;
use CodeIgniter\Controller;

class VentasDetalleController extends Controller
{

    public function verDetalle($ventaId)
    {
        $ventaModel = new VentasCabeceraModel();
        $detalleModel = new VentasDetalleModel();
        $productoModel = new productos_model();
        $usuarioModel = new usuarios_model();

        $venta = $ventaModel->find($ventaId);

        if (!$venta) {
            return redirect()->back()->with('error', 'Venta no encontrada');
        }

        $usuario = $usuarioModel->find($venta['usuario_id']);

        $detalles = $detalleModel->where('venta_id', $ventaId)->findAll();

        $detalleConProductos = [];

        foreach ($detalles as $detalle) {
            $producto = $productoModel->find($detalle['producto_id']);

            $detalleConProductos[] = [
                'producto_descripcion' => $producto['descripcion'] ?? 'Producto desconocido',
                'cantidad' => $detalle['cantidad'],
                'precio' => $detalle['precio']
            ];
        }

        return view('ventas/detalle', [
            'venta' => $venta,
            'usuario' => $usuario,
            'detalles' => $detalleConProductos
        ]);
    }

    public function crear($ventaId, $productoId, $cantidad, $precio)
    {
        $detalleModel = new VentasDetalleModel();

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
            $producto = $productoModel->find($item['idProducto']);

            $detalle[] = [
                'descripcion' => $producto['descripcion'] ?? 'Producto desconocido',
                'cantidad' => $item['cantidad'],
                'precio' => $producto['precio'] ?? 0
            ];
        }


        return view('ventasDetalle', [
            'usuario' => $usuario,
            'detalle' => $detalle
        ]);
    }
}
