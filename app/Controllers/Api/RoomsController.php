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
            ])->setStatusCode(400);
        }

        // si hay un campo vacio return error
        if (empty($data->RoomName)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Empty fields'
            ])->setStatusCode(400);
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
            ])->setStatusCode(400);
        }

        // si hay un campo vacio return error
        if (empty($data->RoomID)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Empty fields'
            ])->setStatusCode(400);
        }

        // cargar el modelo
        $model = new RoomsModel();

        // eliminar el salon
        $affectedRows = $model->deleteRoom($data->RoomID);

        if (isset($affectedRows['error'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'El salon esta asociado a un profesor, o a un horario, no se puede eliminar',
                'error' => $affectedRows['error'],
                'errorCode' => $affectedRows['errorCode']
            ])->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }

        // retornar la respuesta
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Room deleted'
        ]);
    }
}
