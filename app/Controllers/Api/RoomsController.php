<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\RoomsModel;

class RoomsController extends BaseController
{
    public function addRoom()
    {
        // Obtener la data enviada
        $json = $this->request->getJSON(true);

        // Cargar el modelo
        $model = new RoomsModel();

        // Agregar el salón
        $result = $model->addRoom([
            'RoomName' => $json['RoomName']
        ]);

        // Retornar la respuesta utilizando formatResponse
        return $this->formatResponse($result, 'Room added successfully', 'Error adding room');
    }

    public function deleteRoom()
    {
        // Obtener la data enviada
        $json = $this->request->getJSON(true);

        // Cargar el modelo
        $model = new RoomsModel();

        // Eliminar el salón
        $result = $model->deleteRoom($json['RoomID']);

        // Retornar la respuesta utilizando formatResponse
        return $this->formatResponse($result, 'Room deleted successfully', 'The room is associated with a professor or schedule, and cannot be deleted');
    }
}
