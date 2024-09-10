<?php

namespace App\Models;

use CodeIgniter\Model;

class CoursesModel extends Model
{
    public function getCourses()
    {
        $query = $this->db->query('SELECT * FROM courses ORDER BY ClassDuration DESC');
        $result = $query->getResult();
        return $result;
    }

    public function addCourse($data)
    {
        $query = $this->db->query('INSERT INTO courses (CourseName, 	ClassDuration) VALUES (?, ?)', [$data['CourseName'], $data['ClassDuration']]);
        return $this->db->insertID();
    }

    public function deleteCourse($id)
    {
        $query = $this->db->query('DELETE FROM courses WHERE CourseID = ?', [$id]);
        return $this->db->affectedRows();
    }
}
