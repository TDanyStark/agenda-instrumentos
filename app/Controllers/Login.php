<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{
	public function index(): string
	{
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
		$isStudent = false;

		if (!isset($password)) {
			$isAdmin = $model->validateAdmin($cedula);

			if (!$isAdmin) {
				$response = $model->authStudent($cedula);
				$isStudent = true;
			}else{
				return redirect()->back()->withInput()->with('show_password_input', true);
			}
		} else {
			$response =	$model->authAdmin($cedula, $password);
		}


		if (!$response) {
			return redirect()->back()->withInput()->with('error', 'Cedula, contraseña incorrecta o usuario inactivo, contacte administrador');
		}
		
		// set session
		$session = session();
		$session->set('cedula', $response['cedula']);
		$session->set('role', $response['role']);

		if ($isStudent) {
			$session->set('StudentID', $response['StudentID ']);
		}

		// set cookie
		setcookie('test', 'hola wero todo bien?', time() + 7200, '/', '', false, true);

		// redirect to inicio si es admin
		if ($response['role'] == 'admin') {
			return redirect()->to('/inicio');
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
