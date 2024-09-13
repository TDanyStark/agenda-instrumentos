<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\StudentsModel;
use CodeIgniter\HTTP\ResponseInterface;



class StudentsController extends BaseController
{
    public function addStudent()
    {
        $json = $this->request->getJSON(true);

        $firstName = $json['firstName'];
        $lastName = $json['lastName'];
        $cedula = $json['cedula'];
        $status = $json['status'];
        $email = $json['email'];

        $studentModel = new StudentsModel();

        $result = $studentModel->addStudent([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'cedula' => $cedula,
            'status' => $status,
            'email' => $email
        ]);

        if (isset($result['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al agregar el estudiante: ' . $result['error'],
                'errorCode' => $result['errorCode']
            ])->setStatusCode(400);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Estudiante agregado exitosamente']);
    }

    public function deleteStudent()
    {
        $json = $this->request->getJSON(true);

        $studentID = $json['StudentID'];

        $studentModel = new StudentsModel();

        $result = $studentModel->deleteStudent($studentID);

        if (isset($result['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al eliminar el estudiante: ' . $result['error'],
                'errorCode' => $result['errorCode']
            ])->setStatusCode(400);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Estudiante eliminado exitosamente']);
    }

    public function getStudentForEdit()
    {
        $json = $this->request->getJSON(true);

        $studentID = $json['StudentID'];

        $studentModel = new StudentsModel();

        $studentData = $studentModel->getStudentForEdit($studentID);

        if (isset($studentData['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al obtener los datos del estudiante: ' . $studentData['error']
            ])->setStatusCode(400);
        }

        return $this->response->setJSON(['status' => 'success', 'studentData' => $studentData]);
    }

    public function updateStudent()
    {
        $json = $this->request->getJSON(true);

        $studentID = $json['StudentID'];
        $firstName = $json['firstName'];
        $lastName = $json['lastName'];
        $cedula = $json['cedula'];
        $status = $json['status'];
        $email = $json['email'];

        $studentModel = new StudentsModel();

        $result = $studentModel->updateStudent([
            'StudentID' => $studentID,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'cedula' => $cedula,
            'status' => $status,
            'email' => $email
        ]);

        if (isset($result['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al actualizar el estudiante: ' . $result['error'],
                'errorCode' => $result['errorCode']
            ])->setStatusCode(400);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Estudiante actualizado exitosamente']);
    }
}
