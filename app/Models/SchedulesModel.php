<?php

namespace App\Models;

use CodeIgniter\Model;

class SchedulesModel extends Model
{
    public function searchEnrolls($studentID)
    {
        $query = 'SELECT 
            e.EnrollID AS EnrollID,
            CONCAT(s.FirstName, " ", s.LastName) AS StudentName,
            c.CourseName AS CourseName,
            c.ClassDuration AS ClassDuration,
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
}
