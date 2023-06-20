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

    public function index()
    {
        $role = Auth::user()->role;
        $data = $this->$role();
        return view($role,compact('data'));
    }

    public function ahli_gizi()
    {
        $data = [];
        $data['ahli_gizi'] = DB::table('ahli_gizi')->count();
        $data['bidan'] = DB::table('bidan')->count();
        $data['kapus'] = DB::table('kapus')->count();
        $data['balita'] = DB::table('balita')->count();
        $data['pos'] = DB::table('posyandu')->count();
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
