<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SemestersModel;
use CodeIgniter\HTTP\ResponseInterface;

class SemestersController extends BaseController
{
    public function index()
    {

        $model = new SemestersModel();

        $result = $model->getSemesters();

         // Verificar si hay un error en la respuesta
        if (isset($result['status']) && $result['status'] === 'error') {
            // Manejar el error, podrías mostrar un mensaje o redirigir a una página de error
            return "hubo un error obteniendo los semestres, recargue la pagina o contacte al adminsitrador";
        }

        $data = [
            'title' => 'Semestres',
            'semesters' => $result['data']
        ];

        return view('template/header', $data)
            . view('system/admin/semestres', $data)
            . view('template/footer');
    }
}
