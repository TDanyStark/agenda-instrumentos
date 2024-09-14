<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InstrumentsModel;

class InstrumentsController extends BaseController
{
    public function index()
    {
        $instrumentsModel = new InstrumentsModel();

        // Obtener los instrumentos utilizando el método getInstruments
        $result = $instrumentsModel->getInstruments();

        // Verificar si hay un error en la respuesta
        if (isset($result['status']) && $result['status'] === 'error') {
            // Manejar el error mostrando una vista personalizada
            return view('template/header', ['title' => 'Error'])
                . view('errors/custom_error', ['message' => $result['error']])
                . view('template/footer');
        }

        // Pasar los instrumentos a la vista si no hay errores
        $data = [
            'title' => 'Instrumentos',
            'instruments' => $result['data']->getResult() // Pasar los instrumentos si todo está bien
        ];

        return view('template/header', $data)
            . view('system/admin/instrumentos', $data)
            . view('template/footer');
    }
}
