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

    ######## SUPIR ########
    public function supir()
    {
        $data['title'] = 'Kelola Supir';

        $token = session('access_token');

        $response = Http::withToken("$token")->get('http://travel.dlhcode.com/api/supir');
        $body_supir = $response->getBody();
        $data['users'] = json_decode($body_supir, true);
        $data['users'] = $data['users']['data'];
        dd($data);
        return view('Admin.supir', $data);
    }
    ######## KOTA ########
    public function kota()
    {
        $data['title'] = 'Kelola Kota';

        $client = new Client();

        $response = $client->request('GET', 'http://travel.dlhcode.com/api/kota');
        $data = json_decode($response->getBody(), true);


        $kota = $response->getBody();
        $data['nama_kota'] = json_decode($kota, true);
        $data['nama_kota'] = $data['nama_kota']['data'];
        return view('Admin.kota', $data);
    }

    public function tambah_kota(Request $request)
    {
        $token = session('access_token');

        $addKota = [
            'nama_kota' => $request->nama_kota,
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('http://travel.dlhcode.com/api/tambah_kota', $addKota);

        if ($response->ok()) {
            $response->json(); // data response jika request sukses
            // lakukan sesuatu dengan data response
            return redirect()
                ->route('kota')
                ->withSuccess('Kota berhasil ditambahkan');
        } else {
            $errorMessage = $response->serverError() ? 'Server error' : 'Client error'; // pesan error
            $errorMessage .= ': ' . $response->body(); // tambahkan pesan error dari body response
            // lakukan sesuatu dengan pesan error
            return redirect()->route('kota')
                ->with('error', 'Kota gagal disimpan');
        }
    }

    public function update_kota(Request $request, $id)
    {
        $client = new Client();

        // Data yang akan diperbarui
        $data = [
            'nama_kota' => $request->nama_kota,
        ];

        // Kirim permintaan PUT ke API
        $response = $client->request('PUT', 'http://travel.dlhcode.com/api/update_kota' . $id, [
            'json' => $data
        ]);

        // Decode respons JSON menjadi array asosiatif
        $responseBody = json_decode($response->getBody(), true);

        // Cek apakah data berhasil diperbarui
        if ($response->getStatusCode() == 200 && isset($responseBody['id'])) {
            // Jika berhasil, tampilkan pesan sukses dan ID data yang diperbarui
            return 'Data dengan ID ' . $responseBody['id'] . ' berhasil diperbarui';
        } else {
            // Jika gagal, tampilkan pesan error
            return 'Gagal memperbarui data';
        }
    }

    ######## AGEN ########
    public function agen()
    {
        $data['title'] = 'Kelola Agen';
        $client = new Client();

        $response = $client->request('GET', 'https://travel.dlhcode.com/api/tempat_agen');
        $data = json_decode($response->getBody(), true);
        $agen = $response->getBody();
        $data['tempat_agen'] = json_decode($agen, true);
        $data['tempat_agen'] = $data['tempat_agen']['data'];
        return view('Admin.agen', $data);
    }

    ######## SHUTTLE ########
    public function shuttle()
    {
        $data['title'] = 'Kelola Shuttle';
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'https://travel.dlhcode.com/api/',
            'timeout' => 2.0,
        ]);

        $response = $client->request('GET', "shuttle", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ]
        ]);
        $data = json_decode($response->getBody(), true);
        $shuttle = $response->getBody();
        $data['shuttle'] = json_decode($shuttle, true);
        $data['shuttle'] = $data['shuttle']['data'];
        return view('Admin.shuttle', $data);
    }



    ######## PERSEDIAAN TIKET ########
    public function persediaan_tiket()
    {
        $data['title'] = 'Persediaan Tiket';
        $token = session('access_token');
        $response = Http::withToken("$token")->get('https://travel.dlhcode.com/api/persediaan_tiket');

        $body = $response->getBody();
        $data['persediaan_tiket'] = json_decode($body, true);
        $data['persediaan_tiket'] = $data['persediaan_tiket']['data'];
        $response = Http::get('https://travel.dlhcode.com/api/tempat_agen');
        $body_tempat_agen = $response->getBody();
        $data['tempat_agen'] = json_decode($body_tempat_agen, true);
        $data['tempat_agen'] = $data['tempat_agen']['data'];

        return view('Admin.persediaan_tiket', $data);
    }
    public function tambah_persediaan_tiket(Request $request)
    {
        $token = session('access_token');

        $data = [
            'tgl_keberangkatan' => $request->tgl_keberangkatan,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'kuota' => $request->kuota,
            'estimasi_perjalanan' => $request->estimasi_perjalanan,
            'harga' => $request->harga,
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('https://travel.dlhcode.com/api/tambah_persediaan_tiket', $data);

        if ($response->ok()) {
            $responseData = $response->json(); // data response jika request sukses
            // lakukan sesuatu dengan data response
            return redirect()
                ->route('persediaan_tiket')
                ->withSuccess('Persediaan tiket berhasil ditambahkan');
        } else {
            $errorMessage = $response->serverError() ? 'Server error' : 'Client error'; // pesan error
            $errorMessage .= ': ' . $response->body(); // tambahkan pesan error dari body response
            // lakukan sesuatu dengan pesan error
            return redirect()->route('persediaan_tiket')
                ->with('error', 'Persediaan tiket gagal disimpan');
        }
    }
    public function update_persediaan_tiket(Request $request, $id)
    {
        $token = session('access_token');

        $client = new Client([
            'base_uri' => 'https://travel.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_persediaan_tiket/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'tgl_keberangkatan' => $request->tgl_keberangkatan,
                'asal' => $request->asal,
                'tujuan' => $request->tujuan,
                'kuota' => $request->kuota,
                'estimasi_perjalanan' => $request->estimasi_perjalanan,
                'harga' => $request->harga,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return redirect()
            ->route('persediaan_tiket')
            ->withSuccess('Persediaan tiket berhasil diubah');
    }
    public function form_edit_persediaan($id)
    {
        $data['title'] = 'Edit Persediaan Tiket';
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'https://travel.dlhcode.com/api/',
            'timeout' => 2.0,
        ]);

        $response = $client->request('GET', "get_persediaan/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ]
        ]);

        $data['persediaan'] = json_decode($response->getBody(), true);
        $data['persediaan'] = $data['persediaan']['data'][0];
        $response = Http::get('https://travel.dlhcode.com/api/tempat_agen');
        $body_tempat_agen = $response->getBody();
        $data['tempat_agen'] = json_decode($body_tempat_agen, true);
        $data['tempat_agen'] = $data['tempat_agen']['data'];

        return view('Admin.form_persediaan', $data);
    }
    public function delete_persediaan_tiket($id)
    {
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'https://travel.dlhcode.com/api/',
            'timeout' => 2.0,
        ]);

        $response = $client->request('DELETE', "delete_persediaan_tiket/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ]
        ]);

        return redirect()
            ->route('persediaan_tiket')
            ->withSuccess('Persediaan tiket berhasil dihapus');
    }
}
