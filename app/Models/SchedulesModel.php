<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;
use DatePeriod;
use CodeIgniter\Session\SessionInterface;
use CodeIgniter\Database\BaseConnection;

class SchedulesModel extends Model
{
    protected $table = 'student_schedule';
    protected $primaryKey = 'ScheduleID';
    protected $allowedFields = [
        'ProfessorID',
        'RoomID',
        'DayOfWeek',
        'StartTime',
        'EndTime',
        'EnrollID',
        'CreatedAt'
    ];
    protected $db;
    protected $session;

    public function __construct(BaseConnection $db = null, SessionInterface $session = null)
    {
        parent::__construct();

        $this->db = $db ?: \Config\Database::connect();
        $this->session = $session ?: session();
    }

    public function searchEnrolls($studentID)
    {
        $query = 'SELECT 
            e.EnrollID AS EnrollID,
            CONCAT(s.FirstName, " ", s.LastName) AS StudentName,
            c.CourseName AS CourseName,
            c.ClassDuration AS ClassDuration,
            c.CourseID AS CourseID,
            i.InstrumentID AS InstrumentID,
            i.InstrumentName AS InstrumentName,
            sm.SemesterName AS SemesterName,
            e.Status AS Status,
            ss.ScheduleID AS ScheduleID,
            ss.DayOfWeek AS DayOfWeek,
            ss.StartTime AS StartTime,
            ss.EndTime AS EndTime,
            r.RoomID AS RoomID,
            r.RoomName AS RoomName,
            p.ProfessorID AS ProfessorID,
            p.Name AS ProfessorName
        FROM enrolls e
        JOIN students s ON e.StudentID = s.StudentID
        JOIN courses c ON e.CourseID = c.CourseID
        JOIN instruments i ON e.InstrumentID = i.InstrumentID
        JOIN semesters sm ON e.SemesterID = sm.SemesterID
        LEFT JOIN student_schedule ss ON e.EnrollID = ss.EnrollID
        LEFT JOIN rooms r ON ss.RoomID = r.RoomID
        LEFT JOIN professors p ON ss.ProfessorID = p.ProfessorID
        WHERE e.StudentID = ?
        ORDER BY e.EnrollID DESC';
        return $this->executeQuery($query, [$studentID]); // Siempre retorna el resultado, el controlador maneja el error
    }

    public function getAvailableSchedules($data)
    {
        $db = $this->db; // Usar la conexión inyectada

        // Obtener el InstrumentID del array de datos
        $instrumentID = $data['InstrumentID'];
        $ClassDuration = $data['ClassDuration'];

        // Paso 1: Obtener los profesores que enseñan el instrumento dado
        $professors = $db->table('professorinstrument')
            ->select('professors.ProfessorID, professors.Name, professors.Email')
            ->join('professors', 'professorinstrument.ProfessorID = professors.ProfessorID')
            ->where('professorinstrument.InstrumentID', $instrumentID)
            ->get()
            ->getResultArray();

        $availableSchedules = [];

        // Paso 2: Para cada profesor, obtener su disponibilidad, salas y horarios ocupados
        foreach ($professors as $professor) {
            $professorID = $professor['ProfessorID'];

            // Obtener disponibilidad del profesor
            $availability = $db->table('professoravailability')
                ->where('ProfessorID', $professorID)
                ->get()
                ->getResultArray();

            // Obtener las salas asociadas al profesor
            $rooms = $db->table('professorrooms')
                ->select('rooms.RoomID, rooms.RoomName')
                ->join('rooms', 'professorrooms.RoomID = rooms.RoomID')
                ->where('professorrooms.ProfessorID', $professorID)
                ->get()
                ->getResultArray();

            // Si el profesor no tiene salas asignadas, continuar al siguiente
            if (empty($rooms)) {
                continue;
            }

            // Obtener IDs de las salas asignadas al profesor
            $roomIDs = array_column($rooms, 'RoomID');

            // Obtener horarios ocupados de las salas asignadas, sin importar el profesor
            $occupiedRoomSchedules = $db->table('student_schedule')
                ->whereIn('RoomID', $roomIDs)
                ->get()
                ->getResultArray();

            // Obtener horarios ocupados del profesor
            $occupiedProfessorSchedules = $db->table('student_schedule')
                ->where('ProfessorID', $professorID)
                ->get()
                ->getResultArray();

            $studentID = $this->session->get('StudentID');

            $occupiedStudentSchedules = $db->table('student_schedule')
                ->join('enrolls', 'student_schedule.EnrollID = enrolls.EnrollID')
                ->where('enrolls.StudentID', $studentID)
                ->get()
                ->getResultArray();

            // Paso 3: Calcular los horarios disponibles basados en la disponibilidad y horarios ocupados
            $professorAvailableSchedules = [];
            $interval = new \DateInterval('PT30M'); // para que me de la hora de inicio cada 30 min
            $classDuration = new \DateInterval('PT' . $ClassDuration . 'M'); // para que me ubique los bloques cada 30/60 min o el valor de $classDuration

            foreach ($availability as $avail) {
                $dayOfWeek = $avail['DayOfWeek'];
                $startTime = $avail['StartTime'];
                $endTime = $avail['EndTime'];

                // Crear intervalos de tiempo dentro de la disponibilidad
                $periods = new DatePeriod(
                    new DateTime($startTime),
                    $interval,
                    new DateTime($endTime)
                );

                // Para cada sala asignada al profesor
                foreach ($rooms as $room) {
                    $roomID = $room['RoomID'];

                    // Obtener horarios ocupados para esta sala y día
                    $overlappingRoomSchedules = array_filter($occupiedRoomSchedules, function ($occupied) use ($dayOfWeek, $roomID) {
                        return $occupied['DayOfWeek'] == $dayOfWeek && $occupied['RoomID'] == $roomID;
                    });

                    // Obtener horarios ocupados del profesor para este día
                    $overlappingProfessorSchedules = array_filter($occupiedProfessorSchedules, function ($occupied) use ($dayOfWeek) {
                        return $occupied['DayOfWeek'] == $dayOfWeek;
                    });

                    $overlappingStudentSchedules = array_filter($occupiedStudentSchedules, function ($occupied) use ($dayOfWeek) {
                        return $occupied['DayOfWeek'] == $dayOfWeek;
                    });

                    foreach ($periods as $periodStart) {
                        $periodEnd = clone $periodStart;
                        // a la hora de inicio le sumamos la duracion de la clase para crear ese horario
                        $periodEnd->add($classDuration);

                        $slotStart = $periodStart->format('H:i:s');
                        $slotEnd = $periodEnd->format('H:i:s');

                        // Verificar si este intervalo está ocupado en esta sala
                        $isRoomOccupied = false;
                        foreach ($overlappingRoomSchedules as $occupied) {
                            if ($occupied['StartTime'] < $slotEnd && $slotStart < $occupied['EndTime']) {
                                $isRoomOccupied = true;
                                break;
                            }
                        }

                        // Verificar si el profesor está ocupado en este intervalo
                        $isProfessorOccupied = false;
                        foreach ($overlappingProfessorSchedules as $occupied) {
                            if ($occupied['StartTime'] < $slotEnd && $slotStart < $occupied['EndTime']) {
                                $isProfessorOccupied = true;
                                break;
                            }
                        }

                        $isStudentOccupied = false;
                        foreach ($overlappingStudentSchedules as $occupied) {
                            if ($occupied['StartTime'] < $slotEnd && $slotStart < $occupied['EndTime']) {
                                $isStudentOccupied = true;
                                break;
                            }
                        }

                        if (!$isRoomOccupied && !$isProfessorOccupied && !$isStudentOccupied) {
                            // Añadir el horario disponible con la información de la sala
                            $professorAvailableSchedules[] = [
                                'DayOfWeek' => $dayOfWeek,
                                'StartTime' => $slotStart,
                                'EndTime' => $slotEnd,
                                'RoomID' => $roomID,
                                'RoomName' => $room['RoomName'],
                            ];
                        }
                    }
                }
            }

            // Añadir los horarios disponibles del profesor al arreglo principal
            $availableSchedules[] = [
                'ProfessorID' => $professorID,
                'ProfessorName' => $professor['Name'],
                'AvailableSchedules' => $professorAvailableSchedules,
            ];
        }

        // Devolver el resultado con el estado y los datos
        return [
            'status' => 'success',
            'data' => $availableSchedules
        ];
    }


