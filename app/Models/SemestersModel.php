<?php

namespace App\Models;

use CodeIgniter\Model;

class SemestersModel extends Model
{
    public function getSemesters()
    {
        $query = 'SELECT * FROM semesters';
        return $this->executeQuery($query); // Siempre retorna el resultado, el controlador maneja el error
    }

    public function addSemester($data)
    {
        $query = 'INSERT INTO semesters (SemesterName) VALUES (?)';
        return $this->executeQuery($query, [$data['SemesterName']]); // Siempre retorna el resultado, el controlador maneja el error
    }

    public function deleteSemester($id)
    {
        $query = 'DELETE FROM semesters WHERE SemesterID = ?';
        return $this->executeQuery($query, [$id]); // Siempre retorna el resultado, sea éxito o error
    }
}
