<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
class DataTimbangController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $bidan = DB::table('bidan')->where('user_id',$userId)->first();
        $data = DB::table('posyandu_jadwal as pj')
                ->join('bidan as bd','bd.id','=','pj.bidan_id')
                ->join('posyandu as pd','pd.id','=','pj.posyandu_id')
                ->where('pj.bidan_id',$bidan->id)
                ->where('pj.jenis','posyandu')
                ->select('bd.nama as bidan_name','pj.tanggal','pj.jenis as jadwal_type','pd.nama_pos as posyandu_name')
                ->orderBy('pj.tanggal')
                ->get();
        $now = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        return view('dashboard.timbang.index',compact('data','now'));
    }

    public function create($id)
    {
        $userId = Auth::user()->id;
        $bidan = DB::table('bidan')->where('user_id',$userId)->first();
        $jadwal = DB::table('posyandu_jadwal')->where('id',$id)->get();
        $balita = DB::table('balita')->get();
        $hasil = DB::table('posyandu_hasil as ph')
                 ->join('balita as bt','bt.id','=','ph.balita_id')
                 ->where('ph.jadwal_id',$id)
                 ->select('bt.nama as balita_name','ph.*')
                 ->get();
        return view('dashboard.timbang.add',compact('jadwal','bidan','balita','hasil'));
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $bidan = DB::table('bidan')->where('user_id',$userId)->first();
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('posyandu_hasil')->insert([
            'bidan_id'=>$bidan->id,
            'jadwal_id'=>$request->jadwal_id,
            'balita_id'=>$request->balita_id,
            'umur'=>$request->umur,
            'tb'=>$request->tb,
            'bb'=>$request->bb,
            'created_at'=>$createdAt
        ]);


        return redirect()->back()->with('success','Berhasil menambahakan data Timbangan');
    }

    public function edit($id)
    {
        $data = DB::table('kader as bd')
                ->where('bd.id',$id)
                ->first();
        if(!$data)
        {
            return redirect('data/jadwal/timbang')->with('error','Tidak dapat menemukan data Timbangan');
        }
        return view('dashboard.timbang.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {

       $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

            DB::table('kader')->where('id',$id)->update([
                'nama'=>$request->nama,
                'no_tlp'=>$request->no_tlp,
                'alamat'=>$request->alamat,
                'updated_at'=>$createdAt,
            ]);

        return redirect('data/kader')->with('success','Berhasil mengubah data Timbangan');
    }

    public function delete($id)
    {
        $data = DB::table('kader')->where('id',$id)->first();
        if($data)
        {
            DB::table('kader')->where('id',$id)->delete();
            return redirect('data/kader')->with('success','Berhasil menghapus data Timbangan');
        }else{
            return redirect('data/kader')->with('error','Tidak dapat menemukan data Timbangan');
        }
    }
}
