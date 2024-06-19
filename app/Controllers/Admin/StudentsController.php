<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class StudentsController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Estudiantes'
        ];

        return view('template/header', $data)
            . view('system/admin/estudiantes', $data)
            . view('template/footer');
    }
}
