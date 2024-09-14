<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InstrumentsModel;
use App\Models\ProfessorsModel;
use App\Models\RoomsModel;

class ProfessorsController extends BaseController
{
    public function index()
    {
        $professorsModel = new ProfessorsModel();
        $instrumentModel = new InstrumentsModel();
        $roomsModel = new RoomsModel();

        // Parameter get
        $modal = $this->request->getGet('modal');

        // Obtener los profesores
        $professorsResult = $professorsModel->getProfessors();
        if (isset($professorsResult['status']) && $professorsResult['status'] === 'error') {
            return view('template/header', ['title' => 'Error'])
                . view('errors/custom_error', ['message' => $professorsResult['error']])
                . view('template/footer');
        }

        // Obtener los salones
        $roomsResult = $roomsModel->getRooms();
        if (isset($roomsResult['status']) && $roomsResult['status'] === 'error') {
            return view('template/header', ['title' => 'Error'])
                . view('errors/custom_error', ['message' => $roomsResult['error']])
                . view('template/footer');
        }

        // Obtener los instrumentos
        $instrumentsResult = $instrumentModel->getInstruments();
        if (isset($instrumentsResult['status']) && $instrumentsResult['status'] === 'error') {
            return view('template/header', ['title' => 'Error'])
                . view('errors/custom_error', ['message' => $instrumentsResult['error']])
                . view('template/footer');
        }

        // Si no hay errores, pasar los datos a la vista
        $data = [
            'title' => 'Profesores',
            'professors' => $professorsResult['data']->getResult(), // Pasar los profesores
            'rooms' => $roomsResult['data']->getResult(),           // Pasar los salones
            'instruments' => $instrumentsResult['data']->getResult(), // Pasar los instrumentos
            'modal' => $modal,                         // Pasar el parámetro 'modal'
        ];

        return view('template/header', $data)
            . view('system/admin/profesores', $data)
            . view('template/footer');
    }
}
