<?php

namespace App\Models;

use CodeIgniter\Model;

class AllScheduleModel extends Model
{
    protected $table = 'student_schedule';
    protected $primaryKey = 'ScheduleID';
    protected $allowedFields = [
        'ProfessorID', 'RoomID', 'DayOfWeek', 'StartTime', 'EndTime', 'CreatedAt', 'EnrollID'
    ];

    // Método para obtener los horarios con las uniones necesarias
    public function getSchedules($roomID = null, $studentID = null, $professorID = null)
    {
        $builder = $this->db->table($this->table);

        $builder->select([
            'student_schedule.*',
            'professors.Name as ProfessorName',
            'professors.ProfessorID',
            'rooms.RoomName as RoomName',
            'rooms.RoomID',
            'students.StudentID',
            'CONCAT(students.FirstName, " ", students.LastName) as StudentName'
        ]);

        $builder->join('professors', 'professors.ProfessorID = student_schedule.ProfessorID');
        $builder->join('rooms', 'rooms.RoomID = student_schedule.RoomID');
        $builder->join('enrolls', 'enrolls.EnrollID = student_schedule.EnrollID');
        $builder->join('students', 'students.StudentID = enrolls.StudentID');

        // Aplicar filtros si existen
        if ($roomID) {
            $builder->where('student_schedule.RoomID', $roomID);
        }

        if ($studentID) {
            $builder->where('students.StudentID', $studentID);
        }

        if ($professorID) {
            $builder->where('professors.ProfessorID', $professorID);
        }

        $query = $builder->get();
        return $query->getResultArray();
    }

    // Métodos para obtener datos de filtros permanecen igual
    public function getSalones()
    {
        $builder = $this->db->table('rooms');
        $builder->select('RoomID, RoomName');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // public function getEstudiantes()
    // {
    //     $builder = $this->db->table('students');
    //     $builder->select('StudentID, CONCAT(FirstName, " ", LastName) as StudentName');
    //     $query = $builder->get();
    //     return $query->getResultArray();
    // }

    // public function getProfesores()
    // {
    //     $builder = $this->db->table('professors');
    //     $builder->select('ProfessorID, Name as ProfessorName');
    //     $query = $builder->get();
    //     return $query->getResultArray();
    // }
}
