<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Angkutan;
use App\Models\Pendataan;
use App\Models\Penumpang;
use App\Models\Trayek;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendataanPenumpangController extends Controller
{
    //
    public function get_angkutan()
    {
        $angkutan = DB::table('angkutans')
            ->leftJoin('users', 'angkutans.user_id', 'users.id')
            ->select('users.nama', 'users.id as id_user', 'angkutans.id as id_angkutan', 'angkutans.nama_angkutan')->get();

        if ($angkutan) {
            return response()->json([
                'pesan' => 'sukses',
                'angkutan' => $angkutan
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal',
                'angkutan' => []
            ]);
        }
    }
   
    public function filter_penumpang(Request $request)
    {

        $p = Penumpang::where('nama', 'LIKE', '%' . $request->nama . '%')->where('tgl_lahir', 'LIKE', '%' . $request->tgl_lahir . '%')->get();
        if ($p) {

            return response()->json([
                'pesan' => 'sukses',
                'data' =>$p
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal',
                'data' => []
            ]);
        }
    }



    public function riwayat_penumpang()
    {
        $pendataan = DB::table('pendataans')
            ->leftJoin('penumpangs', 'pendataans.penumpang_id', 'penumpangs.id')
            ->leftJoin('angkutans','pendataans.angkutan_id','angkutans.id')
            ->leftJoin('users','angkutans.user_id', 'users.id')
            ->select('penumpangs.*','angkutans.nama_angkutan', 'users.nama as nama_supir','pendataans.*')
            ->orderBy('pendataans.id', 'DESC')
            ->get();
        if ($pendataan) {
            return response()->json([
                'pesan' => 'sukses',
                'data' => $pendataan
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal',
                'data' => []
            ]);
        }
    }
    public function absen_penumpang(Request $request)
    {
        $p =  Penumpang::where('id', $request->id)->first();


        if ($p) {



            $pendataan = new Pendataan();
            $pendataan->waktu_pendataan = Carbon::now();
            $pendataan->penumpang_id = $p->id;
            $pendataan->angkutan_id = $request->angkutan_id;
            $pendataan->type_absen = 'Absen Penumpang';
            $pendataan->save();

            return response()->json([
                'pesan' => 'sukses',
                'data' => [$p]
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal',
                'data' => []
            ]);
        }
    }
    public function scan_qr_penumpang(Request $request)
    {
        $p =  Penumpang::where('qrcode', $request->qrcode_penumpang)->first();

        if ($p) {

            $pendataan = new Pendataan();
            $pendataan->waktu_pendataan = Carbon::now();
            $pendataan->penumpang_id = $p->id;
            $pendataan->angkutan_id = $request->angkutan_id;
            $pendataan->type_absen = 'Scan QR';
            $pendataan->save();

            return response()->json([
                'pesan' => 'sukses',
                'data' => [$p]
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal',
                'data' => []
            ]);
        }
    }
}
