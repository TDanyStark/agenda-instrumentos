<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SchedulesModel;
use App\Models\SettingsModel;

class ApiScheduleController extends BaseController
{
    public function saveSchedule()
    {
        $model = new SchedulesModel();
        $data = $this->request->getJSON(true);

        $result = $model->saveSchedule($data);

        return $this->response->setJSON($result);
    }

    public function getAvailableSchedules()
    {
        $model = new SchedulesModel();
        $settingsModel = new SettingsModel();
        $data = $this->request->getJSON(true);

        $data['recurrencia'] = $settingsModel->getSetting('recurrencia');

        $result = $model->getAvailableSchedules($data);

        return $this->response->setJSON($result);
    }

    public function getSchedule($id = null)
    {
        if ($id === null) {
            log_message('error', 'No ScheduleID proporcionado');
            return $this->response->setStatusCode(400)->setJSON(['error' => 'No se proporcionó ScheduleID']);
        }

        $model = new SchedulesModel();
        $schedule = $model->getSchedule($id);

        // Verificar si el horario existe
        if (!$schedule) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON(['error' => 'Horario no encontrado']);
        }

        // Responder con los datos del horario
        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status' => 'success',
                'data' => $schedule
            ]);
    }
}
