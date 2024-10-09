<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\EnrollsModel;
use CodeIgniter\HTTP\ResponseInterface;

class EnrollsController extends BaseController
{
    public function addEnroll()
    {
        $json = $this->request->getJSON(true);

        $model = new EnrollsModel();

        $result = $model->addEnroll([
            'StudentID' => $json['studentId'],
            'CourseID' => $json['courseId'],
            'InstrumentID' => $json['instrumentId'],
            'SemesterID' => $json['semesterId'],
            'Status' => $json['status']
        ]);

        return $this->formatResponse($result, 'Matrícula agregada correctamente', 'Error agregando la matrícula');

    }

    public function deleteEnroll()
    {
        $json = $this->request->getJSON(true);

        $model = new EnrollsModel();

        $result = $model->deleteEnroll($json['enrollId']);

        return $this->formatResponse($result, 'Matrícula eliminada correctamente', 'Error eliminando la matrícula');
    }

    public function getEnrollForEdit()
    {
        $json = $this->request->getJSON(true);

        $model = new EnrollsModel();

        $enrollId = $json['enrollId'];

        $result = $model->getEnrollForEdit($enrollId);

        return $this->formatResponse($result, 'Matrícula obtenida correctamente', 'Error obteniendo la matrícula');
    }

    public function updateEnroll()
    {
        $json = $this->request->getJSON(true);

        $model = new EnrollsModel();

        $result = $model->updateEnroll([
            'EnrollID' => $json['enrollId'],
            'StudentID' => $json['studentId'],
            'CourseID' => $json['courseId'],
            'InstrumentID' => $json['instrumentId'],
            'SemesterID' => $json['semesterId'],
            'Status' => $json['status']
        ]);

        return $this->formatResponse($result, 'Matrícula actualizada correctamente', 'Error actualizando la matrícula');
    }

    
}
