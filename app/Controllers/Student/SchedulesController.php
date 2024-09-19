<?php

namespace App\Controllers\Student;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SchedulesModel;

class SchedulesController extends BaseController
{
    public function index()
    {

        $model = new SchedulesModel();

        $studentID = session()->get('StudentID');

        $resultEnrolls = $model->searchEnrolls($studentID);

        // verificar errores
        if(isset($resultEnrolls['status']) && $resultEnrolls['status'] === 'error'){
            return "Error al obtener las matriculas";
        }

        // Pasar los cursos a la vista si no hay errores
        $data = [
            'title' => 'Seleccionar horario',
            'enrolls' => $resultEnrolls['data'],
        ];

        return view('template/header', $data)
            . view('system/estudiante/horarios', $data)
            . view('template/footer');
    }
}
