<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\RoomsModel;

class RoomsController extends BaseController
{
    public function addRoom()
    {
        // obtener la data enviada
        $data = $this->request->getJSON();

        // validar la data
        if (!$data) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid data'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // si hay un campo vacio return error
        if (empty($data->RoomName)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Empty fields'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // cargar el modelo
        $model = new RoomsModel();

        // agregar el salon
        $id = $model->addRoom([
            'RoomName' => $data->RoomName,
        ]);

        // retornar la respuesta
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Room added',
            'id' => $id
        ]);
    }

    public function deleteRoom()
    {
        // obtener la data enviada
        $data = $this->request->getJSON();

        // validar la data
        if (!$data) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid data'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // si hay un campo vacio return error
        if (empty($data->RoomID)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Empty fields'
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }

        // cargar el modelo
        $model = new RoomsModel();

        // eliminar el salon
        $affectedRows = $model->deleteRoom($data->RoomID);

        // retornar la respuesta
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Room deleted',
            'affectedRows' => $affectedRows
        ]);
    }
}
