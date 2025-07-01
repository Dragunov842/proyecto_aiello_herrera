<?php

namespace App\Controllers;

use App\Models\productos_model;
use App\Models\ventasCabecera_model;
use App\Models\ventasDetalle_model;
use CodeIgniter\Controller;

class Carrito_controller extends Controller
{
    public function index()
    {
        $session = session();

        if (!$session->has('id')) {
            return redirect()->to('/login')->with('mensaje', 'Debes iniciar sesión para ver el carrito.');
        }

        $carrito = $session->get('carrito') ?? [];

        return view('Header', ['titulo' => 'Carrito'])
            . view('Barradenavegacion')
            . view('carrito', ['carrito' => $carrito])
            . view('Footer');
    }

    public function agregar()
    {
        $session = session();
        $cart = $session->get('carrito') ?? [];

        $id = $this->request->getPost('id');
        $nombre = $this->request->getPost('nombre');
        $precio = $this->request->getPost('precio');
        $cantidad = (int) ($this->request->getPost('cantidad') ?? 1);

        // Si ya existe en el carrito, sumar cantidad
        if (isset($cart[$id])) {
            $cart[$id]['cantidad'] += 1;
        } else {
            $cart[$id] = [
                'id' => $id,
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad
            ];
        }

        $session->set('carrito', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function actualizarCantidad()
    {
        $session = session();
        $producto_id = $this->request->getPost('id');
        $cantidad = (int)$this->request->getPost('cantidad');

        $productoModel = new productos_model();
        $producto = $productoModel->find($producto_id);
        $carrito = $session->get('carrito') ?? [];
        $mensaje = null;
        foreach ($carrito as &$item) {
            if ($item['id'] == $producto_id) {
                if ($cantidad <= $producto['stock']) {
                    $item['cantidad'] = $cantidad;
                } else {
                    $item['cantidad'] = $producto['stock'];
                    $mensaje = 'No se pueden agregar más productos. Stock máximo alcanzado.';
                }
                break;
            }
        }

        $session->set('carrito', $carrito);
        if ($mensaje) {
            return redirect()->to('ver-carrito')->with('mensaje', $mensaje);
        }
        return redirect()->to('ver-carrito');
    }

    public function eliminar($index)
    {
        $session = session();
        $carrito = $session->get('carrito');

        if (isset($carrito[$index])) {
            unset($carrito[$index]);
            $session->set('carrito', $carrito);
        }

        return redirect()->to('ver-carrito');
    }

    public function vaciar()
    {
        session()->remove('carrito');
        return redirect()->to('ver-carrito');
    }

    public function finalizarCompra()
    {
        $session = session();
        $carrito = $session->get('carrito') ?? [];
        $idUsuario = $session->get('id');

        if (empty($carrito) || !$idUsuario) {
            return redirect()->to('ver-carrito')->with('mensaje', 'Carrito vacío o usuario no logueado.');
        }

        $productoModel = new productos_model();
        $ventaCabecera = new ventasCabecera_model();
        $ventaDetalle = new ventasDetalle_model();


        foreach ($carrito as $item) {
            $producto = $productoModel->find($item['id']);
            if (!$producto || $producto['stock'] < $item['cantidad']) {
                return redirect()->to('ver-carrito')->with('mensaje', 'Stock insuficiente para: ' . $item['nombre']);
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
                'ventas_id' => $idVenta,
                'producto_id' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio' => $item['precio']
            ]);

            $producto = $productoModel->find($item['id']);
            $productoModel->update($item['id'], [
                'stock' => $producto['stock'] - $item['cantidad']
            ]);
        }
        $session->remove('carrito');
        return redirect()->to('ver-carrito')->with('mensaje', '¡Compra realizada con éxito!');
    }
}
