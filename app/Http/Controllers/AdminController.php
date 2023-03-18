<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data['title'] = 'Dashboard';

        return view('Admin.dashboard', $data);
    }
    public function supir()
    {
        $data['title'] = 'Kelola Supir';

        $client = new Client();

        $response = $client->request('GET', 'http://travel.dlhcode.com/api/supir');
        $data = json_decode($response->getBody(), true);
        dd($data);

        return view('Admin.supir', $data);
    }
}
