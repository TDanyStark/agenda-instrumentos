<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomsModel extends Model
{
    public function getRooms()
    {
        $query = 'SELECT * FROM rooms';
        return $this->executeQuery($query); // Siempre retorna el resultado, el controlador maneja el error
    }

    public function addRoom($data)
    {
        $query = 'INSERT INTO rooms (RoomName) VALUES (?)';
        return $this->executeQuery($query, [$data['RoomName']]); // Siempre retorna el resultado, el controlador maneja el error
    }

    public function deleteRoom($id)
    {
        $query = 'DELETE FROM rooms WHERE RoomID = ?';
        return $this->executeQuery($query, [$id]); // Siempre retorna el resultado, sea éxito o error
    }
}
