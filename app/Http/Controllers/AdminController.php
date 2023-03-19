<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $token = session('access_token');
        $response = Http::withToken("$token")->get('https://travel.dlhcode.com/api/supir');
        $body = $response->getBody();
        $data['persediaan_tiket'] = json_decode($body, true);

        $response = Http::get('https://travel.dlhcode.com/api/supir');
        $body_supir = $response->getBody();
        $data['users'] = json_decode($body_supir, true);
        $data['users'] = $data['users']['data'];

        return view('Admin.supir', $data);
    }

<<<<<<< HEAD

    public function kota()
    {
        $data['title'] = 'Kelola Kota';

        $client = new Client();

        $response = $client->request('GET', 'http://travel.dlhcode.com/api/kota');
        $data = json_decode($response->getBody(), true);
        

        $kota = $response->getBody();
        $data['nama_kota'] = json_decode($kota, true);
        $data['nama_kota'] = $data['nama_kota']['data'];
=======
    public function kota()
    {
        $data['title'] = 'Kelola Kota';
        $token = session('access_token');
        $response = Http::withToken("$token")->get('https://travel.dlhcode.com/api/kota');
        $body = $response->getBody();
        $data['kota'] = json_decode($body, true);
        $data['kota'] = $data['kota']['data'];
>>>>>>> c79824fdadd346597685c0e4ca6fc3b5f2e05b77

        return view('Admin.kota', $data);
    }

<<<<<<< HEAD
//agen
   
=======
>>>>>>> c79824fdadd346597685c0e4ca6fc3b5f2e05b77
    public function persediaan_tiket()
    {
        $data['title'] = 'Persediaan Tiket';
        $token = session('access_token');
        $response = Http::withToken("$token")->get('https://travel.dlhcode.com/api/persediaan_tiket');

        $body = $response->getBody();
        $data['persediaan_tiket'] = json_decode($body, true);

        $response = Http::get('https://travel.dlhcode.com/api/tempat_agen');
        $body_tempat_agen = $response->getBody();
        $data['tempat_agen'] = json_decode($body_tempat_agen, true);
        $data['tempat_agen'] = $data['tempat_agen']['data'];


        return view('Admin.persediaan_tiket', $data);
    }
    public function tambah_persediaan_tiket()
    {
    }
}