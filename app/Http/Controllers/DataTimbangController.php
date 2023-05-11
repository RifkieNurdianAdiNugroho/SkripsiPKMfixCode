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
        $data = DB::table('posyandu_hasil as ph')
                ->join('balita as bt','bt.id','=','ph.balita_id')
                ->join('posyandu_jadwal as pj','pj.id','=','ph.jadwal_id')
                ->where('pj.bidan_id',$bidan->id)
                ->select('ph.*','bt.nama','pj.tanggal','pj.type as jadwal_type')
                ->get();
        return view('dashboard.timbang.index',compact('data'));
    }

    public function create()
    {
        $userId = Auth::user()->id;
        $bidan = DB::table('bidan')->where('user_id',$userId)->first();
        $jadwal = DB::table('posyandu_jadwal')->where('bidan_id',$bidan->id)->get();
        $balita = DB::table('balita')->get();
        return view('dashboard.timbang.add',compact('jadwal','bidan','balita'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('kader')->insert([
            'nama'=>$request->nama,
            'no_tlp'=>$request->no_tlp,
            'alamat'=>$request->alamat,
            'created_at'=>$createdAt
        ]);
        return redirect('data/jadwal/timbang')->with('success','Berhasil menambahakan data Timbangan');
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
