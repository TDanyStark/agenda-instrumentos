<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    protected function formatResponse($result, $successMessage = '', $errorMessage = 'Ocurrió un error')
    {
        if (isset($result['status']) && $result['status'] === 'error') {

            $message = '';

            if (isset($result['errorCode'])) {
                switch ($result['errorCode']) {
                    case 1062:
                        $message = 'El registro ya existe en la base de datos';
                        break;
                    case 1451:
                        $message = 'El registro está asociado a otros registros y no puede ser eliminado';
                        break;
                    default:
                        $message = $errorMessage;
                        break;
                }
            }


            return $this->response->setJSON([
                'status' => 'error',
                'message' => $message,
                'errorCode' => $result['errorCode'] ?? null
            ])->setStatusCode(400);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => $successMessage,
            'data' =>  isset($result['data']) ? $result['data'] : null
        ]);
    }
}
