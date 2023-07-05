<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $role = Auth::user()->role;
        $data = $this->$role($request);
        //dd($data);
        return view($role,compact('data','request'));
    }

    public function ahli_gizi($request)
    {
        $data = [];
        $data['ahli_gizi'] = DB::table('ahli_gizi')->count();
        $data['bidan'] = DB::table('bidan')->count();
        $data['kapus'] = DB::table('kapus')->count();
        $data['balita'] = DB::table('balita')->count();
        $data['pos'] = DB::table('posyandu')->count();
        $data['dataBidan'] = DB::table('bidan')->get();
        $data['dataFilterBalita'] = 'Keseluruhan';
        $data['balita_l'] = DB::table('balita')->where('jenis_kelamin','L')->count();
        $data['balita_p'] = DB::table('balita')->where('jenis_kelamin','P')->count();

        $data['gizi_buruk'] = DB::table('posyandu_hasil')->where('status_gizi','gizi_buruk')->count();
        $data['gizi_kurang'] = DB::table('posyandu_hasil')->where('status_gizi','gizi_kurang')->count();
        $data['gizi_sedang'] = DB::table('posyandu_hasil')->where('status_gizi','gizi_sedang')->count();
        $data['gizi_baik'] = DB::table('posyandu_hasil')->where('status_gizi','gizi_baik')->count();
        $data['gizi_lebih'] = DB::table('posyandu_hasil')->where('status_gizi','gizi_lebih')->count();

        $data['posyandu'] = [];
        
        $balitaArr = [];
        if($request->pos_id != null && $request->bidan_id != null)
        {
                $hasilPos = DB::table('posyandu_bidan as pb')
                            ->join('posyandu_balita_bidan as pbb','pbb.posyandu_bidan_id','=','pb.id')
                            ->where('pb.posyandu_id',$request->pos_id)
                            ->where('pb.bidan_id',$request->bidan_id)
                            ->select('pbb.balita_id')
                            ->get();
            foreach ($hasilPos as $key => $value) 
            {
                array_push($balitaArr, $value->balita_id);
            }
            $balitaArr = array_unique($balitaArr);
            $data['balita_l'] = DB::table('balita')->where('jenis_kelamin','L')->whereIn('id',$balitaArr)->count();
            $data['balita_p'] = DB::table('balita')->where('jenis_kelamin','P')->whereIn('id',$balitaArr)->count();
            $pos = DB::table('posyandu')->where('id',$request->pos_id)->first();
            $data['dataFilterBalita'] = 'Pos '.$pos->nama_pos;
        }

        if($request->bidan_id != null)
        {
                $posyandu = DB::table('posyandu as pd')
                            ->join('posyandu_bidan as pb','pb.posyandu_id','=','pd.id')
                            ->where('pb.bidan_id',$request->bidan_id)
                            ->select('pd.id','pd.nama_pos')
                            ->groupBy('pb.posyandu_id')
                            ->get();
            $data['posyandu'] = $posyandu;
        }
       
        return $data;
    }

    public function kapus()
    {
        $data = [];
        $data['ahli_gizi'] = DB::table('ahli_gizi')->count();
        $data['bidan'] = DB::table('bidan')->count();
        $data['kapus'] = DB::table('kapus')->count();
        $data['balita'] = DB::table('balita')->count();
        $data['pos'] = DB::table('posyandu')->count();
        return $data;
    }

     public function bidan()
    {
        $data = [];
        $bidan = DB::table('bidan')->where('user_id',Auth::user()->id)->first();
        $data['balita'] = DB::table('posyandu_bidan as pb')
                          ->join('posyandu_balita_bidan as pbb','pbb.posyandu_bidan_id','=','pb.id')
                          ->where('pb.bidan_id',$bidan->id)
                          ->where('pb.status',1)
                          //->groupBy('pbb.balita_id')
                          ->count();
        $data['jadwal_vitamin'] = DB::table('posyandu_jadwal')->where('bidan_id',$bidan->id)->where('jenis','vitamin')->count();
        $data['jadwal_pos'] = DB::table('posyandu_jadwal')->where('bidan_id',$bidan->id)->where('jenis','posyandu')->count();
        $data['pos'] = DB::table('posyandu_bidan')->where('bidan_id',$bidan->id)->count();
        return $data;
    }
}