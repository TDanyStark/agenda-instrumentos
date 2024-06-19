<?php

namespace App\Models;

use CodeIgniter\Model;

class InstrumentsModel extends Model
{
    public function getInstruments()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM instruments ORDER BY InstrumentName ASC');
        $result = $query->getResult();
        return $result;
    }

    public function addInstrument($data)
    {
        $db = db_connect();
        $query = $db->query('INSERT INTO instruments (InstrumentName) VALUES (?)', [$data['InstrumentName']]);
        return $db->insertID();
    }

    public function deleteInstrument($id)
    {
        $db = db_connect();
        $query = $db->query('DELETE FROM instruments WHERE InstrumentID = ?', [$id]);
        return $db->affectedRows();
    }
}
