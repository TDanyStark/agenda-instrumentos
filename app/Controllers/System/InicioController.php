<?php

namespace App\Controllers\System;

use App\Controllers\BaseController;
use App\Models\AllScheduleModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SettingsModel;


class InicioController extends BaseController
{

    public function index()
    {
        $model = new AllScheduleModel();
        $modelSettings = new SettingsModel();

        $salonDefault = 4;

        // Obtener los parámetros de los filtros desde la URL
        $roomID = $this->request->getGet('roomID') ?? $salonDefault;
        $studentID = $this->request->getGet('studentID');
        $professorID = $this->request->getGet('professorID');

        // Obtener los horarios filtrados desde el modelo
        $schedules = $model->getSchedules($roomID, $studentID, $professorID);

        // Preparar los datos para la vista
        $horarios = [];

        foreach ($schedules as $schedule) {
            $horarios[] = [
                'dia' => $schedule['DayOfWeek'],
                'estudiante' => $schedule['StudentName'],
                'estudianteID' => $schedule['StudentID'],
                'profesor' => $schedule['ProfessorName'],
                'profesorID' => $schedule['ProfessorID'],
                'salon' => $schedule['RoomName'],
                'salonID' => $schedule['RoomID'],
                'hora_inicio' => substr($schedule['StartTime'], 0, 5), // Formato HH:MM
                'hora_fin' => substr($schedule['EndTime'], 0, 5),
            ];
        }

        // Pasa los datos a la vista
        $data['horarios'] = $horarios;
        $data["title"] = "Agendamiento CZ";
        // También puedes pasar los datos para los filtros
        $data['salones'] =  $model->getSalones();
        $data['horaInicio'] = $modelSettings->getSetting("hora_inicio_general");
        $data['horaFin'] = $modelSettings->getSetting("hora_fin_general");
        $data['salonDefault'] = $salonDefault;

        return view("template/header")
            . view('system/inicio', $data)
            . view("template/footer");
    }

    // Nuevo método para devolver datos filtrados en formato JSON
    public function getFilteredSchedules()
    {
        $model = new AllScheduleModel();

        // Obtener los parámetros de los filtros desde la solicitud AJAX
        $roomID = $this->request->getGet('roomID');
        $studentID = $this->request->getGet('studentID');
        $professorID = $this->request->getGet('professorID');

        // Obtener los horarios filtrados desde el modelo
        $schedules = $model->getSchedules($roomID, $studentID, $professorID);

        // Preparar los datos para enviar en formato JSON
        $horarios = [];

        foreach ($schedules as $schedule) {
            $horarios[] = [
                'dia' => $schedule['DayOfWeek'],
                'estudiante' => $schedule['StudentName'],
                'estudianteID' => $schedule['StudentID'],
                'profesor' => $schedule['ProfessorName'],
                'profesorID' => $schedule['ProfessorID'],
                'salon' => $schedule['RoomName'],
                'salonID' => $schedule['RoomID'],
                'hora_inicio' => substr($schedule['StartTime'], 0, 5),
                'hora_fin' => substr($schedule['EndTime'], 0, 5),
            ];
        }

        return $this->response->setJSON($horarios);
    }

}
