<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class JadwalVitaminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('posyandu_jadwal as pj')
                ->join('posyandu as pos','pos.id','=','pj.posyandu_id')
                ->join('bidan as bd','bd.id','=','pj.bidan_id')
                ->where('pj.jenis','vitamin')
                ->select('pj.*','pos.nama_pos as posyandu_name','bd.nama as bidan_name')
                ->orderBy('pj.tanggal','DESC')
                ->get();
        return view('dashboard.posyandu.jadwal.vitamin.index',compact('data'));
    }

     public function create()
    {
        $bidan = DB::table('bidan')->get();
        $posyandu = DB::table('posyandu')->get();
        return view('dashboard.posyandu.jadwal.vitamin.add',compact('bidan','posyandu'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('posyandu_jadwal')->insert([
            'posyandu_id'=>$request->posyandu_id,
            'bidan_id'=>$request->bidan_id,
            'jenis'=>'vitamin',
            'vitamin'=>$request->vitamin,
            'tanggal'=>$request->tanggal,
            'created_at'=>$createdAt
        ]);
        return redirect('data/jadwal/vitamin')->with('success','Berhasil menambahakan data Jadwal Vitamin');
    }

    public function edit($id)
    {
       $data = DB::table('posyandu_jadwal as pj')
                ->join('posyandu as pos','pos.id','=','pj.posyandu_id')
                ->join('bidan as bd','bd.id','=','pj.bidan_id')
                ->where('pj.jenis','vitamin')
                ->where('pj.id',$id)
                ->select('pj.*','pos.nama_pos as posyandu_name','bd.nama as bidan_name')
                ->first();
        if(!$data)
        {
            return redirect('data/jadwal/vitamin')->with('error','Tidak dapat menemukan data Pos');
        }
        $bidan = DB::table('bidan')->get();
        $posyandu = DB::table('posyandu')->get();
        return view('dashboard.posyandu.jadwal.vitamin.edit',compact('data','bidan','posyandu'));
    }
    public function update(Request $request,$id)
    {

        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('posyandu_jadwal')->where('id',$id)->update([
            'posyandu_id'=>$request->posyandu_id,
            'bidan_id'=>$request->bidan_id,
            'jenis'=>'vitamin',
            'vitamin'=>$request->vitamin,
            'tanggal'=>$request->tanggal,
            'updated_at'=>$createdAt
        ]);
        return redirect('data/jadwal/vitamin')->with('success','Berhasil mengubah data Jadwal Vitamin');
    }

    public function delete($id)
    {
        $data = DB::table('posyandu_jadwal')->where('id',$id)->first();
        if($data)
        {
            DB::table('posyandu_jadwal')->where('id',$id)->delete();
            return redirect('data/jadwal/vitamin')->with('success','Berhasil menghapus data Jadwal Vitamin');
        }else{
            return redirect('ddata/jadwal/vitamin')->with('error','Tidak dapat menemukan data Jadwal Vitamin');
        }
    }
}
