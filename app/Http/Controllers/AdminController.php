<?php

namespace App\Http\Controllers;

use App\Models\DetailFasilitas;
use App\Models\Fasilitas;
use App\Models\Jadwal;
use App\Models\Pemesanan;
use App\Models\Persediaan_tiket;
use App\Models\Role;
use App\Models\Rute;
use App\Models\Shuttle;
use App\Models\TempatAgen;
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
            ->join('jadwal_keberangkatan', 'pemesanan.id_jadwal', '=', 'jadwal_keberangkatan.id')
            ->sum('jadwal_keberangkatan.harga');

        $jumlahPemesan = Pemesanan::distinct('id')->count();
        $belumBayar = Pemesanan::where('status', 'belum bayar')->distinct('id')->count();
        $lunas = Pemesanan::where('status', 'lunas')->distinct('id')->count();

        return view('admin.dashboard',compact('jumlahPemesan','totalPemasukan', 'belumBayar','lunas', 'data'));
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
        
        return view('admin.supir',['supir' => $supir], $data);
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

        return view('admin.roles',['roles' => $roles], $data);
    }

    public function tambah_roles(Request $request)
    {
    
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
        $validator = Validator::make($request->all(), [
            'roles' => 'required',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
        
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


    ######## RUTE ########
    public function rute()
    {
        $data['title'] = 'Kelola Jurusan';
        $getRute = Rute::all();
    
        return view('admin.rute', compact('getRute'), $data);
    }

    public function tambah_rute(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keberangkatan' => 'required',
            'tujuan' => 'required',
            'waktu' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'keberangkatan' => $request->keberangkatan,
            'tujuan' => $request->tujuan,
            'waktu' => $request->waktu,
            'created_at' => now(),
        ];
        DB::table('rute')->insert($data);
            
        return redirect()
        ->route('rute')
        ->with('success', 'Data berhasil ditambahkan.');
    }

    public function update_rute(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'keberangkatan' => 'required',
            'tujuan' => 'required',
            'waktu' => 'required',
        ]);

        $user = Rute::find($id);
        $user->keberangkatan = $request->input('keberangkatan');
        $user->tujuan = $request->input('tujuan');
        $user->waktu = $request->input('waktu');
    
        $user->save();
        
        return redirect()
            ->route('rute')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function edit_rute($id)
    {
        $data['title'] = 'Edit Rute';
        $rute  = Rute::find($id);

        return view('admin.edit_rute',compact('rute'), $data);
    }

    public function delete_rute($id)
    {
            $route = Rute::findOrFail($id);
            $route->delete();

            return redirect() 
            ->route('rute')
            ->with('success', 'Rute berhasil dihapus.');
    }
    ######## ARMADA ########
    public function armada()
    {
        $data['title'] = 'Kelola Armada';
    
        $getArmada = DB::table('armada')->get();

        return view('admin.armada',compact('getArmada'), $data);
    }

    public function tambah_armada(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nopol' => 'required',
            'jenis_mobil' => 'required',
            'kapasitas' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'nopol' => $request->nopol,
            'jenis_mobil' => $request->jenis_mobil,
            'kapasitas' => $request->kapasitas,
            'created_at' => now(),
        ];

        DB::table('armada')->insert($data);
            
        return redirect()
        ->route('armada')
        ->with('success', 'Data berhasil ditambahkan.');
    }

    public function update_armada(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'nopol' => 'required',
            'jenis_mobil' => 'required',
            'kapasitas' => 'required',
            
        ]);

        $user = Shuttle::find($id);
        $user->nopol = $request->input('nopol');
        $user->jenis_mobil = $request->input('jenis_mobil');
        $user->kapasitas = $request->input('kapasitas');


        $user->save();
        
        return redirect()
            ->route('armada')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function edit_armada($id)
    {
        $data['title'] = 'Edit Armada';
        $armada  = Shuttle::find($id);

        return view('admin.edit_armada',compact('armada'), $data);
    }

    public function hapus_armada($id)
    {
        $armada = Shuttle::findOrFail($id);
        $armada->delete();

        return redirect() 
        ->route('armada')
        ->with('success', 'Armada berhasil dihapus.');
    }

    public function fasilitas()
    {
        $data['title'] = 'Kelola Fasilitas';
    
        $getFasilitas = DB::table('fasilitas')->get();

        return view('admin.fasilitas',compact('getFasilitas'), $data);
    }

    public function tambah_fasilitas(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'nama_fasilitas' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'nama_fasilitas' => $request->nama_fasilitas,
            'created_at' => now(),
        ];

        DB::table('fasilitas')->insert($data);
            
        return redirect()
        ->route('fasilitas')
        ->with('success', 'Data berhasil ditambahkan.');
    }

    public function update_fasilitas(Request $request, $id)
    {
    
        $validator = Validator::make($request->all(), [
            'nama_fasilitas' => 'required',
            
        ]);

        $user = Fasilitas::find($id);
        $user->nama_fasilitas = $request->input('nama_fasilitas');
    
        $user->save();
        
        return redirect()
            ->route('fasilitas')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function edit_fasilitas($id)
    {
        $data['title'] = 'Edit Fasilitas';
        $fasilitas  = Fasilitas::find($id);

        return view('admin.edit_fasilitas',compact('fasilitas'), $data);
    }

    public function hapus_fasilitas($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->delete();

        return redirect() 
        ->route('fasilitas')
        ->with('success', 'Fasilitas berhasil dihapus.');
    }

    public function detail_fasilitas()
    {
        $data['title'] = 'Kelola Detail Fasilitas';
        
        $fasilitas = DB::table('fasilitas')->get();
        $armada = DB::table('armada')->get();

        $getDetail = DB::table('detail_fasilitas')
            ->join('armada','detail_fasilitas.id_armada','=','armada.id')
            ->join('fasilitas','detail_fasilitas.id_fasilitas','=','fasilitas.id')
            ->select('armada.*','fasilitas.nama_fasilitas')
            ->get();

        return view('admin.detail_fasilitas',compact('getDetail','fasilitas','armada'), $data);
    }

    public function tambah_detail_fasilitas(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'id_armada' => 'required',
            'id_fasilitas' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'id_armada' => $request->id_armada,
            'id_fasilitas' => $request->id_fasilitas,
            'created_at' => now(),
        ];

        DB::table('detail_fasilitas')->insert($data);
            
        return redirect()
            ->route('detail_fasilitas')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function update_detail_fasilitas(Request $request, $id)
    {
    
        $validator = Validator::make($request->all(), [
            'id_armada' => 'required',
            'id_fasilitas' => 'required',
            
        ]);

        $user = DetailFasilitas::find($id);
        $user->id_armada = $request->input('id_armada');
        $user->id_fasilitas = $request->input('id_fasilitas');
    
        $user->save();
        
        return redirect()
            ->route('detail_fasilitas')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function edit_detail_fasilitas($id)
    {
        $data['title'] = 'Edit Detail Fasilitas';

        $fasilitas = DB::table('fasilitas')->get();
        $armada = DB::table('armada')->get();
        $detfasilitas  = DetailFasilitas::find($id);

        return view('admin.edit_detail_fasilitas',compact('detfasilitas','fasilitas','armada'), $data);
    }

    public function hapus_detail_fasilitas($id)
    {
        $detfasilitas = DetailFasilitas::findOrFail($id);
        $detfasilitas->delete();

        return redirect() 
        ->route('detail_fasilitas')
        ->with('success', 'Detail Fasilitas berhasil dihapus.');
    }


    ######## JADWAL ########
    public function jadwal()
    {
        $data['title'] = 'Jadwal Keberangkatan';
        
        $supir = DB::table('users')->where('users.role_id','=','3')->get();
        $armada = DB::table('armada')->get();
        $rute = DB::table('rute')->get();

        $getJadwal = DB::table('jadwal_keberangkatan')
            ->join('armada','jadwal_keberangkatan.id_armada','=','armada.id')
            ->join('rute','jadwal_keberangkatan.rute','=','rute.id')
            ->join('users','jadwal_keberangkatan.id_user','=','users.id')
            ->select('jadwal_keberangkatan.*','armada.nopol','armada.jenis_mobil','armada.kapasitas',
            'rute.keberangkatan','rute.tujuan','rute.waktu','users.nama')
            ->get();

        return view('admin.jadwal', compact('getJadwal','supir','armada','rute'), $data);
    }
    public function tambah_jadwal(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'tgl_keberangkatan' => 'required',
            'id_armada' => 'required',
            'rute' => 'required',
            'id_user' => 'required',
            'estimasi_perjalanan' => 'required',
            'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'tgl_keberangkatan' => $request->tgl_keberangkatan,
            'id_armada' => $request->id_armada,
            'rute' => $request->rute,
            'id_user' => $request->id_user,
            'estimasi_perjalanan' => $request->estimasi_perjalanan,
            'harga' => $request->harga,
            'created_at' => now(),
        ];

        DB::table('jadwal_keberangkatan')->insert($data);
            
        return redirect()
            ->route('jadwal')
            ->with('success', 'Data berhasil ditambahkan.');
    }
    public function update_jadwal(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tgl_keberangkatan' => 'required',
            'id_armada' => 'required',
            'rute' => 'required',
            'id_user' => 'required',
            'estimasi_perjalanan' => 'required',
            'harga' => 'required',
            
        ]);

        $user = Jadwal::find($id);
        $user->tgl_keberangkatan = $request->input('tgl_keberangkatan');
        $user->id_armada = $request->input('id_armada');
        $user->rute = $request->input('rute');
        $user->id_user = $request->input('id_user');
        $user->estimasi_perjalanan = $request->input('estimasi_perjalanan');
        $user->harga = $request->input('harga');
    
        $user->save();
        
        return redirect()
            ->route('jadwal')
            ->with('success', 'Data berhasil diperbarui.');
    }
    public function edit_jadwal($id)
    {
        $data['title'] = 'Edit Jadwal Keberangkatan';

        $supir = DB::table('users')->where('users.role_id','=','3')->get();
        $armada = DB::table('armada')->get();
        $rute = DB::table('rute')->get();
        $jadwal  = Jadwal::find($id);

        return view('admin.edit_jadwal',compact('jadwal','supir','armada','rute'), $data);
    }
    public function delete_jadwal($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect() 
        ->route('jadwal')
        ->with('success', 'Jadwal berhasil dihapus.');
    }
    public function tracking()
    {
        $data['title'] = 'Tracking';

        $tracking = DB::select("SELECT users.nama, asal_kota.nama_kota, tujuan_kota.nama_kota as tujuan, tracking.lat_long, tracking.nama_lokasi, tracking.tgl, tracking.jam 
                                    FROM tracking 
                                    LEFT JOIN users 
                                    ON tracking.id_supir = users.id
                                    LEFT JOIN jadwal_keberangkatan
                                    ON tracking.jadwal_keberangkatan = jadwal_keberangkatan.id
                                    LEFT JOIN kota AS asal_kota
                                    ON jadwal_keberangkatan.asal = asal_kota.id
                                    LEFT JOIN kota AS tujuan_kota
                                    ON jadwal_keberangkatan.tujuan = tujuan_kota.id
                                    WHERE users.role_id = 3 ORDER BY tracking.id ASC");
        return view('Admin.tracking', compact('tracking'), $data);
    }

    public function pemesanan()
    {
        $data['title'] = 'Pemesanan';

        $pemesanan = DB::table('pemesanan')
            ->join('jadwal_keberangkatan', 'pemesanan.id_jadwal', '=', 'jadwal_keberangkatan.id')
            ->join('rute', 'jadwal_keberangkatan.rute', '=', 'rute.id')
            ->join('users', 'pemesanan.id_user', '=', 'users.id')
            ->join('kursi', 'pemesanan.no_kursi', '=', 'kursi.id')
            ->select('pemesanan.*','jadwal_keberangkatan.id', 'jadwal_keberangkatan.tgl_keberangkatan', 'jadwal_keberangkatan.harga','rute.keberangkatan', 'rute.tujuan','rute.waktu')
            ->get();
        
        return view('admin.pemesanan', compact('pemesanan'), $data);
    }
}
