<?php

namespace App\Models;

use CodeIgniter\Model;

class InstrumentsModel extends Model
{
    public function getInstruments()
    {   
        $query = 'SELECT * FROM instruments ORDER BY InstrumentName ASC';
        return $this->executeQuery($query); // Siempre retorna el resultado
    }

    public function addInstrument($data)
    {
        $query = 'INSERT INTO instruments (InstrumentName) VALUES (?)';
        return $this->executeQuery($query, [$data['InstrumentName']]); // Siempre retorna el resultado
    }

    public function deleteInstrument($id)
    {
        $query = 'DELETE FROM instruments WHERE InstrumentID = ?';
        return $this->executeQuery($query, [$id]); // Siempre retorna el resultado, sea éxito o error
    }
}
