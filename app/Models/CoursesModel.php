<?php

namespace App\Models;

use CodeIgniter\Model;

class CoursesModel extends Model
{
    public function getCourses()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM courses ORDER BY ClassDuration DESC');
        $result = $query->getResult();
        return $result;
    }

    public function addCourse($data)
    {
        $db = db_connect();
        $query = $db->query('INSERT INTO courses (CourseName, 	ClassDuration) VALUES (?, ?)', [$data['CourseName'], $data['ClassDuration']]);
        return $db->insertID();
    }

    public function deleteCourse($id)
    {
        $db = db_connect();
        $query = $db->query('DELETE FROM courses WHERE CourseID = ?', [$id]);
        return $db->affectedRows();
    }
}
