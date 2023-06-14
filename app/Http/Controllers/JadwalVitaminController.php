<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
class JadwalVitaminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = [];
        if(count($request->all()) > 0)
        {
            $get = DB::table('posyandu_jadwal as pj');
            $get->join('posyandu as pos','pos.id','=','pj.posyandu_id');
            $get->join('bidan as bd','bd.id','=','pj.bidan_id');
            $get->where('pj.jenis','vitamin');
            if($request->bidan_id != null)
            {   
                $get->where('pj.bidan_id',$request->bidan_id);
            }
            if($request->pos_id != null)
            {   
                $get->where('pj.posyandu_id',$request->pos_id);
            }
            if($request->tanggal != null)
            {
                $start = explode('-', $request->tanggal);
                $get->whereMonth('pj.tanggal','=',$start[1]);
                $get->whereYear('pj.tanggal','=',$start[0]);
            }
            $get->select('pj.*','pos.nama_pos as posyandu_name','bd.nama as bidan_name');
            $get->orderBy('pj.tanggal','DESC');
            $data = $get->get();
        }
        if(Auth::user()->role == 'bidan')
        {
            $userId = Auth::user()->id;
            $bidanAuth = DB::table('bidan')->where('user_id',$userId)->first();
            $posyandu = DB::table('posyandu as pd')
                    ->join('posyandu_bidan as pb','pb.posyandu_id','=','pd.id')
                    ->where('pb.bidan_id',$bidanAuth->id)
                    ->select('pd.*')
                    ->groupBy('pd.id')
                    ->get();
            $bidan = DB::table('bidan')->where('user_id',$userId)->get();
        }else
        {
            $bidan = DB::table('bidan')->get();
            $posyandu = [];
            if($request->bidan_id != null)
            {
                $posyandu = DB::table('posyandu as pd')
                            ->join('posyandu_bidan as pb','pb.posyandu_id','=','pd.id')
                            ->where('pb.bidan_id',$request->bidan_id)
                            ->select('pd.id','pd.nama_pos')
                            ->groupBy('pb.posyandu_id')
                            ->get();
            }
        }
        return view('dashboard.posyandu.jadwal.vitamin.index',compact('data','request','bidan','posyandu'));
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
