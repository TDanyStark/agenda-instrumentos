<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessorsModel extends Model
{
    public function getProfessors()
    {
        $query = 'SELECT * FROM professors';
        return $this->executeQuery($query); // Siempre retorna el resultado
    }

    public function getProfessorForEdit($id)
    {
        $professorQuery = 'SELECT * FROM professors WHERE ProfessorID = ?';
        $professorRoomsQuery = '
            SELECT pr.RoomID, r.RoomName 
            FROM professorrooms pr
            JOIN rooms r ON pr.RoomID = r.RoomID
            WHERE pr.ProfessorID = ?';
        $professorInstrumentsQuery = '
            SELECT pi.InstrumentID, i.InstrumentName 
            FROM professorinstrument pi
            JOIN instruments i ON pi.InstrumentID = i.InstrumentID
            WHERE pi.ProfessorID = ?';
        $professorAvailabilityQuery = '
            SELECT * 
            FROM professoravailability 
            WHERE ProfessorID = ? 
            ORDER BY DayOfWeek ASC, StartTime ASC';

        $professor = $this->executeQuery($professorQuery, [$id], true);
        $professorRooms = $this->executeQuery($professorRoomsQuery, [$id], true);
        $professorInstruments = $this->executeQuery($professorInstrumentsQuery, [$id], true);
        $professorAvailability = $this->executeQuery($professorAvailabilityQuery, [$id], true);

        return [
            "data" => [
                "professor" => $professor,
                "professorRooms" => $professorRooms,
                "professorInstruments" => $professorInstruments,
                "professorAvailability" => $professorAvailability
            ]
        ];
    }

    //******************** Add professor ******************
    public function addProfessor($data)
    {
        $query = 'INSERT INTO professors (Name, Email) VALUES (?, ?)';
        return $this->executeQuery($query, [$data['Name'], $data['Email']]);
    }

    public function addProfessorRoom($data)
    {
        $query = 'INSERT INTO professorrooms (ProfessorID, RoomID) VALUES (?, ?)';
        return $this->executeQuery($query, [$data['ProfessorID'], $data['RoomID']]);
    }

    public function addProfessorInstrument($data)
    {
        $query = 'INSERT INTO professorinstrument (ProfessorID, InstrumentID) VALUES (?, ?)';
        return $this->executeQuery($query, [$data['ProfessorID'], $data['InstrumentID']]);
    }

    public function addProfessorAvailability($data)
    {
        $query = 'INSERT INTO professoravailability (ProfessorID, DayOfWeek, StartTime, EndTime) VALUES (?, ?, ?, ?)';
        return $this->executeQuery($query, [
            $data['ProfessorID'],
            $data['DayOfWeek'],
            $data['StartTime'],
            $data['EndTime']
        ]);
    }

    //******************** delete professor ******************
    public function deleteProfessor($id)
    {
        $query = 'DELETE FROM professors WHERE ProfessorID = ?';
        return $this->executeQuery($query, [$id]);
    }

    // delete professor room
    public function deleteProfessorRooms($id)
    {
        $query = 'DELETE FROM professorrooms WHERE ProfessorID = ?';
        return $this->executeQuery($query, [$id]);
    }

    // delete professor instrument
    public function deleteProfessorInstruments($id)
    {
        $query = 'DELETE FROM professorinstrument WHERE ProfessorID = ?';
        return $this->executeQuery($query, [$id]);
    }

    // delete professor availability
    public function deleteProfessorAvailability($id)
    {
        $query = 'DELETE FROM professoravailability WHERE ProfessorID = ?';
        return $this->executeQuery($query, [$id]);
    }
}
