<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\CoursesModel;

class CoursesController extends BaseController
{
    public function addCourse()
    {
        // obtener la data enviada
        $data = $this->request->getJSON();

        // validar la data
        if (!$data) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid data'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // si hay un campo vacio return error
        if (empty($data->CourseName) || empty($data->ClassDuration)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Empty fields'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // cargar el modelo
        $model = new CoursesModel();

        // agregar el curso
        $id = $model->addCourse([
            'CourseName' => $data->CourseName,
            'ClassDuration' => $data->ClassDuration
        ]);

        // retornar la respuesta
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Course added',
            'id' => $id
        ]);
    }

    public function deleteCourse()
    {
        // obtener la data enviada
        $data = $this->request->getJSON();

        // validar la data
        if (!$data) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid data'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // si hay un campo vacio return error
        if (empty($data->CourseID)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Empty fields'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // cargar el modelo
        $model = new CoursesModel();

        // eliminar el curso
        $model->deleteCourse($data->CourseID);

        // retornar la respuesta
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Course deleted'
        ]);
    }
}
