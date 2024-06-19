<?php

namespace App\Controllers\System;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Inicio extends BaseController
{
    public function index()
    {
        $data["title"] = "Agendamiento CZ";

        return view("template/header")
            . view('system/inicio')
            . view("template/footer");
    }
}
