<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
	public function login()
	{
		$data['title'] = 'Login';

		$client = new Client();

		$response = $client->request('GET', 'https://travel.dlhcode.com/api/kota');
		$data = json_decode($response->getBody(), true);

		dd($data);

		return view('Auth.login', $data);
	}

	public function register()
	{
		$data['title'] = 'Register';
		return view('Auth.register', $data);
	}
}
