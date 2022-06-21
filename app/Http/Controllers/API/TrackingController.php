<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tracking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    //
    public function tracking(Request $request)
    {

        $req = $request->all();

        // $req['waktu_tracking'] = Carbon::now();



        $track = Tracking::updateOrCreate([
            //Add unique field combo to match here
            //For example, perhaps you only want one entry per user:
            'user_id'   => $request->user_id,
            'angkutan_id'   => $request->angkutan_id,
        ], [
            'latitude_tracking_awal'     => $request->latitude_tracking_awal,
            'latitude_tracking_akhir'     => $request->latitude_tracking_akhir,
            'longitude_tracking_akhir'     => $request->longitude_tracking_akhir,
            'longitude_tracking_awal'     => $request->longitude_tracking_awal,
            'waktu_tracking' => Carbon::now()


        ]);

        if ($track) {
            // $tracking =  Tracking::create($req);
            return response()->json([

                'pesan' => 'sukses',
                'data' => [$track]
            ]);
        } else {
            return response()->json([
                'pesan' => 'gagal',
                'data' => []
            ]);
        }


        // $tracking = DB::table('trackings')
        // ->leftJoin('angkutans','trackings.angkutan_id','angkutans.id')
        // ->leftJoin('users','angkutans.user_id','users.id')
        // ->select('users.*','trackings.*')
        // ->where('trackings.user_id',$request->id)
        // ->first();
        // if($tracking->latitude_tracking=!null){

        //     $tracking->update([
        //         'latitude'=>$request->latitude,
        //         'longitude'=>$request->longitude,
        //         'waktu_tracking'=>Carbon::now(),
        //     ]);

        //     return response()->json([
        //         'pesan' => 'sukses',
        //         'track' => $tracking
        //     ]);
        // }else{
        //     return response()->json([
        //         'pesan' => 'gagal',
        //         'track' => []
        //     ]);
        // }



    }
    public function stop_tracking(Request $request)
    {

        // $req= $request->all();

        // Tracking::create($req);
        // $tracking = DB::table('trackings')
        // ->leftJoin('angkutans','trackings.angkutan_id','angkutans.id')
        // ->leftJoin('users','angkutans.user_id','users.id')
        // ->select('users.*','trackings.*')
        // ->where('trackings.user_id',$request->id)
        // ->first();
        // if($tracking->latitude_tracking=!null){

        //     $tracking->update([
        //         'latitude'=>$request->latitude,
        //         'longitude'=>$request->longitude,
        //         'waktu_tracking'=>Carbon::now(),
        //     ]);

        //     return response()->json([
        //         'pesan' => 'sukses',
        //         'track' => $tracking
        //     ]);
        // }else{
        //     return response()->json([
        //         'pesan' => 'gagal',
        //         'track' => []
        //     ]);
        // }

    }
    
    public function get_tracking(Request $request){

        $tracking = DB::table('trackings')
        ->leftJoin('users','trackings.user_id','users.id')
        ->select('users.*','trackings.*')
        ->where('users.id',$request->supir)
        ->get();

        if($tracking){
            return response()->json([
                'pesan'=>'sukses',
                'tracking'=>$tracking
            ]);
       
        }else{
            return response()->json([
                'pesan'=>'gagal',
                'tracking'=>[]
            ]);


        }

        return $tracking;

     
    }
    public function getsupir(){
        // $supir=User::where('profesi','supir')->get();
        $supir=DB::table('angkutans')
        ->leftJoin('users','angkutans.user_id','users.id')
        ->select('angkutans.*','users.*')->get();
        return view('live-track',compact('supir'));
    }
}
