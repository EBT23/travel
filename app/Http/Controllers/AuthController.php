<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
				public function login()
				{
								$data['title'] = 'Login';
								return view('Auth.login', $data);
				}

				public function register()
				{
								$data['title'] = 'Register';
								return view('Auth.register', $data);
				}
}
