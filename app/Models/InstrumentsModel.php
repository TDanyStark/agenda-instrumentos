<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DatabaseException;

class InstrumentsModel extends Model
{
    public function getInstruments()
    {   
        $query = $this->db->query('SELECT * FROM instruments ORDER BY InstrumentName ASC');
        $result = $query->getResult();
        return $result;
    }

    public function addInstrument($data)
    {
        $query = $this->db->query('INSERT INTO instruments (InstrumentName) VALUES (?)', [$data['InstrumentName']]);
        return $this->db->insertID();
    }

    public function deleteInstrument($id)
    {
        try {
            $query = $this->db->query('DELETE FROM instruments WHERE InstrumentID = ?', [$id]);
            return [
                'status' => 'success',
                'message' => 'Room deleted'
            ];
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage(), 'errorCode' => $e->getCode()];
        }
    }
}
