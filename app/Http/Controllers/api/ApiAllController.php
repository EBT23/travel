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
    // RUTE
    public function rute()
    {
        $rute = DB::table('rute')->get();
        
        return response()->json([
            'data' => $rute,
        ]);
    }
    public function jadwal_keberangkatan(Request $request)  {
        $rute = $request->input('id_rute');
        $tgl_keberangkatan = date('Y-m-d', strtotime($request->input('tgl_keberangkatan')));
        $jadwal_keberangkatan = DB::select("SELECT jadwal_keberangkatan.id, jadwal_keberangkatan.tgl_keberangkatan, armada.jenis_mobil, rute.keberangkatan, rute.tujuan, users.nama, jadwal_keberangkatan.estimasi_perjalanan, jadwal_keberangkatan.harga, jadwal_keberangkatan.stok_tiket 
                                                FROM jadwal_keberangkatan, armada, rute, users 
                                                WHERE jadwal_keberangkatan.id_armada = armada.id 
                                                AND jadwal_keberangkatan.id_user = users.id 
                                                AND jadwal_keberangkatan.rute = rute.id 
                                                AND jadwal_keberangkatan.rute = $rute 
                                                AND jadwal_keberangkatan.tgl_keberangkatan LIKE '$tgl_keberangkatan%'");
         return response()->json([
            'success' => true,
            'message' => 'Jadwal Keberangkatan Tersedia',
            'data' => $jadwal_keberangkatan
        ], Response::HTTP_OK);
    }
    public function jadwal_keberangkatan_by_id($id)  {
        $jadwal_keberangkatan = DB::select("SELECT jadwal_keberangkatan.tgl_keberangkatan, armada.jenis_mobil, rute.keberangkatan, rute.tujuan, users.nama, jadwal_keberangkatan.estimasi_perjalanan, jadwal_keberangkatan.harga, jadwal_keberangkatan.stok_tiket
                                                FROM jadwal_keberangkatan, armada, rute, users
                                                WHERE jadwal_keberangkatan.id_armada = armada.id
                                                AND jadwal_keberangkatan.id_user = users.id
                                                AND jadwal_keberangkatan.rute = rute.id
                                                AND jadwal_keberangkatan.id = $id");
         return response()->json([
            'success' => true,
            'message' => 'Jadwal Keberangkatan Tersedia',
            'data' => $jadwal_keberangkatan
        ], Response::HTTP_OK);
    }
    public function input_pemesanan(Request $request)  {
        $validated = $request->validate([
            'id_jadwal' => 'required',
            // 'nama_pemesan' => 'required',
            // 'email' => 'required',
            // 'no_hp' => 'required',

        ]);

        $cekStock = DB::table('jadwal_keberangkatan')->where('id', $request->id_jadwal)->first();
        dd($cekStock);

    }
    public function tambah_pemesanan(Request $request)
    {
        $validated = $request->validate([
            'id_jadwal' => 'required',
            'nama_pemesan' => 'required',
            'email' => 'required',
            'no_hp' => 'required',

        ]);
        $cekStock = DB::table('persediaan_tiket')->where('id', $request->id_persediaan_tiket)->first();
        if ($cekStock->kuota == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket Kosong',
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
//         
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
        // // Mengambil kapasitas kursi tersedia untuk jenis mobil tertentu
        // $kapasitasTersedia = Shuttle::where('jenis_mobil', $mobil)
        //                             ->pluck('kapasitas')
        //                             ->first();

        // // Membuat array kosong untuk menyimpan nomor kursi
        // $nomorKursi = [];

        // // Menambahkan nomor kursi sesuai dengan kapasitas yang tersedia
        // for ($i = 1; $i <= $kapasitasTersedia; $i++) {
        //     $nomorKursi[] = $i;
        // }

        // return response()->json(['nomor_kursi_tersedia' => $nomorKursi]);
    }
        
     public function pilihSeat(Request $request)
    {
        // $nomer_seat = $request->input('no_kursi');
        // $jenis_mobil = $request->input('jenis_mobil');
    
        // // Cek apakah kursi sudah dipesan sebelumnya untuk jenis mobil tertentu
        // $getSeat = Kursi::where('no_kursi', $nomer_seat)->where('jenis_mobil', $jenis_mobil)->first();
        // if ($getSeat) {
        //     return response()->json(['message' => 'Kursi sudah dipesan'], 400);
        // }
    
        // // Cek apakah semua kursi sudah dipesan untuk jenis mobil tertentu
        // $kapasitas = Shuttle::where('jenis_mobil', $jenis_mobil)->value('kapasitas');
        // if (!$kapasitas) {
        //     return response()->json(['message' => 'Jenis mobil tidak ditemukan'], 404);
        // }
    
        // $bookedSeatsCount = Kursi::where('no_kursi', $nomer_seat)->count();
        // if ($bookedSeatsCount >= $kapasitas) {
        //     return response()->json(['message' => 'Tidak ada kursi yang tersedia untuk nomor kursi ini'], 400);
        // }

        // try {
        //     DB::beginTransaction();

        //     // Tambahkan kursi baru
        //     $seat = new Kursi();
        //     $seat->no_kursi = $nomer_seat;
        //     $seat->jenis_mobil = $jenis_mobil;
        //     $seat->save();

        //     Shuttle::where('jenis_mobil', $jenis_mobil)->decrement('kapasitas');

        //     DB::commit();

        //     return response()->json(['message' => 'Kursi berhasil dipilih'], 200);
        // } catch (Exception $e) {
        //     DB::rollBack();
        //     return response()->json(['message' => 'Terjadi kesalahan dalam memilih kursi'], 500);
        // }

    }


}
