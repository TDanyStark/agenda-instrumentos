<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\StudentsModel;

class StudentsController extends BaseController
{
    public function addStudent()
    {
        $json = $this->request->getJSON(true);

        $studentModel = new StudentsModel();
        $result = $studentModel->addStudent([
            'firstName' => $json['firstName'],
            'lastName' => $json['lastName'],
            'cedula' => $json['cedula'],
            'status' => $json['status'],
            'email' => $json['email'],
            'phone' => $json['phone']
        ]);

        return $this->formatResponse($result, 'Estudiante agregado exitosamente', 'Error al agregar el estudiante');
    }

    public function deleteStudent()
    {
        $json = $this->request->getJSON(true);

        $studentModel = new StudentsModel();
        $result = $studentModel->deleteStudent($json['StudentID']);

        return $this->formatResponse($result, 'Estudiante eliminado exitosamente', 'Error al eliminar el estudiante');
    }

    public function getStudentForEdit()
    {
        $json = $this->request->getJSON(true);

        $studentModel = new StudentsModel();
        $result = $studentModel->getStudentForEdit($json['StudentID']);

        return $this->formatResponse($result, 'Datos del estudiante obtenidos exitosamente', 'Error al obtener los datos del estudiante');
    }

    public function updateStudent()
    {
        $json = $this->request->getJSON(true);

        $studentModel = new StudentsModel();
        $result = $studentModel->updateStudent([
            'StudentID' => $json['StudentID'],
            'firstName' => $json['firstName'],
            'lastName' => $json['lastName'],
            'cedula' => $json['cedula'],
            'status' => $json['status'],
            'email' => $json['email'],
            'phone' => $json['phone']
        ]);

        return $this->formatResponse($result, 'Estudiante actualizado exitosamente', 'Error al actualizar el estudiante');
    }
}
