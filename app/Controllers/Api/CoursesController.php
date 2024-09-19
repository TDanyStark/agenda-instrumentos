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
        
        $AvailableDays = json_encode($data['CourseAvailableDays']);

        // Agregar el curso
        $result = $model->addCourse([
            'CourseName' => $data['CourseName'],
            'ClassDuration' => $data['ClassDuration'],
            'CourseAvailableDays' => $AvailableDays,
        ]);

        // Retornar la respuesta usando formatResponse
        return $this->formatResponse($result, 'Curso agregado satisfactoriamente', 'Error agregando el curso');
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
        return $this->formatResponse($result, 'Curso eliminado correctamente', 'Error eliminando el curso');
    }
}
