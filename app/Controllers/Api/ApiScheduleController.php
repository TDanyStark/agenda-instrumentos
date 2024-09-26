<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SchedulesModel;

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
        $data = $this->request->getJSON(true);

        $result = $model->getAvailableSchedules($data);

        return $this->response->setJSON($result);
    }
}