<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrollsModel extends Model
{
    public function getEnrolls(){
        $query = 'SELECT 
            e.EnrollID AS EnrollmentID,
            CONCAT(s.FirstName, " ", s.LastName) AS StudentName,
            c.CourseName AS CourseName,
            i.InstrumentName AS InstrumentName,
            sm.SemesterName AS SemesterName,
            e.Status AS Status
        FROM enrolls e
        JOIN students s ON e.StudentID = s.StudentID
        JOIN courses c ON e.CourseID = c.CourseID
        JOIN instruments i ON e.InstrumentID = i.InstrumentID
        JOIN semesters sm ON e.SemesterID = sm.SemesterID';
        return $this->executeQuery($query);
    }

    public function addEnroll($data){
        $query = 'INSERT INTO enrolls (StudentID, CourseID, InstrumentID, SemesterID, Status) VALUES (?, ?, ?, ?, ?)';
        return $this->executeQuery($query, [$data['StudentID'], $data['CourseID'], $data['InstrumentID'], $data['SemesterID'], $data['Status']]);
    }

    public function deleteEnroll($enrollId){
        $query = 'DELETE FROM enrolls WHERE EnrollID = ?';
        return $this->executeQuery($query, [$enrollId]);
    }

    public function getEnrollForEdit($enrollId){
        $query = 'SELECT e.*, CONCAT(s.FirstName, " ",s.LastName ) AS StudentName FROM enrolls e JOIN students s ON e.StudentID = s.StudentID WHERE EnrollID = ?';
        return $this->executeQuery($query, [$enrollId]);
    }

    public function updateEnroll($data){
        $query = 'UPDATE enrolls SET StudentID = ?, CourseID = ?, InstrumentID = ?, SemesterID = ?, Status = ? WHERE EnrollID = ?';
        return $this->executeQuery($query, [$data['StudentID'], $data['CourseID'], $data['InstrumentID'], $data['SemesterID'], $data['Status'], $data['EnrollID']]);
    }
}
