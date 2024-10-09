<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InstrumentsModel;
use App\Models\ProfessorsModel;
use App\Models\RoomsModel;
use App\Models\SettingsModel;

class ProfessorsController extends BaseController
{
    public function index()
    {
        $professorsModel = new ProfessorsModel();
        $instrumentModel = new InstrumentsModel();
        $roomsModel = new RoomsModel();
        $settingsModel = new SettingsModel();

        $recurrencia = $settingsModel->getSetting("recurrencia");
        $horaInicio = $settingsModel->getSetting("hora_inicio_general");
        $horaFin = $settingsModel->getSetting("hora_fin_general");

        // Parameter get
        $modal = $this->request->getGet('modal');

        // Obtener los profesores
        $professorsResult = $professorsModel->getProfessors();
        if (isset($professorsResult['status']) && $professorsResult['status'] === 'error') {
            return "error";
        }

        // Obtener los salones
        $roomsResult = $roomsModel->getRooms();
        if (isset($roomsResult['status']) && $roomsResult['status'] === 'error') {
            return "error";
        }

        // Obtener los instrumentos
        $instrumentsResult = $instrumentModel->getInstruments();
        if (isset($instrumentsResult['status']) && $instrumentsResult['status'] === 'error') {
            return "error";
        }

        // Si no hay errores, pasar los datos a la vista
        $data = [
            'title' => 'Profesores',
            'professors' => $professorsResult['data'], // Pasar los profesores
            'rooms' => $roomsResult['data'],           // Pasar los salones
            'instruments' => $instrumentsResult['data'], // Pasar los instrumentos
            'modal' => $modal,                         // Pasar el parámetro 'modal'
            'recurrencia' => $recurrencia,
            'horaInicio' => $horaInicio,
            'horaFin' => $horaFin,
        ];

        return view('template/header', $data)
            . view('system/admin/profesores', $data)
            . view('template/footer');
    }
}
