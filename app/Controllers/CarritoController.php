<?php namespace App\Controllers;

use CodeIgniter\Controller;

class CarritoController extends Controller
{
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
}
