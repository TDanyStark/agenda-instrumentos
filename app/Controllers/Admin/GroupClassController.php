<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GroupClassController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Crear clase grupal',
        ];

        return view('template/header', $data)
            . view('system/admin/crear-clase-grupal', $data)
            . view('template/footer');
    }
}
