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
        $query = 'INSERT INTO students (FirstName, LastName, Cedula, Status, Email, Phone) VALUES (?, ?, ?, ?, ?, ?)';
        return $this->executeQuery($query, [$data['firstName'], $data['lastName'], $data['cedula'], $data['status'], $data['email'], $data['phone']]);
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
        $query = 'UPDATE students SET FirstName = ?, LastName = ?, Cedula = ?, Status = ?, Email = ?, Phone = ? WHERE StudentID = ?';
        return $this->executeQuery($query, [$data['firstName'], $data['lastName'], $data['cedula'], $data['status'], $data['email'], $data['phone'] , $data['StudentID']]);
    }

    public function searchStudents($search)
    {
        $query = "SELECT StudentID as id, CONCAT(FirstName, ' ', LastName, ' cc:', Cedula, ' cel: ', Phone) as name FROM students WHERE (FirstName LIKE ? OR LastName LIKE ? OR Cedula LIKE ? OR Email LIKE ? OR Phone LIKE ?) AND Status = 1";
        return $this->executeQuery($query, ["%$search%", "%$search%", "%$search%", "%$search%", "%$search%"]);
    }
}
