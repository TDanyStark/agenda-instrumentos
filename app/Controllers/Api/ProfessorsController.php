<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ProfessorsModel;

class ProfessorsController extends BaseController
{

    public function addProfessor()
    {
        $json = $this->request->getJSON(true); // true lo convierte en un array asociativo
        $result = $this->addProfessorMethods($json);
        if (isset($result['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al agregar el profesor: ' . $result['error'],
                'errorCode' => $result['errorCode']
            ])->setStatusCode(400);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Profesor agregado exitosamente']);
    }

    public function deleteProfessor()
    {
        $json = $this->request->getJSON(true); // true lo convierte en un array asociativo
        $result = $this->deleteProfessorMethods($json);
        if (isset($result['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al eliminar el profesor: ' . $result['error'],
                'errorCode' => $result['errorCode']
            ])->setStatusCode(400);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Profesor eliminado exitosamente']);
    }

    public function getProfessorForEdit()
    {
        $json = $this->request->getJSON(true); // true lo convierte en un array asociativo

        $professorID = $json['professorId'];

        $professorModel = new ProfessorsModel();

        $professorData = $professorModel->getProfessorForEdit($professorID);

        if (isset($professorData['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al obtener los datos del profesor: ' . $professorData['error']
            ])->setStatusCode(400);
        }

        return $this->response->setJSON(['status' => 'success', 'professorData' => $professorData]);
    }

    public function updateProfessor()
    {
        $json = $this->request->getJSON(true);
        $responseDelete = $this->deleteProfessorMethods($json);
        if (isset($responseDelete['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al eliminar el profesor: ' . $responseDelete['error'],
                'errorCode' => $responseDelete['errorCode']
            ])->setStatusCode(400);
        }

        $responseAdd = $this->addProfessorMethods($json);
        if (isset($responseAdd['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al agregar el profesor: ' . $responseAdd['error'],
                'errorCode' => $responseAdd['errorCode']
            ])->setStatusCode(400);
        }
        return $this->response->setJSON(['status' => 'success', 'message' => 'Profesor editado exitosamente']);
    }

    public function addProfessorMethods($json)
    {
        $name = $json['name'];
        $email = $json['email'];
        $salones = $json['salones'];
        $instrumentos = $json['instrumentos'];
        $agenda = $json['agenda'];

        $professorModel = new ProfessorsModel();

        // Insertar profesor
        $result = $professorModel->addProfessor(['Name' => $name, 'Email' => $email]);

        if (isset($result['error'])) {
            return ['error' => $result["error"], 'errorCode' => $result["errorCode"], 'message' => 'Error al agregar al profesor ' . $name];
        }

        $professorID = $result;

        // Insertar salones
        foreach ($salones as $salon) {
            $result = $professorModel->addProfessorRoom(['ProfessorID' => $professorID, 'RoomID' => $salon['roomId']]);
            if (isset($result['error'])) {
                return ['error' => $result["error"], 'errorCode' => $result["errorCode"], 'message' => 'Error al agregar al agregar el salón ' . $salon['roomName']];
            }
        }
        // Insertar instrumentos
        foreach ($instrumentos as $instrumento) {
            $result = $professorModel->addProfessorInstrument(['ProfessorID' => $professorID, 'InstrumentID' => $instrumento['instrumentId']]);
            if (isset($result['error'])) {
                return ['error' => $result["error"], 'errorCode' => $result["errorCode"], 'message' => 'Error al agregar al agregar el instrumento ' . $salon['instrumentName']];
            }
        }
        // Insertar disponibilidad
        foreach ($agenda as $dia) {
            if ($dia['activo']) {
                foreach ($dia['horarios'] as $horario) {
                    $result = $professorModel->addProfessorAvailability([
                        'ProfessorID' => $professorID,
                        'DayOfWeek' => $dia['diaName'],
                        'StartTime' => $horario['inicio'],
                        'EndTime' => $horario['fin']
                    ]);
                    if (isset($result['error'])) {
                        return ['error' => $result["error"], 'errorCode' => $result["errorCode"], 'message' => 'Error al agregar el horario ' . $dia['diaName']];
                    }
                }
            }
        }
    }

    public function deleteProfessorMethods($json)
    {
        $professorID = $json['professorId'];

        $professorModel = new ProfessorsModel();

        // Eliminar disponibilidad
        $result = $professorModel->deleteProfessorAvailability($professorID);
        if (isset($result['error'])) {
            return ['error' => $result["error"], 'errorCode' => $result["errorCode"], 'message' => 'Error al eliminar la disponibilidad del profesor'];
        }

        // Eliminar instrumentos
        $result = $professorModel->deleteProfessorInstruments($professorID);
        if (isset($result['error'])) {
            return ['error' => $result["error"], 'errorCode' => $result["errorCode"], 'message' => 'Error al eliminar los instrumentos del profesor'];
        }

        // Eliminar salones
        $result = $professorModel->deleteProfessorRooms($professorID);
        if (isset($result['error'])) {
            return ['error' => $result["error"], 'errorCode' => $result["errorCode"], 'message' => 'Error al eliminar los salones del profesor'];
        }

        // Eliminar profesor
        $result = $professorModel->deleteProfessor($professorID);
        if (isset($result['error'])) {
            return ['error' => $result["error"], 'errorCode' => $result["errorCode"], 'message' => 'Error al eliminar el profesor'];
        }
    }
}
