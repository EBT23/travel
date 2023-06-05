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
		return view('Auth.login', $data);
	}
	public function aksi_login(Request $request)
	{
		$client = new Client();

		$response = $client->request('POST', 'http://travel.dlhcode.com/api/login', [
			'form_params' => [
				'email' => $request->email,
				'password' => $request->password,
			]
		]);

		$body = $response->getBody();
		$data = json_decode($body, true);

		if (isset($data['data'])) {
			// Jika access_token ditemukan, simpan ke session dan redirect ke halaman dashboard
			session(['access_token' => $data['data']]);
			return redirect()->route('dashboard');
		} else {
			// Jika access_token tidak ditemukan, redirect kembali ke halaman login
			return redirect()->back();
		}
	}

	public function register()
	{
		$data['title'] = 'Register';
		return view('Auth.register', $data);
	}
	public function logout()
	{
		$data['title'] = 'Logout';

        $token = session('access_token');

        $response = Http::withToken("$token")->get('http://travel.dlhcode.com/api/logout');
        $body_logout = $response->getBody();
        $data['logout'] = json_decode($body_logout, true);
        return redirect()->route('login');
       
	}
}
