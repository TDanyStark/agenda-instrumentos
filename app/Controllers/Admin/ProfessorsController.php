<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\InstrumentsModel;
use App\Models\ProfessorsModel;
use App\Models\RoomsModel;

class ProfessorsController extends BaseController
{
    public function index()
    {
        $professorsModel = new ProfessorsModel();
        $instrumentModel = new InstrumentsModel();
        $roomsModel = new RoomsModel();

        // parameter get
        $modal = $this->request->getGet('modal');



        $data = [
            'title' => 'Profesores',
            'rooms' => $roomsModel->getRooms(),
            'instruments' => $instrumentModel->getInstruments(),
            'modal' => $modal
        ];

        return view('template/header', $data)
            . view('system/admin/profesores', $data)
            . view('template/footer');
    }
}
