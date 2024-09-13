<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\StudentsModel;

class StudentsController extends BaseController
{
    public function index()
    {
        $model = new StudentsModel();

        $data = [
            'title' => 'Estudiantes',
            'students' => $model->getStudents()
        ];

        return view('template/header', $data)
            . view('system/admin/estudiantes', $data)
            . view('template/footer');
    }
}
