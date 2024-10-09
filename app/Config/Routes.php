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
  $routes->get('inicio', 'System\InicioController::index');
  $routes->get('inicio/getFilteredSchedules', 'System\InicioController::getFilteredSchedules');


  $routes->get('cursos', 'Admin\CoursesController::index');
  $routes->get('salones', 'Admin\RoomsController::index');
  $routes->get('profesores', 'Admin\ProfessorsController::index');
  $routes->get('estudiantes', 'Admin\StudentsController::index');
  $routes->get('instrumentos', 'Admin\InstrumentsController::index');
  $routes->get('matriculas', 'Admin\EnrollsController::index');
  $routes->get('semestres', 'Admin\SemestersController::index');
  $routes->get('configuraciones', 'Admin\SettingsController::index');
  $routes->get('crear-clase-grupal', 'Admin\GroupClassController::index');

});

// group studenst
$routes->group('', ['filter' => 'AuthStudentFilter'], static function ($routes) {
  $routes->get('horarios', 'Student\SchedulesController::index');
});

// api
$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'AuthApiFilter'], static function ($routes) {
  $routes->post('add-course', 'CoursesController::addCourse');
  $routes->post('delete-course', 'CoursesController::deleteCourse');

  $routes->post('add-semester', 'SemestersController::addSemester');
  $routes->post('delete-semester', 'SemestersController::deleteSemester');

  $routes->post('add-room', 'RoomsController::addRoom');
  $routes->post('delete-room', 'RoomsController::deleteRoom');

  $routes->post('add-instrument', 'InstrumentsApiController::addInstrument');
  $routes->post('delete-instrument', 'InstrumentsApiController::deleteInstrument');

  $routes->post('add-professor', 'ProfessorsController::addProfessor');
  $routes->post('delete-professor', 'ProfessorsController::deleteProfessor');
  $routes->post('get-professor', 'ProfessorsController::getProfessorForEdit');
  $routes->post('update-professor', 'ProfessorsController::updateProfessor');

  $routes->post('add-student', 'StudentsController::addStudent');
  $routes->post('delete-student', 'StudentsController::deleteStudent');
  $routes->post('get-student', 'StudentsController::getStudentForEdit');
  $routes->post('update-student', 'StudentsController::updateStudent');

  $routes->post('add-enroll', 'EnrollsController::addEnroll');
  $routes->post('delete-enroll', 'EnrollsController::deleteEnroll');
  $routes->post('get-enroll', 'EnrollsController::getEnrollForEdit');
  $routes->post('update-enroll', 'EnrollsController::updateEnroll');
  

  $routes->get('search/(:segment)', 'SearchController::index/$1');

  $routes->post('settings/guardar', 'SettingsController::guardar');

  $routes->get('get-schedule/(:num)', 'ApiScheduleController::getSchedule/$1');
});

$routes->group('api', ['namespace' => 'App\Controllers\Api'], static function ($routes) {
  $routes->post('student-schedule', 'ApiScheduleController::addSchedule');
  $routes->post('schedule/getAvailableSchedules', 'ApiScheduleController::getAvailableSchedules');
  $routes->post('schedule/saveSchedule', 'ApiScheduleController::saveSchedule');
});