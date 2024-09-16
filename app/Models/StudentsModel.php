<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentsModel extends Model
{
    public function getStudents()
    {
        $query = 'SELECT * FROM students ORDER BY StudentID DESC';
        return $this->executeQuery($query); // Siempre retorna el resultado, el controlador maneja el error
    }

    public function addStudent($data)
    {
        $query = 'INSERT INTO students (FirstName, LastName, Cedula, Status, Email) VALUES (?, ?, ?, ?, ?)';
        return $this->executeQuery($query, [$data['firstName'], $data['lastName'], $data['cedula'], $data['status'], $data['email']]);
    }

    public function deleteStudent($studentID)
    {
        $query = 'DELETE FROM students WHERE StudentID = ?';
        return $this->executeQuery($query, [$studentID]); // Siempre retorna el resultado, sea éxito o error
    }

    public function getStudentForEdit($studentID)
    {
        $query = 'SELECT * FROM students WHERE StudentID = ?';
        return $this->executeQuery($query, [$studentID]); // Siempre retorna el resultado
    }

    public function updateStudent($data)
    {
        $query = 'UPDATE students SET FirstName = ?, LastName = ?, Cedula = ?, Status = ?, Email = ? WHERE StudentID = ?';
        return $this->executeQuery($query, [$data['firstName'], $data['lastName'], $data['cedula'], $data['status'], $data['email'], $data['StudentID']]);
    }
}
