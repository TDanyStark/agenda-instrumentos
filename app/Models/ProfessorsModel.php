<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DatabaseException;

class ProfessorsModel extends Model
{

    public function getProfessors()
    {
        try {
            $query = $this->db->query('SELECT * FROM professors');
            return $query->getResult();
        } catch (DatabaseException $e) {
            // Manejar error
            return ['error' => $e->getMessage()];
        }
    }

    public function getProfessorForEdit($id)
    {
        try {
            $professor = $this->db->query('SELECT * FROM professors WHERE ProfessorID = ?', [$id]);
            // Obtener las habitaciones asociadas al profesor con RoomName
            $professorRooms = $this->db->query('
                SELECT pr.RoomID, r.RoomName 
                FROM professorrooms pr
                JOIN rooms r ON pr.RoomID = r.RoomID
                WHERE pr.ProfessorID = ?', [$id]);

            // Obtener los instrumentos asociados al profesor con InstrumentName
            $professorInstruments = $this->db->query('
                SELECT pi.InstrumentID, i.InstrumentName 
                FROM professorinstrument pi
                JOIN instruments i ON pi.InstrumentID = i.InstrumentID
                WHERE pi.ProfessorID = ?', [$id]);

            $professorAvailability = $this->db->query('
                SELECT * 
                FROM professoravailability 
                WHERE ProfessorID = ? 
                ORDER BY DayOfWeek ASC, StartTime ASC', [$id]);

            return [
                'professor' => $professor->getRow(),
                'professorRooms' => $professorRooms->getResult(),
                'professorInstruments' => $professorInstruments->getResult(),
                'professorAvailability' => $professorAvailability->getResult()
            ];
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    //******************** Add professor ******************
    public function addProfessor($data)
    {
        try {
            $this->db->query('INSERT INTO professors (Name, Email) VALUES (?, ?)', [$data['Name'], $data['Email']]);
            return $this->db->insertID();
        } catch (DatabaseException  $e) {
            return ['error' => $e->getMessage(), 'errorCode' => $e->getCode()];
        }
    }

    public function addProfessorRoom($data)
    {
        try {
            $this->db->query('INSERT INTO professorrooms (ProfessorID, RoomID) VALUES (?, ?)', [$data['ProfessorID'], $data['RoomID']]);
            return true;
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function addProfessorInstrument($data)
    {
        try {
            $this->db->query('INSERT INTO professorinstrument (ProfessorID, InstrumentID) VALUES (?, ?)', [$data['ProfessorID'], $data['InstrumentID']]);
            return true;
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function addProfessorAvailability($data)
    {
        try {
            $this->db->query('INSERT INTO professoravailability (ProfessorID, DayOfWeek, StartTime, EndTime) VALUES (?, ?, ?, ?)', [
                $data['ProfessorID'],
                $data['DayOfWeek'],
                $data['StartTime'],
                $data['EndTime']
            ]);
            return true;
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    //******************** delete professor ******************
    public function deleteProfessor($id)
    {
        try {
            $this->db->query('DELETE FROM professors WHERE ProfessorID = ?', [$id]);
            return true;
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // delete professor room
    public function deleteProfessorRooms($id)
    {
        try {
            $this->db->query('DELETE FROM professorrooms WHERE ProfessorID = ?', [$id]);
            return true;
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // delete professor instrument
    public function deleteProfessorInstruments($id)
    {
        try {
            $this->db->query('DELETE FROM professorinstrument WHERE ProfessorID = ?', [$id]);
            return true;
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // delete professor availability
    public function deleteProfessorAvailability($id)
    {
        try {
            $this->db->query('DELETE FROM professoravailability WHERE ProfessorID = ?', [$id]);
            return true;
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
