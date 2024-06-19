<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\InstrumentsModel;

class InstrumentsController extends BaseController
{
    public function index()
    {
        $instrumentsModel = new InstrumentsModel();

        $data = [
            'title' => 'Instrumentos',
            'instruments' => $instrumentsModel->getInstruments()
        ];

        return view('template/header', $data)
            . view('system/admin/instrumentos', $data)
            . view('template/footer');
    }
}
