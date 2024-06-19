<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Login::index');

// login
$routes->post('/login', 'Login::auth');
$routes->get('/logout', 'Login::logout');

// group system
$routes->group('', ['filter' => 'AuthFilter'], static function ($routes) {
  $routes->get('inicio', 'System\Inicio::index');

  $routes->get('cursos', 'Admin\Cursos::index');
  $routes->get('salones', 'Admin\RoomsController::index');
  $routes->get('profesores', 'Admin\ProfessorsController::index');
  $routes->get('estudiantes', 'Admin\StudentsController::index');
  $routes->get('instrumentos', 'Admin\InstrumentsController::index');
});

// api
$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'AuthApiFilter'], static function ($routes) {
  $routes->post('add-course', 'CoursesController::addCourse');
  $routes->post('delete-course', 'CoursesController::deleteCourse');

  $routes->post('add-room', 'RoomsController::addRoom');
  $routes->post('delete-room', 'RoomsController::deleteRoom');

  $routes->post('add-instrument', 'InstrumentsApiController::addInstrument');
  $routes->post('delete-instrument', 'InstrumentsApiController::deleteInstrument');

});