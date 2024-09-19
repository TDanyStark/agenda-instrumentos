<?php

namespace App\Models;

use CodeIgniter\Model;

class CoursesModel extends Model
{
    public function getCourses()
    {
        $query = 'SELECT * FROM courses ORDER BY ClassDuration DESC';
        return $this->executeQuery($query); // Siempre retorna el resultado, el controlador maneja el error
    }

    public function addCourse($data)
    {
        $query = 'INSERT INTO courses (CourseName, ClassDuration, CourseAvailableDays	) VALUES (?, ?, ?)';
        return $this->executeQuery($query, [$data['CourseName'], $data['ClassDuration'], $data['CourseAvailableDays']]);
    }

    public function deleteCourse($id)
    {
        $query = 'DELETE FROM courses WHERE CourseID = ?';
        return $this->executeQuery($query, [$id]); // Siempre retorna el resultado
    }
}
