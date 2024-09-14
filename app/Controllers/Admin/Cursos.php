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

        // Obtener los cursos utilizando el método getCourses
        $result = $model->getCourses();

        // Verificar si hay un error en la respuesta
        if (isset($result['status']) && $result['status'] === 'error') {
            // Manejar el error, podrías mostrar un mensaje o redirigir a una página de error
            return view('template/header', ['title' => 'Error'])
                . view('errors/custom_error', ['message' => $result['error']])
                . view('template/footer');
        }

        // Pasar los cursos a la vista si no hay errores
        $data = [
            'title' => 'Cursos',
            'cursos' => $result['data']->getResult()
        ];

        return view('template/header', $data)
            . view('system/admin/cursos', $data)
            . view('template/footer');
    }
}

