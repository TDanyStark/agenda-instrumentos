<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Exceptions\DatabaseException;

class RoomsModel extends Model
{
    public function getRooms()
    {
        $query = $this->db->query('SELECT * FROM rooms');
        $result = $query->getResult();
        return $result;
    }

    public function addRoom($data)
    {
        $query = $this->db->query('INSERT INTO rooms (RoomName) VALUES (?)', [$data['RoomName']]);
        return $this->db->insertID();
    }

    public function deleteRoom($id)
    {
        try {
            $query = $this->db->query('DELETE FROM rooms WHERE RoomID = ?', [$id]);
            return [
                'status' => 'success',
                'message' => 'Room deleted'
            ];
        } catch (DatabaseException $e) {
            return ['error' => $e->getMessage(), 'errorCode' => $e->getCode()];
        }
    }
}
