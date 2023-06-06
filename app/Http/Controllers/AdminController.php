<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Persediaan_tiket;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data['title'] = 'Dashboard';

        $totalPemasukan = Pemesanan::where('status', 'lunas')
          ->join('persediaan_tiket', 'pemesanan.id_persediaan_tiket', '=', 'persediaan_tiket.id')
          ->sum('persediaan_tiket.harga');

        $jumlahPemesan = Pemesanan::distinct('id')->count();
        $belumBayar = Pemesanan::where('status', 'belum bayar')->distinct('id')->count();
        $lunas = Pemesanan::where('status', 'lunas')->distinct('id')->count();

        //chart
    //     $data = Pemesanan::where('status', 'lunas')
    //     ->join('persediaan_tiket', 'pemesanan.id_persediaan_tiket', '=', 'persediaan_tiket.id')
    //     ->selectRaw('YEAR(pemesanan.created_at) as year, AVG(persediaan_tiket.harga) as average')
    //     ->groupBy('year')
    //     ->get();

    //     $labels = $data->pluck('year');

    //     $averages = $data->pluck('average');

        return view('Admin.dashboard',compact('jumlahPemesan', 'belumBayar','lunas','totalPemasukan', 'data'));
    }


    ######## SUPIR ########
    public function supir()
    {
        $data['title'] = 'Kelola Supir';

        $supir = DB::table('users')
        ->join('roles','roles.id','=','users.role_id')
        ->select('users.*','roles.roles')
        ->where('users.role_id','=','3')
        ->get();
        
        return view('Admin.supir',['supir' => $supir], $data);
    }

    public function tambah_supir(Request $request)
    {
        // Validasi input menggunakan Laravel Validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $supir = [
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => bcrypt('travel123'),
            'role_id' => '3',
            'created_at' => now(),
        ];

        DB::table('users')->insert($supir);
            
        return redirect()
        ->route('supir')
        ->with('success', 'Data supir berhasil ditambahkan.');
        
    }

    public function edit_supir(Request $request, $id)
    {
          // Validasi input menggunakan Laravel Validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // Update data di tabel users
            User::where('id', $id)
                ->update([
                    'nama' => $request->input('nama'),
                    'no_hp' => $request->input('no_hp'),
                    'email' => $request->input('email'),
                ]);

        
            DB::commit();

            return redirect()->back()->with('success', 'Data supir berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Gagal memperbarui data supir.')->withInput();
        }
    }

    public function hapus_supir($id)
    {
        DB::beginTransaction();

        try {
            DB::table('users')
                ->where('id', $id)
                ->delete();

            DB::commit();

            return redirect()
                ->route('supir')
                ->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('supir')
                ->with('error', 'Gagal menghapus data.');
        }
    }

    public function roles()
    {
        $data['title'] = 'Kelola Roles';
        $roles = DB::table('roles')->get();

        return view('Admin.roles',['roles' => $roles], $data);
    }

    public function tambah_roles(Request $request)
    {
         // Validasi input menggunakan Laravel Validator
         $validator = Validator::make($request->all(), [
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $roles = [
            'roles' => $request->roles,
            'created_at' => now(),
        ];

        DB::table('roles')->insert($roles);
            
        return redirect()
            ->route('roles')
            ->with('success', 'Data Role berhasil ditambahkan.');
    }

    public function edit_roles(Request $request, $id)
    {
         // Validasi input menggunakan Laravel Validator
         $validator = Validator::make($request->all(), [
            'roles' => 'required',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // Update data di tabel roles
            Role::where('id', $id)
                ->update([
                    'roles' => $request->input('roles'),
                ]);

        
            DB::commit();

            return redirect()->back()->with('success', 'Data roles berhasil diperbarui.');
            } catch (\Exception $e) {
                DB::rollback();

                return redirect()->back()->with('error', 'Gagal memperbarui data roles.')->withInput();
            }
    }

    public function hapus_roles($id)
    {
        DB::beginTransaction();

        try {
            DB::table('roles')
                ->where('id', $id)
                ->delete();

            DB::commit();

            return redirect()
                ->route('roles')
                ->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('roles')
                ->with('error', 'Gagal menghapus data.');
        }
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
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://travel.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_kota/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'nama_kota' => $request->nama_kota,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return redirect()
            ->route('kota')
            ->withSuccess('Kota berhasil diubah');
    }

    public function form_edit_kota($id)
    {
    $data['title'] = 'Edit Kota';
    $token = session('access_token');
    $client = new Client([
    'base_uri' => 'http://travel.dlhcode.com/api/',
    'timeout' => 2.0,
    ]);
    
    $response = $client->request('GET', "get_kota/$id", [
    'headers' => [
    'Authorization' => 'Bearer ' . $token,
    'Accept' => 'application/json',
    ]
    ]);
    
    
    $data['kota'] = json_decode($response->getBody(), true);
    $data['kota'] = $data['kota']['data'][0];
   
    return view('Admin.editKota', $data);
    }

    public function hapus_kota($id)
    {
        $token = session('access_token');
    $client = new Client([
    'base_uri' => 'http://travel.dlhcode.com/api/',
    'timeout' => 2.0,
    ]);

    $response = $client->request('DELETE', "delete_kota/$id", [
    'headers' => [
    'Authorization' => 'Bearer ' . $token,
    'Accept' => 'application/json',
    ]
    ]);

    return redirect()
            ->route('kota')
            ->withSuccess('Kota berhasil dihapus');
    }

    ######## AGEN ########
    public function agen()
    {
        $data['title'] = 'Kelola Agen';
        $client = new Client();


        $response = $client->request('GET', 'http://travel.dlhcode.com/api/kota');
        $get_kota = json_decode($response->getBody(), true);
        $agen = $response->getBody();
        $get_kota['kota'] = json_decode($agen, true);
        $get_kota['kota'] = $get_kota['kota']['data'];

        $response = $client->request('GET', 'http://travel.dlhcode.com/api/tempat_agen');
        $data = json_decode($response->getBody(), true);
        $agen = $response->getBody();
        $data['tempat_agen'] = json_decode($agen, true);
        $data['tempat_agen'] = $data['tempat_agen']['data'];
        return view('Admin.agen', $data, $get_kota);
    }

    public function tambah_agen(Request $request)
    {
        $token = session('access_token');

        $addAgen = [
            'kota_id' => $request->kota_id,
            'tempat_agen' => $request->tempat_agen,
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('http://travel.dlhcode.com/api/tambah_agen', $addAgen);

        if ($response->ok()) {
            $response->json(); // data response jika request sukses
            // lakukan sesuatu dengan data response
            return redirect()
                ->route('agen.index')
                ->withSuccess('Tempat agen berhasil ditambahkan');
        } else {
            $errorMessage = $response->serverError() ? 'Server error' : 'Client error'; // pesan error
            $errorMessage .= ': ' . $response->body(); // tambahkan pesan error dari body response
            // lakukan sesuatu dengan pesan error
            return redirect()->route('agen.index')
                ->with('error', 'Tempat agen gagal disimpan');
        }
    }

    public function update_agen(Request $request, $id)
    {
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://travel.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_tempat_agen/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'kota_id' => $request->kota_id,
                'tempat_agen' => $request->tempat_agen,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return redirect()
            ->route('agen')
            ->withSuccess('Tempat agen berhasil diubah');
    }

    public function edit_agen($id)
    {
        $data['title'] = 'Edit Agen';
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://travel.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);
    
        $response = $client->request('GET', "get_tempat_agen/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',   
        ]
        ]);
    
    
        $data['tempat_agen'] = json_decode($response->getBody(), true);
        $data['tempat_agen'] = $data['tempat_agen']['data'][0];
   
        return view('Admin.edit_agen', $data);
    }

    public function hapus_tempat_agen($id)
    {
        $token = session('access_token');
    $client = new Client([
    'base_uri' => 'http://travel.dlhcode.com/api/',
    'timeout' => 2.0,
    ]);

    $response = $client->request('DELETE', "delete_tempat_agen/$id", [
    'headers' => [
    'Authorization' => 'Bearer ' . $token,
    'Accept' => 'application/json',
    ]
    ]);

    return redirect()
            ->route('agen.index')
            ->withSuccess('Tempat agen berhasil dihapus');
    }
   
    ######## SHUTTLE ########
    public function shuttle()
    {
        $data['title'] = 'Kelola Shuttle';
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://travel.dlhcode.com/api/',
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

    public function tambah_shuttle(Request $request)
    {
        $token = session('access_token');

        $addShuttle = [
            'id_jenis_mobil' => $request->id_jenis_mobil,
            'id_fasilitas' => $request->id_fasilitas,
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token, // token autentikasi
            'Accept' => 'application/json', // format respon
        ])->post('http://travel.dlhcode.com/api/tambah_shuttle', $addShuttle);

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

    public function update_shuttle(Request $request, $id)
    {
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://travel.dlhcode.com/api/',
            'timeout' => 50.0,
        ]);

        $response = $client->request('PUT', "update_shuttle/$id", [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/x-www-form-urlencoded',
            ],
            'json' => [
                'id_jenis_mobil' => $request->id_jenis_mobil,
                'id_fasilitas' => $request->id_fasilitas,
            ],
        ]);

        $data = json_decode($response->getBody(), true);
        return redirect()
            ->route('shuttle')
            ->withSuccess('shuttle berhasil diubah');
    }

    public function edit_shuttle($id)
    {
        $data['title'] = 'Edit Shuttle';
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://travel.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);
    
        $response = $client->request('GET', "get_shuttle/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);
    
    
        $data['shuttle'] = json_decode($response->getBody(), true);
        $data['shuttle'] = $data['shuttle']['data'][0];
   
        return view('Admin.edit_shuttle', $data);
    }

    public function hapus_shuttle($id)
    {
        $token = session('access_token');
        $client = new Client([
        'base_uri' => 'http://travel.dlhcode.com/api/',
        'timeout' => 2.0,
        ]);

        $response = $client->request('DELETE', "delete_shuttle/$id", [
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
        ]
        ]);

        return redirect()
            ->route('shuttle')
            ->withSuccess('Shuttle berhasil dihapus');
    }


    ######## PERSEDIAAN TIKET ########
    public function persediaan_tiket()
    {
        $data['title'] = 'Persediaan Tiket';
        $token = session('access_token');
        $response = Http::withToken("$token")->get('http://travel.dlhcode.com/api/persediaan_tiket');

        $body = $response->getBody();
        $data['persediaan_tiket'] = json_decode($body, true);
        $data['persediaan_tiket'] = $data['persediaan_tiket']['data'];
        $response = Http::get('http://travel.dlhcode.com/api/tempat_agen');
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
        ])->post('http://travel.dlhcode.com/api/tambah_persediaan_tiket', $data);

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
            'base_uri' => 'http://travel.dlhcode.com/api/',
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
            'base_uri' => 'http://travel.dlhcode.com/api/',
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
        $response = Http::get('http://travel.dlhcode.com/api/tempat_agen');
        $body_tempat_agen = $response->getBody();
        $data['tempat_agen'] = json_decode($body_tempat_agen, true);
        $data['tempat_agen'] = $data['tempat_agen']['data'];

        return view('Admin.form_persediaan', $data);
    }
    public function delete_persediaan_tiket($id)
    {
        $token = session('access_token');
        $client = new Client([
            'base_uri' => 'http://travel.dlhcode.com/api/',
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
    public function tracking()
    {
        $data['title'] = 'Tracking';

        $tracking = DB::select("SELECT users.nama, asal_kota.nama_kota, tujuan_kota.nama_kota as tujuan, tracking.lat_long, tracking.nama_lokasi, tracking.tgl, tracking.jam 
                                    FROM tracking 
                                    LEFT JOIN users 
                                    ON tracking.id_supir = users.id
                                    LEFT JOIN persediaan_tiket
                                    ON tracking.id_persediaan_tiket = persediaan_tiket.id
                                    LEFT JOIN kota AS asal_kota
                                    ON persediaan_tiket.asal = asal_kota.id
                                    LEFT JOIN kota AS tujuan_kota
                                    ON persediaan_tiket.tujuan = tujuan_kota.id
                                    WHERE users.role_id = 3 ORDER BY tracking.id ASC");
        return view('Admin.tracking', compact('tracking'), $data);
    }

    public function pemesanan()
    {
        $pemesanan = DB::table('pemesanan')
            ->join('persediaan_tiket', 'persediaan_tiket.id', '=', 'pemesanan.id_persediaan_tiket')
            ->join('tempat_agen AS t', 't.id', '=', 'persediaan_tiket.asal')
            ->join('tempat_agen', 'tempat_agen.id', '=', 'persediaan_tiket.tujuan')
            ->select('pemesanan.*','persediaan_tiket.id', 'persediaan_tiket.tgl_keberangkatan', 'persediaan_tiket.harga','t.tempat_agen AS asal', 'tempat_agen.tempat_agen AS tujuan')
            ->get();
        
        return view('Admin.pemesanan', compact('pemesanan'));
    }
}
