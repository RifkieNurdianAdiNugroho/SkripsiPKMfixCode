<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class JadwalPosController extends Controller
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
                ->where('pj.jenis','posyandu')
                ->select('pj.*','pos.nama_pos as posyandu_name','bd.nama as bidan_name')
                ->orderBy('pj.tanggal','DESC')
                ->get();
        return view('dashboard.posyandu.jadwal.pos.index',compact('data'));
    }

     public function create()
    {
        $bidan = DB::table('bidan')->get();
        $posyandu = DB::table('posyandu')->get();
        return view('dashboard.posyandu.jadwal.pos.add',compact('bidan','posyandu'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $check = DB::table('posyandu_jadwal')->where('posyandu_id',$request->posyandu_id)->where('jenis','posyandu')->get();
        $valid = true;
        $bulan = Carbon::parse($request->tanggal)->format('m');
        $tahun = Carbon::parse($request->tanggal)->format('Y');
        if(!$check->isEmpty())
        {
            foreach ($check as $key => $value) 
            {
                $bulanCheck = Carbon::parse($value->tanggal)->format('m');
                $tahunCheck = Carbon::parse($value->tanggal)->format('Y');
                if($bulanCheck == $bulan && $tahunCheck == $tahun)
                {
                    $valid = false;
                    break;
                }
            }
        }

        if(!$valid)
        {
            return redirect()->back()->with('error','Mohon maaf data jadwal pos pada bulan '.$bulan.' Tahun '.$tahun.' Sudah di atur silahkan atur jadwal dengan bulan dan tahun yang lain');
        }
        DB::table('posyandu_jadwal')->insert([
            'posyandu_id'=>$request->posyandu_id,
            'bidan_id'=>$request->bidan_id,
            'jenis'=>'posyandu',
            'tanggal'=>$request->tanggal,
            'created_at'=>$createdAt
        ]);
        return redirect('data/jadwal/posyandu')->with('success','Berhasil menambahakan data Jadwal Posyandu');
    }

    public function edit($id)
    {
       $data = DB::table('posyandu_jadwal as pj')
                ->join('posyandu as pos','pos.id','=','pj.posyandu_id')
                ->join('bidan as bd','bd.id','=','pj.bidan_id')
                ->where('pj.jenis','posyandu')
                ->where('pj.id',$id)
                ->select('pj.*','pos.nama_pos as posyandu_name','bd.nama as bidan_name')
                ->first();
        if(!$data)
        {
            return redirect('data/jadwal/posyandu')->with('error','Tidak dapat menemukan data Pos');
        }
        $bidan = DB::table('bidan')->get();
        $posyandu = DB::table('posyandu')->get();
        return view('dashboard.posyandu.jadwal.pos.edit',compact('data','bidan','posyandu'));
    }
    public function update(Request $request,$id)
    {

        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $check = DB::table('posyandu_jadwal')->where('posyandu_id',$request->posyandu_id)->where('jenis','posyandu')->get();
        $valid = true;
        $bulan = Carbon::parse($request->tanggal)->format('m');
        $tahun = Carbon::parse($request->tanggal)->format('Y');
        if(!$check->isEmpty())
        {
            foreach ($check as $key => $value) 
            {
                $bulanCheck = Carbon::parse($value->tanggal)->format('m');
                $tahunCheck = Carbon::parse($value->tanggal)->format('Y');
                if($bulanCheck == $bulan && $tahunCheck == $tahun)
                {
                    if($value->id != $id)
                    {
                        $valid = false;
                        break;
                    }
                }
            }
        }

        if(!$valid)
        {
            return redirect()->back()->with('error','Mohon maaf data jadwal pos pada bulan '.$bulan.' Tahun '.$tahun.' Sudah di atur silahkan atur jadwal dengan bulan dan tahun yang lain');
        }
        DB::table('posyandu_jadwal')->where('id',$id)->update([
            'posyandu_id'=>$request->posyandu_id,
            'bidan_id'=>$request->bidan_id,
            'jenis'=>'posyandu',
            'tanggal'=>$request->tanggal,
            'updated_at'=>$createdAt
        ]);
        return redirect('data/jadwal/posyandu')->with('success','Berhasil mengubah data Jadwal Posyandu');
    }

    public function delete($id)
    {
        $data = DB::table('posyandu_jadwal')->where('id',$id)->first();
        if($data)
        {
            DB::table('posyandu_jadwal')->where('id',$id)->delete();
            return redirect('data/jadwal/posyandu')->with('success','Berhasil menghapus data Jadwal Posyandu');
        }else{
            return redirect('ddata/jadwal/posyandu')->with('error','Tidak dapat menemukan data Jadwal Posyandu');
        }
    }
}
