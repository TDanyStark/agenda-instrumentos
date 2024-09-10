<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ProfessorsModel;

class ProfessorsController extends BaseController
{
    public function addProfessor()
    {
        // Recibir JSON desde el frontend
        $json = $this->request->getJSON(true); // true lo convierte en un array asociativo

        $name = $json['nombre'];
        $email = $json['email'];
        $salones = $json['salones'];
        $instrumentos = $json['instrumentos'];
        $dias = $json['dias'];

        // cargar el modelo
        $professorModel = new ProfessorsModel();

        // Insertar profesor
        $professorID = $professorModel->addProfessor(['Name' => $name, 'Email' => $email]);

        // Insertar salones
        foreach ($salones as $salon) {
            $professorModel->addProfessorRoom(['ProfessorID' => $professorID, 'RoomID' => $salon['roomId']]);
        }

        // Insertar instrumentos
        foreach ($instrumentos as $instrumento) {
            $professorModel->addProfessorInstrument(['ProfessorID' => $professorID, 'InstrumentID' => $instrumento['instrumentId']]);
        }

        // Insertar disponibilidad
        foreach ($dias as $dia) {
            if ($dia['activo']) {
                foreach ($dia['horarios'] as $horario) {
                    $professorModel->addProfessorAvailability([
                        'ProfessorID' => $professorID,
                        'DayOfWeek' => $dia['diaSemana'],
                        'StartTime' => $horario['horaInicio'],
                        'EndTime' => $horario['horaFin']
                    ]);
                }
            }
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Professor added successfully!']);
    }
}
