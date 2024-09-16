<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoomsModel;

class RoomsController extends BaseController
{
    public function index()
    {
        $model = new RoomsModel();

        // Obtener los salones utilizando el método getRooms
        $result = $model->getRooms();

        // Verificar si hay un error en la respuesta
        if (isset($result['status']) && $result['status'] === 'error') {
            // Manejar el error, podrías mostrar un mensaje o redirigir a una página de error
            return view('template/header', ['title' => 'Error'])
                . view('errors/custom_error', ['message' => $result['error']])
                . view('template/footer');
        }

        // Si no hay errores, pasar los salones a la vista
        $data = [
            'title' => 'Salones',
            'rooms' => $result['data'] // Pasar los salones si todo está bien
        ];

        return view('template/header', $data)
            . view('system/admin/salones', $data)
            . view('template/footer');
    }
}
