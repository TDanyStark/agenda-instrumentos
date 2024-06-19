<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\CoursesModel;

class Cursos extends BaseController
{
    public function index()
    {

        $model = new CoursesModel();
        $data = 
        [
            'title' => 'Cursos',
            'cursos' => $model->getCourses()
        ];


        return view('template/header', $data) 
        .view('system/admin/cursos', $data)
        .view('template/footer');
    }
}
