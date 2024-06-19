<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomsModel extends Model
{
    public function getRooms()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM rooms');
        $result = $query->getResult();
        return $result;
    }

    public function addRoom($data)
    {
        $db = db_connect();
        $query = $db->query('INSERT INTO rooms (RoomName) VALUES (?)', [$data['RoomName']]);
        return $db->insertID();
    }

    public function deleteRoom($id)
    {
        $db = db_connect();
        $query = $db->query('DELETE FROM rooms WHERE RoomID = ?', [$id]);
        return $db->affectedRows();
    }
}
