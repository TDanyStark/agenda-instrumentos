<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CoursesModel;

class CoursesController extends BaseController
{
    public function addCourse()
    {
        // Obtener la data enviada
        $data = $this->request->getJSON(true); // true lo convierte en array asociativo

        // Cargar el modelo
        $model = new CoursesModel();

        // Agregar el curso
        $result = $model->addCourse([
            'CourseName' => $data['CourseName'],
            'ClassDuration' => $data['ClassDuration']
        ]);

        // Retornar la respuesta usando formatResponse
        return $this->formatResponse($result, 'Course added successfully', 'Error adding course');
    }

    public function deleteCourse()
    {
        // Obtener la data enviada
        $data = $this->request->getJSON(true); // true lo convierte en array asociativo

        // Cargar el modelo
        $model = new CoursesModel();

        // Eliminar el curso
        $result = $model->deleteCourse($data['CourseID']);

        // Retornar la respuesta usando formatResponse
        return $this->formatResponse($result, 'Course deleted successfully', 'Error deleting course');
    }
}
