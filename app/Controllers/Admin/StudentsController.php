<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StudentsModel;

class StudentsController extends BaseController
{
    public function index()
    {
        $model = new StudentsModel();

        // Obtener los estudiantes utilizando el método getStudents
        $result = $model->getStudents();

        // Verificar si hay un error en la respuesta
        if (isset($result['status']) && $result['status'] === 'error') {
            // Manejar el error mostrando una vista personalizada
            return view('template/header', ['title' => 'Error'])
                . view('errors/custom_error', ['message' => $result['error']])
                . view('template/footer');
        }

        // Si no hay errores, pasar los estudiantes a la vista
        $data = [
            'title' => 'Estudiantes',
            'students' => $result['data'] // Pasar los estudiantes si todo está bien
        ];

        return view('template/header', $data)
            . view('system/admin/estudiantes', $data)
            . view('template/footer');
    }
}
