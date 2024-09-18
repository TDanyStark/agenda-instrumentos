<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\StudentsModel;
use CodeIgniter\HTTP\ResponseInterface;

class SearchController extends BaseController
{
    public function index($entityType)
    {
        $query = $this->request->getGet('q');

        if (strlen($query) < 3) {
            return $this->formatResponse( ['status' => 'error'], 'La consulta debe tener al menos 3 caracteres', ResponseInterface::HTTP_BAD_REQUEST);
        }

        $result = [];

        switch ($entityType) {
            case 'students':
                $model = new StudentsModel();
                $result = $model->searchStudents($query);

                if (isset($result['status']) && $result['status'] === 'error') {
                    return $this->formatResponse(['status' => 'error'], "", "Error al buscar el estudiante");
                }

                break;

            default:
                return $this->formatResponse(['status' => 'error'],"", "Error entidad no encontrada");
        }

        return $this->formatResponse($result, "Resultados de la búsqueda", ResponseInterface::HTTP_OK);
    }
}
