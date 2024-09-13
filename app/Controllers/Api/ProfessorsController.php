<?php
namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ProfessorsModel;

class ProfessorsController extends BaseController
{
    public function addProfessor()
    {
        $json = $this->request->getJSON(true); // true lo convierte en un array asociativo

        $name = $json['nombre'];
        $email = $json['email'];
        $salones = $json['salones'];
        $instrumentos = $json['instrumentos'];
        $dias = $json['dias'];

        $professorModel = new ProfessorsModel();

        // Insertar profesor
        $result = $professorModel->addProfessor(['Name' => $name, 'Email' => $email]);

        if (isset($result['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al agregar el profesor: ' . $result['error'],
                'errorCode' => $result['errorCode']
            ])->setStatusCode(400); // Error en el insert
        }

        $professorID = $result;

        // Insertar salones
        foreach ($salones as $salon) {
            $result = $professorModel->addProfessorRoom(['ProfessorID' => $professorID, 'RoomID' => $salon['roomId']]);
            if (isset($result['error'])) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Error al agregar salón: ' . $result['error']
                ])->setStatusCode(400);
            }
        }
        // Insertar instrumentos
        foreach ($instrumentos as $instrumento) {
            $result = $professorModel->addProfessorInstrument(['ProfessorID' => $professorID, 'InstrumentID' => $instrumento['instrumentId']]);
            if (isset($result['error'])) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Error al agregar instrumento: ' . $result['error']
                ])->setStatusCode(400);
            }
        }
        // Insertar disponibilidad
        foreach ($dias as $dia) {
            if ($dia['activo']) {
                foreach ($dia['horarios'] as $horario) {
                    $result = $professorModel->addProfessorAvailability([
                        'ProfessorID' => $professorID,
                        'DayOfWeek' => $dia['diaSemana'],
                        'StartTime' => $horario['horaInicio'],
                        'EndTime' => $horario['horaFin']
                    ]);
                    if (isset($result['error'])) {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => 'Error al agregar disponibilidad: ' . $result['error']
                        ])->setStatusCode(400);
                    }
                }
            }
        }
        return $this->response->setJSON(['status' => 'success', 'message' => 'Profesor agregado exitosamente']);
    }

    public function deleteProfessor()
    {
        $json = $this->request->getJSON(true); // true lo convierte en un array asociativo

        $professorID = $json['professorId'];

        $professorModel = new ProfessorsModel();

        // Eliminar disponibilidad
        $result = $professorModel->deleteProfessorAvailability($professorID);
        if (isset($result['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al eliminar disponibilidad: ' . $result['error']
            ])->setStatusCode(400);
        }

        // Eliminar instrumentos
        $result = $professorModel->deleteProfessorInstruments($professorID);
        if (isset($result['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al eliminar instrumentos: ' . $result['error']
            ])->setStatusCode(400);
        }

        // Eliminar salones
        $result = $professorModel->deleteProfessorRooms($professorID);
        if (isset($result['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al eliminar salones: ' . $result['error']
            ])->setStatusCode(400);
        }

        // Eliminar profesor
        $result = $professorModel->deleteProfessor($professorID);
        if (isset($result['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al eliminar profesor: ' . $result['error']
            ])->setStatusCode(400);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Profesor eliminado exitosamente']);
    }

    public function getProfessorForEdit(){
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
}

