<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\SemestersModel;
use CodeIgniter\HTTP\ResponseInterface;

class SemestersController extends BaseController
{
    public function addSemester()
    {
        $json = $this->request->getJSON(true);

        $model = new SemestersModel();

        $result = $model->addSemester([
            'SemesterName' => $json['SemesterName']
        ]);

        return $this->formatResponse($result, 'Semestre agregado satisfactoriamente', 'Arror agregando el semestre');
    }

    public function deleteSemester()
    {
        $json = $this->request->getJSON(true);

        $model = new SemestersModel();

        $result = $model->deleteSemester($json['SemesterID']);

        return $this->formatResponse($result, 'Semestre eliminado satisfactoriamente', 'El semestre tiene cursos asociados y no puede ser eliminado');
    }
    
}
