<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SettingsModel;

class SettingsController extends BaseController
{
    public function guardar()
    {
        $json = $this->request->getJSON();

        if (!$json) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Datos inválidos.'
            ]);
        }

        $recurrencia = $json->recurrencia;
        $horaInicio = $json->horaInicio;
        $horaFin = $json->horaFin;
        $escogerHorario = $json->escogerHorario;

        $settingsModel = new SettingsModel();

        // Guardar la recurrencia
        $settingsModel->updateOrInsertSetting('recurrencia', $recurrencia);

        // Guardar la hora de inicio y fin generales
        $settingsModel->updateOrInsertSetting('hora_inicio_general', $horaInicio);
        $settingsModel->updateOrInsertSetting('hora_fin_general', $horaFin);

        // Guardar la opción de escoger horario
        $settingsModel->updateOrInsertSetting('escoger_horario', $escogerHorario);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Configuración guardada correctamente.'
        ]);
    }
}
