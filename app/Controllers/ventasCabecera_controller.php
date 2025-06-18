<?php

namespace App\Controllers;

use App\Models\VentasCabeceraModel;
use CodeIgniter\Controller;

class VentasCabeceraController extends Controller
{

    public function crear($total, $usuarioId)
    {
        $ventaModel = new VentasCabeceraModel();

        $ventaModel->insert([
            'fecha' => date('Y-m-d H:i:s'),
            'total_venta' => $total,
            'usuario_id' => $usuarioId
        ]);

        return $ventaModel->insertID(); 
    }

    
    public function listarVentas()
    {
        $ventaModel = new VentasCabeceraModel();

        $ventas = $ventaModel->select('ventas_cabecera.*, usuarios.nombre, usuarios.apellido')
                             ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id')
                             ->orderBy('fecha', 'DESC')
                             ->findAll();

        $data['compras'] = $ventas;

        return view('Header')
            . view('ventasTotales', $data)
            . view('Footer');
    }
}
