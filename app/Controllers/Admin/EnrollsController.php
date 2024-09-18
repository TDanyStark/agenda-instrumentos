<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EnrollsModel;
use App\Models\InstrumentsModel;
use App\Models\SemestersModel;
use App\Models\CoursesModel;

class EnrollsController extends BaseController
{
    public function index()
    {

        $modelEnrolls = new EnrollsModel();
        $modelInstruments = new InstrumentsModel();
        $modelSemesters = new SemestersModel();
        $modelCourses = new CoursesModel();

        $resultEnrolls = $modelEnrolls->getEnrolls();

        if (isset($resultEnrolls['status']) && $resultEnrolls['status'] === 'error') {
            return "Error al obtener las matriculas";
        }

        $resultInstruments = $modelInstruments->getInstruments();

        if (isset($resultInstruments['status']) && $resultInstruments['status'] === 'error') {
            return "Error al obtener los instrumentos";
        }


        $semesters = $modelSemesters->getSemesters();

        if (isset($semesters['status']) && $semesters['status'] === 'error') {
            return "Error al obtener los semestres";
        }

        $courses = $modelCourses->getCourses();

        if (isset($courses['status']) && $courses['status'] === 'error') {
            return "Error al obtener los cursos";
        }



        $data = [
            'title' => 'Matriculas',
            'enrollments' => $resultEnrolls['data'],
            'instruments' => $resultInstruments['data'],
            'semesters' => $semesters['data'],
            'courses' => $courses['data']
        ];

        return view('template/header', $data)
            . view('system/admin/matriculas', $data)
            . view('template/footer');
    }
}
