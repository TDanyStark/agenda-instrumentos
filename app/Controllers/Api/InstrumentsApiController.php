<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\InstrumentsModel;

class InstrumentsApiController extends BaseController
{
  public function addInstrument()
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
    if (empty($data->InstrumentName)) {
      return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Empty fields'
      ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
    }

    // cargar el modelo
    $model = new InstrumentsModel();

    // agregar el instrumento
    $id = $model->addInstrument([
      'InstrumentName' => $data->InstrumentName
    ]);

    // retornar la respuesta
    return $this->response->setJSON([
      'status' => 'success',
      'message' => 'Instrument added',
      'id' => $id
    ]);
  }

  public function deleteInstrument()
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
    if (empty($data->InstrumentID)) {
      return $this->response->setJSON([
        'status' => 'error',
        'message' => 'Empty fields'
      ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
    }

    // cargar el modelo
    $model = new InstrumentsModel();

    // eliminar el instrumento
    $affectedRows = $model->deleteInstrument($data->InstrumentID);

    // retornar la respuesta
    return $this->response->setJSON([
      'status' => 'success',
      'message' => 'Instrument deleted',
      'affectedRows' => $affectedRows
    ]);
  }
  
}
