<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingsModel;

class SettingsController extends BaseController
{
    public function index()
    {
        // Cargar el modelo de Settings
        $settingsModel = new SettingsModel();

        // Obtener la recurrencia
        $recurrencia = $settingsModel->getSetting('recurrencia');

        // Obtener el horario general
        $generalSchedule = $settingsModel->getGeneralSchedule();

        $escogerHorario = $settingsModel->getSetting('escoger_horario');

        // Pasar las configuraciones a la vista
        $data = [
            'title' => 'Configuraciones',
            'recurrencia' => $recurrencia,
            'generalSchedule' => $generalSchedule,
            'escogerHorario' => $escogerHorario,
        ];

        return view('template/header', $data)
            . view('system/admin/configuraciones', $data)
            . view('template/footer');
    }
}
