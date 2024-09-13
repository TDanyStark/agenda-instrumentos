<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DatabaseException;

class StudentsModel extends Model
{
    public function getStudents()
    {
        $query = $this->db->query('SELECT * FROM students');
        return $query->getResult();

    }

    public function addStudent($data)
    {
        try {
            $this->db->query('INSERT INTO students (FirstName, LastName, Cedula, Status, Email ) VALUES (?, ?, ?, ?, ?)', [$data['firstName'], $data['lastName'], $data['cedula'], $data['status'], $data['email']]);
            return $this->db->insertID();
        } catch (DatabaseException  $e) {
            return ['error' => $e->getMessage(), 'errorCode' => $e->getCode()];
        }
    }

    public function deleteStudent($studentID)
    {
        try {
            $this->db->query('DELETE FROM students WHERE StudentID = ?', [$studentID]);
            return true;
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage(), 'errorCode' => $e->getCode()];
        }
    }

    public function getStudentForEdit($studentID)
    {
        try {
            $query = $this->db->query('SELECT * FROM students WHERE StudentID = ?', [$studentID]);
            return [
                'student' => $query->getRow()
            ];
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage(), 'errorCode' => $e->getCode()];
        }
    }

    public function updateStudent($data)
    {
        try {
            $this->db->query('UPDATE students SET FirstName = ?, LastName = ?, Cedula = ?, Status = ?, Email = ? WHERE StudentID = ?', [$data['firstName'], $data['lastName'], $data['cedula'], $data['status'], $data['email'], $data['StudentID']]);
            return true;
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage(), 'errorCode' => $e->getCode()];
        }
    }
}
