<?php

namespace App\Controllers;

use App\Models\productos_model;
use App\Models\VentasCabeceraModel;
use App\Models\VentasDetalleModel;
use CodeIgniter\Controller;

class CarritoController extends Controller
{
    public function index()
    {
        $session = session();

        if (!$session->has('id')) {
            return redirect()->to('/login')->with('mensaje', 'Debes iniciar sesión para ver el carrito.');
        }

        $carrito = $session->get('carrito') ?? [];

        return view('plantillas/header', ['titulo' => 'Carrito'])
            . view('plantillas/navbar')
            . view('front/carrito', ['carrito' => $carrito])
            . view('plantillas/footer');
    }

    public function agregar($producto_id)
    {
        $productoModel = new productos_model();
        $producto = $productoModel->find($producto_id);
        $session = session();

        if (!$producto || !$session->has('id')) {
            return redirect()->to('/')->with('mensaje', 'Producto no encontrado o usuario no logueado.');
        }

        $carrito = $session->get('carrito') ?? [];

        $encontrado = false;
        foreach ($carrito as &$item) {
            if ($item['producto_id'] == $producto_id) {
                if ($item['cantidad'] < $producto['cantidad']) {
                    $item['cantidad'] += 1;
                }
                $encontrado = true;
                break;
            }
        }

        if (!$encontrado) {
            $carrito[] = [
                'producto_id' => $producto['producto_id'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1,
                'stock' => $producto['cantidad']
            ];
        }

        $session->set('carrito', $carrito);
        return redirect()->to('/carrito');
    }

    public function actualizarCantidad()
    {
        $session = session();
        $producto_id = $this->request->getPost('producto_id');
        $cantidad = (int)$this->request->getPost('cantidad');

        $productoModel = new productos_model();
        $producto = $productoModel->find($producto_id);
        $carrito = $session->get('carrito') ?? [];

        foreach ($carrito as &$item) {
            if ($item['producto_id'] == $producto_id) {
                if ($cantidad <= $producto['cantidad']) {
                    $item['cantidad'] = $cantidad;
                } else {
                    $item['cantidad'] = $producto['cantidad'];
                }
                break;
            }
        }

        $session->set('carrito', $carrito);
        return redirect()->to('carrito');
    }

    public function eliminar($index)
    {
        $session = session();
        $carrito = $session->get('carrito');

        if (isset($carrito[$index])) {
            unset($carrito[$index]);
            $session->set('carrito', array_values($carrito));
        }

        return redirect()->to('carrito');
    }

    public function vaciar()
    {
        session()->remove('carrito');
        return redirect()->to('carrito');
    }

    public function finalizarCompra()
    {
        $session = session();
        $carrito = $session->get('carrito') ?? [];
        $idUsuario = $session->get('id');

        if (empty($carrito) || !$idUsuario) {
            return redirect()->to('carrito')->with('mensaje', 'Carrito vacío o usuario no logueado.');
        }

        $productoModel = new productos_model();
        $ventaCabecera = new VentasCabeceraModel();
        $ventaDetalle = new VentasDetalleModel();


        foreach ($carrito as $item) {
            $producto = $productoModel->find($item['producto_id']);
            if (!$producto || $producto['cantidad'] < $item['cantidad']) {
                return redirect()->to('carrito')->with('mensaje', 'Stock insuficiente para: ' . $item['nombre']);
            }
        }


        $total = array_sum(array_map(function ($item) {
            return $item['precio'] * $item['cantidad'];
        }, $carrito));


        $ventaCabecera->insert([
            'fecha' => date('Y-m-d H:i:s'),
            'total_venta' => $total,
            'usuario_id' => $idUsuario
        ]);
        $idVenta = $ventaCabecera->insertID();


        foreach ($carrito as $item) {
            $ventaDetalle->insert([
                'venta_id' => $idVenta,
                'producto_id' => $item['producto_id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio']
            ]);

            $producto = $productoModel->find($item['producto_id']);
            $productoModel->update($item['producto_id'], [
                'cantidad' => $producto['cantidad'] - $item['cantidad']
            ]);
        }

        $session->remove('carrito');

        return redirect()->to('carrito')->with('mensaje', '¡Compra realizada con éxito!');
    }
}