    public function saveSchedule($data)
    {
        $db = $this->db; // Usar la conexión inyectada

        // Iniciar una transacción
        $db->transStart();

        try {
            // Extraer los datos necesarios del array $data
            $professorID = $data['ProfessorID'];
            $roomID = $data['RoomID'];
            $dayOfWeek = $data['DayOfWeek'];
            $startTime = $data['StartTime'];
            $endTime = $data['EndTime'];
            $enrollID = $data['EnrollID'];

            // Obtener StudentID desde la sesión inyectada
            $studentID = $this->session->get('StudentID');

            // Verificar que $studentID no sea nulo
            if (!$studentID) {
                $db->transRollback();
                return [
                    'status' => 'error',
                    'message' => 'No se pudo obtener el ID del estudiante de la sesión.',
                ];
            }

            // Paso 1: Verificar si el horario sigue disponible

            // Verificar conflictos con RoomID, ProfessorID y StudentID
            $conflictQuery = $db->query("
            SELECT *
            FROM student_schedule
            JOIN enrolls ON student_schedule.EnrollID = enrolls.EnrollID
            WHERE (RoomID = ? OR ProfessorID = ? OR enrolls.StudentID = ?)
                AND DayOfWeek = ?
                AND ((StartTime < ? AND EndTime > ?))
            FOR UPDATE
        ", [$roomID, $professorID, $studentID, $dayOfWeek, $endTime, $startTime]);

            if ($conflictQuery->getNumRows() > 0) {
                // Existe un conflicto, el horario ya no está disponible
                $db->transRollback();
                return [
                    'status' => 'error',
                    'message' => 'El horario seleccionado ya no está disponible.',
                ];
            }

            // Paso 2: Insertar el nuevo horario

            // Preparar los datos para insertar
            $scheduleData = [
                'ProfessorID' => $professorID,
                'RoomID' => $roomID,
                'DayOfWeek' => $dayOfWeek,
                'StartTime' => $startTime,
                'EndTime' => $endTime,
                'EnrollID' => $enrollID,
                'CreatedAt' => date('Y-m-d H:i:s'),
            ];

            // Insertar el nuevo horario
            $builder = $db->table('student_schedule');
            $insertResult = $builder->set($scheduleData)->insert();

            if (!$insertResult) {
                // La inserción falló
                throw new \Exception('No se pudo guardar el horario seleccionado.');
            }

            // Completar la transacción
            $db->transComplete();

            if ($db->transStatus() === false) {
                // La transacción falló
                return [
                    'status' => 'error',
                    'message' => 'Ocurrió un error al guardar el horario.',
                ];
            } else {
                // Éxito
                return [
                    'status' => 'success',
                    'message' => 'Horario guardado correctamente.',
                ];
            }
        } catch (\Exception $e) {
            // Manejo de excepciones
            $db->transRollback();
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }
}
