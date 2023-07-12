<?php

namespace App\Http\Controllers\api;

use App\Models\Kota;
use App\Models\Role;
use App\Models\Shuttle;
use App\Models\Pemesanan;
use App\Models\TempatAgen;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Persediaan_tiket;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Kursi;
use Exception;
use Illuminate\Foundation\Auth\User;

class ApiAllController extends Controller
{
    public function role()
    {
        $role = Role::all();
        return response()->json([
            'data' => $role
        ]);
    }
    public function tambah_role(Request $request)
    {
        // validasi input
        $validated = $request->validate([
            'roles' => 'required',
        ]);

        // simpan data ke database
        $data = new Role;
        $data->roles = $validated['roles'];
        $data->save();

        // kirim response
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }
    public function update_role(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->all());
        return response()->json($role, 200);
    }
    public function delete_role($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(null, 204);
    }
    public function shuttle()
    {   
        $shuttle = DB::table('shuttle')->get();

        return response()->json([
            'success' => true,
            'data' => $shuttle
        ]);
    }
    public function tambah_shuttle(Request $request)
    {
        // validasi input
         $validated = $request->validate([
            'jenis_mobil' => 'required',
            'kapasitas' => 'required',
            'fasilitas' => 'required',
        ]);

        // simpan data ke database
        $data = new Shuttle;
        $data->jenis_mobil = $validated['jenis_mobil'];
        $data->kapasitas = $validated['kapasitas'];
        $data->fasilitas = $validated['fasilitas'];
        $data->save();

        // kirim response
        return response()->json([
            'success' => true,
            'message' => 'Armada berhasil dibuat',
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function update_shuttle(Request $request, $id)
    {
        $shuttle = Shuttle::findOrFail($id);
        $shuttle->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Armada berhasil dirubah',
            'data' => $shuttle
        ]);
    }
    public function delete_shuttle($id)
    {
        $shuttle = Shuttle::findOrFail($id);
        $shuttle->delete();
        return response()->json([
            'success' => true,
            'message' => 'Armada berhasil dihapus',
            'data' => $shuttle
        ]);
    }
    public function persediaan_tiket()
    {
       $persediaan_tiket = DB::table('persediaan_tiket')
            ->join('tempat_agen AS t', 't.id', '=', 'persediaan_tiket.asal')
            ->join('tempat_agen', 'tempat_agen.id', '=', 'persediaan_tiket.tujuan')
            ->join('shuttle','shuttle.id','=','persediaan_tiket.id_shuttle')
            ->select('persediaan_tiket.id', 'persediaan_tiket.tgl_keberangkatan', 'persediaan_tiket.tgl_keberangkatan', 
            'persediaan_tiket.kuota', 'persediaan_tiket.estimasi_perjalanan', 'persediaan_tiket.harga', 't.tempat_agen AS asal', 
            'tempat_agen.tempat_agen AS tujuan','shuttle.jenis_mobil','shuttle.kapasitas','shuttle.fasilitas')
            ->get();
            
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $persediaan_tiket
        ]);
    }
    public function tambah_persediaan_tiket(Request $request)
    {
        $validated = $request->validate([
            'tgl_keberangkatan' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
            'kuota' => 'required',
            'id_shuttle' => 'required',
            'estimasi_perjalanan' => 'required',
            'harga' => 'required',
        ]);

        $persediaan_tiket = DB::table('persediaan_tiket')->insert([
            'tgl_keberangkatan' => $request->tgl_keberangkatan,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'kuota' => $request->kuota,
            'id_shuttle' => $request->id_shuttle,
            'estimasi_perjalanan' => $request->estimasi_perjalanan,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Persediaan tiket berhasil dibuat',
            'data' => $persediaan_tiket
        ], Response::HTTP_OK);
    }
    public function update_persediaan_tiket(Request $request, $id)
    {
        $persediaan_tiket = Persediaan_tiket::findOrFail($id);
        $persediaan_tiket->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Persediaan tiket berhasil dirubah',
            'data' => $persediaan_tiket
        ]);
    }
    public function delete_persediaan_tiket($id)
    {
        $persediaan_tiket = Persediaan_tiket::findOrFail($id);
        $persediaan_tiket->delete();
        return response()->json([
            'success' => true,
            'message' => 'Persediaan tiket berhasil dihapus',
            'data' => $persediaan_tiket
        ]);
    }
    // Supir
    public function supir()
    {
        $supir = DB::table('roles')
            ->join('users', 'roles.id', '=', 'users.role_id')
            ->select('users.*', 'roles.roles')
            ->where('roles.id', '=', '3')
            ->get();

        return response()->json($supir);
    }

    public function tambah_supir(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ], [
            'password.min' => 'password minimal 6',
            'email.unique' => 'email sudah digunakan',
        ]);

        $users = DB::table('users')->insert([
            'nama' => $request->nama,
            'no_hp' => $request->password,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 3,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'supir berhasil ditambahkan',
            'data' => $users
        ], Response::HTTP_OK);
    }

    public function update_supir(Request $request, $id)

    {
        $data = $request->only(
            'nama',
            'no_hp',
            'email',
            'password',
            'role_id',
        );


        $supir = DB::table('users')
            ->where('id', $id)
            ->update([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
            ]);
        return response()->json([
            'success' => true,
            'message' => 'supir berhasil ditambahkan',
            'data' => $request->all()
        ], Response::HTTP_OK);
    }

    public function delete_supir($id)
    {
        $supir = User::findOrFail($id);
        $supir->delete();
        return response()->json(null, 204);
    }

    // KOTA
    public function kota()
    {
        $kota = Kota::all();
        return response()->json([
            'data' => $kota
        ]);
    }

    public function tambah_kota(Request $request)
    {
        $validated = $request->validate([
            'nama_kota' => 'required',
        ]);

        // simpan data ke database
        $data = new Kota;
        $data->nama_kota = $validated['nama_kota'];
        $data->save();

        // kirim response
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil ditambah'
        ]);
    }

    public function update_kota(Request $request, $id)
    {
        $kota = Kota::findOrFail($id);
        $kota->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'kota berhasil diupdate',
            'data' => $kota, 200
        ]);
    }

    public function delete_kota($id)
    {
        $kota = Kota::findOrFail($id);
        $kota->delete();
        return response()->json(null, 204);
    }

    // TEMPAT AGEN

    public function tempat_agen()
    {
        $kota = Kota::all();
        $tmagen = DB::table('tempat_agen')
            ->join('kota', 'kota.id', '=', 'tempat_agen.kota_id')
            ->select('tempat_agen.id', 'tempat_agen.kota_id','kota.nama_kota', 'tempat_agen.tempat_agen')
            ->get();
        return response()->json([
            'data' => $tmagen,
            'kota' => $kota
        ]);
    }

    public function tambah_tempat_agen(Request $request)
    {
        $validated = $request->validate([
            'kota_id' => 'required',
            'tempat_agen' => 'required',
        ]);

        // simpan data ke database
        $data = new TempatAgen();
        $data->kota_id = $validated['kota_id'];
        $data->tempat_agen = $validated['tempat_agen'];
        $data->save();

        // kirim response
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil ditambah'
        ]);
    }

    public function update_tempat_agen(Request $request, $id)
    {
        $tmagen = TempatAgen::findOrFail($id);
        $tmagen->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'kota berhasil diupdate',
            'data' => $tmagen, 200
        ]);
    }

    public function delete_tempat_agen($id)
    {
        $tmagen = TempatAgen::findOrFail($id);
        $tmagen->delete();
        return response()->json(null, 204);
    }

    public function pemesanan()
    {
        $pemesanan = Pemesanan::all();
        return response()->json([
            'status' => true,
            'data' => $pemesanan
        ], Response::HTTP_OK);
    }
    public function tambah_pemesanan(Request $request)
    {
        $validated = $request->validate([
            'id_persediaan_tiket' => 'required',
            'nama_pemesan' => 'required',
            'email' => 'required',
            'no_hp' => 'required',

        ]);
        $cekStock = DB::table('persediaan_tiket')->where('id', $request->id_persediaan_tiket)->first();
        if ($cekStock->kuota == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket Josong',
            ], Response::HTTP_OK);
        } else {


            $pemesanan = DB::table('pemesanan')->insert([
                'id_persediaan_tiket' => $request->id_persediaan_tiket,
                'id_user' => $request->id_user,
                'nama_pemesan' => $request->nama_pemesan,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'status' => $request->status,
                'order_id' => $request->order_id,
                'redirect_url' => $request->redirect_url
            ]);


            $datapersediaan = [
                'kuota' => $cekStock->kuota - 1
            ];

            $updateStock = DB::table('persediaan_tiket')->where('id', $request->id_persediaan_tiket)->update($datapersediaan);

            return response()->json([
                'success' => true,
                'message' => 'Tiket berhasil dipesan',
                'data' => $pemesanan
            ], Response::HTTP_OK);
        }
    }
    public function cek_persediaan(Request $request)
    {
        $asal = $request->input('asal');
        $tujuan = $request->input('tujuan');
        $tgl_keberangkatan = date('Y-m-d', strtotime($request->input('tgl_keberangkatan')));

        $persediaan_tiket = DB::table('persediaan_tiket')
            ->join('tempat_agen AS t', 't.id', '=', 'persediaan_tiket.asal')
            ->join('tempat_agen', 'tempat_agen.id', '=', 'persediaan_tiket.tujuan')
            ->join('shuttle','shuttle.id','=','persediaan_tiket.id_shuttle')
            ->select('persediaan_tiket.id', 'persediaan_tiket.tgl_keberangkatan', 'persediaan_tiket.kuota', 'persediaan_tiket.estimasi_perjalanan', 'persediaan_tiket.harga', 't.tempat_agen AS asal', 'tempat_agen.tempat_agen AS tujuan','shuttle.jenis_mobil','shuttle.kapasitas','shuttle.fasilitas')
            ->where('asal', $asal)
            ->where('tujuan', $tujuan)
            ->where('tgl_keberangkatan', 'like', '%' . $tgl_keberangkatan . '%')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $persediaan_tiket
        ], Response::HTTP_OK);
    }
    public function get_persediaan($id)
    {
         $persediaan_tiket = DB::table('persediaan_tiket')
            ->join('tempat_agen AS t', 't.id', '=', 'persediaan_tiket.asal')
            ->join('tempat_agen', 'tempat_agen.id', '=', 'persediaan_tiket.tujuan')
            ->join('shuttle','shuttle.id','=','persediaan_tiket.id_shuttle')
            ->where('persediaan_tiket.id', '=', $id)
            ->select('persediaan_tiket.id', 'persediaan_tiket.tgl_keberangkatan', 'persediaan_tiket.tgl_keberangkatan', 'persediaan_tiket.kuota', 'persediaan_tiket.id_shuttle','persediaan_tiket.estimasi_perjalanan', 'persediaan_tiket.harga', 't.tempat_agen AS asal', 'tempat_agen.tempat_agen AS tujuan', 'shuttle.jenis_mobil','shuttle.kapasitas','shuttle.fasilitas')
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $persediaan_tiket
        ]);
    }
    public function get_shuttle($id)
    {
         $shuttle = DB::table('shuttle')->where('shuttle.id','=', $id)
            ->select('shuttle.id','shuttle.jenis_mobil','shuttle.kapasitas','shuttle.fasilitas')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $shuttle
        ]);
    }
    public function get_role($id)
    {
        $role = DB::table('roles')->where('roles.id', '=', $id)
            ->select('roles.id', 'roles.roles')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $role
        ]);
    }
    public function get_kota($id)
    {
        $kota = DB::table('kota')->where('kota.id', '=', $id)
            ->select('kota.id', 'kota.nama_kota')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $kota
        ]);
    }
    public function get_tempat_agen($id)
    {
        $kota = DB::table('tempat_agen')
            ->join('kota', 'kota.id', '=', 'tempat_agen.kota_id' )
            ->where('tempat_agen.id', '=', $id)
            ->select('tempat_agen.kota_id', 'kota.nama_kota', 'tempat_agen.tempat_agen')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $kota
        ]);
    }
    public function riwayat_tiket(Request $request)
    {
        $email = $request->input('email');
        $id_user = $request->input('id_user');
        $and = "";
        $andemail = "";
        if (isset($id_user)) {
            $and = "and p.id_user = '$id_user'";
        }
        // if(isset($email)){
        // $andemail = "and p.email like ('%$email%')";
        // }


        $riwayat_tiket = DB::select("SELECT p.*, pt.tgl_keberangkatan, pt.kuota, pt.estimasi_perjalanan, pt.harga, ta.tempat_agen as asal, tt.tempat_agen as tujuan FROM pemesanan p 
        LEFT JOIN persediaan_tiket pt on p.id_persediaan_tiket=pt.id
        LEFT JOIN tempat_agen ta on pt.asal=ta.id
        LEFT JOIN tempat_agen tt on pt.tujuan=tt.id
        WHERE 1=1 $andemail  $and");


        return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $riwayat_tiket
        ], Response::HTTP_OK);
    }
    public function profile(Request $request)
    {
        $email = $request->input('email');

        $profile = DB::table('users')
            ->where('email', $email)
            ->first();

        return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $profile
        ], Response::HTTP_OK);
    }
    public function cek_transaksi(Request $request)
    {
        $id_user = $request->input('id_user');

        $status_transaksi = DB::table('pemesanan')
            ->select('order_id')
            ->where('id_user', $id_user)
            ->where('status', 'belum bayar')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data tersedia',
            'data' => $status_transaksi
        ], Response::HTTP_OK);
    }
      public function cetak_tiket(Request $request)
    {
        $order_id = $request->input('order_id');

        $cetakTiket = DB::select("select p.*,ta.tempat_agen as asal, tt.tempat_agen as tujuan from pemesanan p 
left join persediaan_tiket pt on p.id_persediaan_tiket=pt.id 
left join tempat_agen ta on pt.asal=ta.id
left join tempat_agen tt on pt.tujuan=tt.id
where p.order_id = '$order_id'");
        if ($cetakTiket != false) {
            return response()->json([
                'success' => true,
                'message' => 'Data tersedia',
                'data' => [$cetakTiket[0]],
                'data1' => $cetakTiket[0]
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak tersedia',
                'data' => [$cetakTiket[0]],
                'data1' => $cetakTiket[0]
            ], Response::HTTP_OK);
        }
    }
    public function updateTransaksi(Request $request)
    {
        $order_id = $request->input('order_id');
        $save = [
            'status' => 'lunas'
        ];

        $updateTransaksi = DB::table('pemesanan')
            ->where('order_id', $order_id)
            ->update($save);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate',
            'data' => $updateTransaksi
        ], Response::HTTP_OK);
    }
    public function tracking()
    {
        $tracking = DB::select("SELECT users.nama, asal_kota.nama_kota, tujuan_kota.nama_kota as tujuan, tracking.longitude, tracking.latitude, tracking.nama_lokasi, tracking.tgl, tracking.jam 
                                    FROM tracking 
                                    LEFT JOIN users 
                                    ON tracking.id_supir = users.id
                                    LEFT JOIN persediaan_tiket
                                    ON tracking.id_persediaan_tiket = persediaan_tiket.id
                                    LEFT JOIN kota AS asal_kota
                                    ON persediaan_tiket.asal = asal_kota.id
                                    LEFT JOIN kota AS tujuan_kota
                                    ON persediaan_tiket.tujuan = tujuan_kota.id
                                    WHERE users.role_id = 3");

                if ($tracking != false) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Data tersedia',
                        'data' => $tracking
                    ], Response::HTTP_OK);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data tidak tersedia',
                        'data' => $tracking
                    ], Response::HTTP_OK);
                }
    }
    
   
    public function tambah_tracking(Request $request)
    {
        $validated = $request->validate([
            'id_supir' => 'required',
            'id_persediaan_tiket' => 'required',
            'lat_long' => 'required',
            'nama_lokasi' => 'required',
            'tgl' => 'required',
            'jam' => 'required',
        ]);

        // simpan data ke database
        $tracking = DB::table('tracking')->insert([
            'id_supir' => $request->id_supir,
            'id_persediaan_tiket' => $request->id_persediaan_tiket,
            'lat_long' => $request->lat_long,
            'nama_lokasi' => $request->nama_lokasi,
            'tgl' => $request->tgl,
            'jam' => $request->jam,
        ]);

        // kirim response
        return response()->json([
            'success' => true,
            'message' => 'Tracking berhasil ditambahkan',
            'data' => $tracking
        ], Response::HTTP_OK);
    }
    public function tracking_by_id_supir(Request $request)
    {
        
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
                                    WHERE users.role_id = 3
                                    AND users.id = '$request->id'");

                if ($tracking != false) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Data tersedia',
                        'data' => $tracking
                    ], Response::HTTP_OK);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data tidak tersedia',
                        'data' => $tracking
                    ], Response::HTTP_OK);
                }
    }

    public function tampilkanSeat()
    {

         // Mengambil semua jenis mobil
        $jenis_mobil = Shuttle::pluck('jenis_mobil')->all();

        // Membuat array kosong untuk menyimpan kapasitas kursi berdasarkan jenis mobil
        $kapasitasByJenisMobil = [];

        // Loop melalui setiap jenis mobil
        foreach ($jenis_mobil as $jenis) {
            // Mengambil kapasitas kursi untuk jenis mobil tertentu
            $kapasitas = Shuttle::where('jenis_mobil', $jenis)->value('kapasitas');

            // Menyimpan kapasitas kursi dalam array berdasarkan jenis mobil
            $kapasitasByJenisMobil[$jenis] = $kapasitas;
        }

        return response()->json(['kapasitas_by_jenis_mobil' => $kapasitasByJenisMobil]);

    }

    public function getKapasitasKursiByJenisMobil($mobil)
    {
        // Mengambil kapasitas kursi tersedia untuk jenis mobil tertentu
        $kapasitasTersedia = Shuttle::where('jenis_mobil', $mobil)
                                    ->pluck('kapasitas')
                                    ->first();

        // Membuat array kosong untuk menyimpan nomor kursi
        $nomorKursi = [];

        // Menambahkan nomor kursi sesuai dengan kapasitas yang tersedia
        for ($i = 1; $i <= $kapasitasTersedia; $i++) {
            $nomorKursi[] = $i;
        }

        return response()->json(['nomor_kursi_tersedia' => $nomorKursi]);
    }
        
     public function pilihSeat(Request $request)
    {
        $nomer_seat = $request->input('no_kursi');
        $jenis_mobil = $request->input('jenis_mobil');
    
        // Cek apakah kursi sudah dipesan sebelumnya untuk jenis mobil tertentu
        $getSeat = Kursi::where('no_kursi', $nomer_seat)->where('jenis_mobil', $jenis_mobil)->first();
        if ($getSeat) {
            return response()->json(['message' => 'Kursi sudah dipesan'], 400);
        }
    
        // Cek apakah semua kursi sudah dipesan untuk jenis mobil tertentu
        $kapasitas = Shuttle::where('jenis_mobil', $jenis_mobil)->value('kapasitas');
        if (!$kapasitas) {
            return response()->json(['message' => 'Jenis mobil tidak ditemukan'], 404);
        }
    
        $bookedSeatsCount = Kursi::where('no_kursi', $nomer_seat)->count();
        if ($bookedSeatsCount >= $kapasitas) {
            return response()->json(['message' => 'Tidak ada kursi yang tersedia untuk nomor kursi ini'], 400);
        }

        try {
            DB::beginTransaction();

            // Tambahkan kursi baru
            $seat = new Kursi();
            $seat->no_kursi = $nomer_seat;
            $seat->jenis_mobil = $jenis_mobil;
            $seat->save();

            // Tandai kursi sebagai terpesan
            // $pemesanan = new Pemesanan();
            // $pemesanan->no_kursi = $seat->id;
            // $pemesanan->save();

            // Mengurangi kapasitas kursi
            Shuttle::where('jenis_mobil', $jenis_mobil)->decrement('kapasitas');

            DB::commit();

            return response()->json(['message' => 'Kursi berhasil dipilih'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan dalam memilih kursi'], 500);
        }

    }

   

    

    // public function get_ketersediaan_seat()
    // {

    //     $seats = DB::table('kursi')
    //         ->whereNotExists(function ($query) {
    //             $query->select(DB::raw(1))
    //                 ->from('pemesanan')
    //                 ->whereRaw('pemesanan.id_persediaan_tiket = kursi.no_kursi');
    //         })
    //         ->get();
        

    //     return response()
    //         ->json([
    //             'seats' => $seats
    //         ], 200);
    // }


}