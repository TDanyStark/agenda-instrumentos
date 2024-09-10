<?php
namespace App\Models;

use CodeIgniter\Model;

class ProfessorsModel extends Model
{
  public function getProfessors()
  {
    $query = $this->db->query('SELECT * FROM professors');
    $result = $query->getResult();
    return $result;
  }

  public function addProfessor($data)
  {
    $query = $this->db->query('INSERT INTO professors (Name, Email) VALUES (?, ?)', [$data['Name'], $data['Email']]);
    return $this->db->insertID(); // Retorna el ID del profesor insertado
  }

  public function addProfessorRoom($data)
  {
    $query = $this->db->query('INSERT INTO professorrooms (ProfessorID, RoomID) VALUES (?, ?)', [$data['ProfessorID'], $data['RoomID']]);
  }

  public function addProfessorInstrument($data)
  {
    $query = $this->db->query('INSERT INTO professorinstrument (ProfessorID, InstrumentID) VALUES (?, ?)', [$data['ProfessorID'], $data['InstrumentID']]);
  }

  public function addProfessorAvailability($data)
  {
    $query = $this->db->query('INSERT INTO professoravailability (ProfessorID, DayOfWeek, StartTime, EndTime) VALUES (?, ?, ?, ?)', [
      $data['ProfessorID'],
      $data['DayOfWeek'],
      $data['StartTime'],
      $data['EndTime']
    ]);
  }
}

