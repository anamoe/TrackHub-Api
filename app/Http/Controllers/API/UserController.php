<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Angkutan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //

    public function getRandomString($panjang = 30)
    {
        $karakter = '0123456789abcdefghiklmnopqrstuvwxyz';
        $panjang_karakter = strlen($karakter);
        $randomString = '';
        for ($i = 0; $i < $panjang; $i++) {
            $randomString .= $karakter[rand(0, $panjang_karakter - 1)];
        }
        return $randomString;
    }
    public function login(Request $request)
    {
        $random = $this->getRandomString();

        $users = User::where('username', $request->nama)->first();

        // $angkutan = Angkutan::where('user_id',$user->id)->first();

        $user = DB::table('angkutans')
            ->leftjoin('users', 'angkutans.user_id', 'users.id')
            ->select('users.*', 'angkutans.id as angkutan_id',)
            ->where('users.username', $request->nama)
            ->first();
        // return $user;
        // return $angkutan->id;
        // $user->angkutan = $angkutan->id;

        if ($user) {
            if (password_verify($request->password, $user->password)) {
                $users->update([
                    'api-token' => $random
                ]);

                return response()->json([
                    'pesan' => 'sukses',
                    'user' => $user
                ]);
            }

            return response()->json([
                'pesan' => 'gagal, password anda salah',
                'message' => "Kata sandi salah",
            ]);
        }

        return response()->json([
            'pesan' => 'gagal.username tidak terdaftar',
            'message' => "Nama Pengguna tidak terdaftar",
        ]);
    }

    public function ubah_password(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            return response()->json([
                'pesan' => 'berhasil update password'
            ]);
        } else {

            return response()->json([
                'pesan' => 'gagal update password'
            ]);
        }
    }

    public function ubah_profil(Request $request)
    {
        $users =  User::where('id', $request->id)->first();



        if ($users) {
            $users->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'notelp' => $request->notelp,
                'username' => $request->username
            ]);
            $user = DB::table('angkutans')
                ->leftjoin('users', 'angkutans.user_id', 'users.id')
                ->select('users.*', 'angkutans.id as angkutan_id',)
                ->where('users.id', $users->id)
                ->first();
            return response()->json([
                'pesan' => 'sukses',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal update profil'
            ]);
        }
    }
}
