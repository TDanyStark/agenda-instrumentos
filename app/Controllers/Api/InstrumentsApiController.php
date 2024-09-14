<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\InstrumentsModel;

class InstrumentsApiController extends BaseController
{
  public function addInstrument()
  {
    // Obtener la data enviada
    $data = $this->request->getJSON(true); // true lo convierte en array asociativo

    // Cargar el modelo
    $model = new InstrumentsModel();

    // Agregar el instrumento
    $result = $model->addInstrument([
      'InstrumentName' => $data['InstrumentName']
    ]);

    // Retornar la respuesta usando formatResponse
    return $this->formatResponse($result, 'Instrument added successfully', 'Error adding instrument');
  }

  public function deleteInstrument()
  {
    // Obtener la data enviada
    $data = $this->request->getJSON(true); // true lo convierte en array asociativo

    // Cargar el modelo
    $model = new InstrumentsModel();

    // Eliminar el instrumento
    $result = $model->deleteInstrument($data['InstrumentID']);

    // Retornar la respuesta usando formatResponse
    return $this->formatResponse($result, 'Instrument deleted successfully', 'Error deleting instrument. It may be associated with a professor or student.');
  }
}
