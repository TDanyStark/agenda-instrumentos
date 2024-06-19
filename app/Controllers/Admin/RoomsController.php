<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\RoomsModel;

class RoomsController extends BaseController
{
    public function index()
    {

        $model = new RoomsModel();

        $data = [
            'title' => 'Salones',
            'rooms' => $model->getRooms()
        ];


        return view('template/header', $data) 
        .view('system/admin/salones', $data)
        .view('template/footer');
    }
}
