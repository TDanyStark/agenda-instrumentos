<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\SettingsModel;

class Login extends BaseController
{
	public function index()
	{
		// validar si ya esta logeado y es admin
		$session = session();
		if ($session->get('role') == 'admin') {
			return redirect()->to('/inicio');
		}

		// validar si es estudiante
		if ($session->get('role') == 'student') {
			return redirect()->to('/horarios');
		}
		

		$data["title"] = "Login - Agendamiento CZ";

		return view("template/header", $data)
			. view("login")
			. view("template/footer");
	}

	public function auth()
	{
		// rules cedula only numbers and password
		$rules = [
			'cedula' => 'required|numeric',
			'password' => 'required'
		];

		// // validate
		// if (!$this->validate($rules)) {
		// 	return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		// }

		// get data
		$cedula = $this->request->getPost('cedula');
		$password = $this->request->getPost('password');

		// instance model
		$model = new LoginModel();

		if (!isset($password)) {
			$isAdmin = $model->validateAdmin($cedula);

			if (!$isAdmin) {
				$response = $model->authStudent($cedula);
			}else{
				return redirect()->back()->withInput()->with('show_password_input', true);
			}
		} else {
			$response =	$model->authAdmin($cedula, $password);
		}


		if (!$response) {
			return redirect()->back()->withInput()->with('error', 'Cedula, contraseña incorrecta o usuario inactivo, contacte administrador');
		}

		$modelSettings = new SettingsModel();
		$canLogged = $modelSettings->getSetting("escoger_horario");

		if ($canLogged == 1 && $response['role'] !== 'admin') {
			return redirect()->back()->withInput()->with('error', 'El sistema se encuentra deshabilitado, contacte administrador');
		}

		
		// set session
		$session = session();
		$session->set('cedula', $response['cedula']);
		$session->set('role', $response['role']);

		// redirect to inicio si es admin
		if ($response['role'] == 'admin') {
			return redirect()->to('/inicio');
		}
		if ($response['role'] == 'student') {
			$session->set('StudentID', $response['StudentID']);
		}
		return redirect()->to('/horarios');
	}

	public function logout()
	{
		$session = session();
		$session->destroy();

		// delete cookie
		setcookie('test', '', time() - 3600, '/', '', false, true);

		return redirect()->to('/');
	}
}
