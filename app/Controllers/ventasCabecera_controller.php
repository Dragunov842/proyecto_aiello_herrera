<?php

namespace App\Controllers;

use App\Models\ventasCabecera_model;
use CodeIgniter\Controller;

class ventasCabecera_controller extends Controller
{

    public function crear($total, $usuarioId)
    {
        $ventaModel = new ventasCabecera_model();

        $ventaModel->insert([
            'fecha' => date('Y-m-d H:i:s'),
            'total_venta' => $total,
            'usuario_id' => $usuarioId
        ]);

        return $ventaModel->insertID(); 
    }

    
    public function listarVentas()
    {
        $ventaModel = new ventasCabecera_model();

        $ventas = $ventaModel->select('ventas_cabecera.*, usuarios.nombre, usuarios.apellido')
                             ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id')
                             ->orderBy('fecha', 'DESC')
                             ->findAll();

        $data['ventas'] = $ventas;

        return view('Header')
            . view('Barradenavegacion')
            . view('ventasTotales', $data)
            . view('Footer');
    }

    public function historialCompras()
{
    $session = session();
    $id_usuario = $session->get('id');

    /* $ventasModel = new \App\Models\ventasCabecera_model();
    $ventas = $ventasModel->where('usuario_id', $id_usuario)->orderBy('fecha', 'DESC')->findAll();
    $data['ventas'] = $ventas; */

    $ventaModel = new ventasCabecera_model();

        $ventas = $ventaModel->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id')
                             ->where('ventas_cabecera.usuario_id', $id_usuario)
                             ->orderBy('fecha', 'DESC')
                             ->findAll();

        $data['ventas'] = $ventas;


    return view('Header')
    . view('Barradenavegacion') 
    . view('clienteHistorial', $data)
    . view('Footer');
}

}
