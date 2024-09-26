<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ProfessorsModel;

class ProfessorsController extends BaseController
{
    public function addProfessor()
    {
        $json = $this->request->getJSON(true); // true lo convierte en un array asociativo

        $professorModel = new ProfessorsModel();

        $name = $json['name'];
        $email = $json['email'];

        // Insertar profesor
        $result = $professorModel->addProfessor(['Name' => $name, 'Email' => $email]);

        if (isset($result['error']) && $result["errorCode"] == 1062) {
            return $this->formatResponse($result, '', 'El correo del profesor ' . $email . ' ya se encuentra registrado');
        }

        if (isset($result['error'])) {
            return $this->formatResponse($result, '', 'Error al agregar al profesor ' . $name);
        }

        $professorID = $result["data"];

        $result = $this->addProfessorMethods($json, $professorID);

        return $this->formatResponse($result, 'Profesor agregado exitosamente', 'Error al agregar el profesor');
    }

    public function deleteProfessor()
    {
        $json = $this->request->getJSON(true); // true lo convierte en un array asociativo
        $result = $this->deleteProfessorMethods($json);

        if (isset($result['error'])) {
            return $this->formatResponse($result, '', 'Error al eliminar el profesor');
        }

        $professorModel = new ProfessorsModel();

        $professorID = $json['professorId'];

        // Eliminar profesor
        $result = $professorModel->deleteProfessor($professorID);

        return $this->formatResponse($result, 'Profesor eliminado exitosamente', 'Error al eliminar el profesor');
    }

    public function getProfessorForEdit()
    {
        $json = $this->request->getJSON(true); // true lo convierte en un array asociativo

        $professorID = $json['professorId'];

        $professorModel = new ProfessorsModel();

        $professorData = $professorModel->getProfessorForEdit($professorID);

        return $this->formatResponse($professorData, 'Datos del profesor obtenidos exitosamente', 'Error al obtener los datos del profesor');
    }

    public function updateProfessor()
    {
        $json = $this->request->getJSON(true);

        $responseDelete = $this->deleteProfessorMethods($json);

        if (isset($responseDelete['error'])) {
            return $this->formatResponse($responseDelete, '', 'Error al eliminar el profesor');
        }

        $responseAdd = $this->addProfessorMethods($json);

        return $this->formatResponse($responseAdd, 'Profesor editado exitosamente', 'Error al agregar el profesor');
    }

    public function addProfessorMethods($json, $professorID = null)
    {
        $salones = $json['salones'];
        $instrumentos = $json['instrumentos'];
        $agenda = $json['agenda'];

        if ($professorID == null) {
            $professorID = $json['professorId'];
        }

        $professorModel = new ProfessorsModel();

        // Insertar salones
        foreach ($salones as $salon) {
            $result = $professorModel->addProfessorRoom(['ProfessorID' => $professorID, 'RoomID' => $salon['roomId']]);
            if (isset($result['error'])) {
                return $result;
            }
        }

        // Insertar instrumentos
        foreach ($instrumentos as $instrumento) {
            $result = $professorModel->addProfessorInstrument(['ProfessorID' => $professorID, 'InstrumentID' => $instrumento['instrumentId']]);
            if (isset($result['error'])) {
                return $result;
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
                        return $result;
                    }
                }
            }
        }

        return [];
    }

    public function deleteProfessorMethods($json)
    {
        $professorID = $json['professorId'];

        $professorModel = new ProfessorsModel();

        // Eliminar disponibilidad
        $result = $professorModel->deleteProfessorAvailability($professorID);
        if (isset($result['error'])) {
            return $result;
        }

        // Eliminar instrumentos
        $result = $professorModel->deleteProfessorInstruments($professorID);
        if (isset($result['error'])) {
            return $result;
        }

        // Eliminar salones
        $result = $professorModel->deleteProfessorRooms($professorID);
        if (isset($result['error'])) {
            return $result;
        }
    }
}
