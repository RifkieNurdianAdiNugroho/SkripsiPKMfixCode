<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataKaderExport;
class KaderController extends Controller
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
            $kader = DB::table('kader as kd');
            $kader->join('posyandu as pos','pos.id','=','kd.posyandu_id');
            if($request->pos_id != null)
            {
                $kader->where('kd.posyandu_id',$request->pos_id);
            }
            if($request->kader != null)
            {
                $kader->where('kd.nama', 'like', '%' . $request->kader . '%');
            }
            $kader->select('kd.*','pos.nama_pos');
            $data = $kader->get();
        }
        
        $posyandu = [];
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
        Session::put('dataKader',$data);
        return view('dashboard.kader.index',compact('data','request','bidan','posyandu'));
    }

    public function exportExcel()
    {
        return Excel::download(new DataKaderExport, 'data_kader.xlsx');
    }

    public function create()
    {
            $userId = Auth::user()->id;
            $bidanAuth = DB::table('bidan')->where('user_id',$userId)->first();
            $pos = DB::table('posyandu as pd')
                    ->join('posyandu_bidan as pb','pb.posyandu_id','=','pd.id')
                    ->where('pb.bidan_id',$bidanAuth->id)
                    ->select('pd.*')
                    ->groupBy('pd.id')
                    ->get();

        return view('dashboard.kader.add',compact('pos'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('kader')->insert([
            'nama'=>$request->nama,
            'no_tlp'=>$request->no_tlp,
            'posyandu_id'=>$request->posyandu_id,
            'alamat'=>$request->alamat,
            'created_at'=>$createdAt
        ]);
        return redirect('data/kader')->with('success','Berhasil menambahakan data Kader');
    }

    public function edit($id)
    {
        $data = DB::table('kader as bd')
                ->where('bd.id',$id)
                ->first();
        if(!$data)
        {
            return redirect('data/kader')->with('error','Tidak dapat menemukan data Kader');
        }
         $userId = Auth::user()->id;
            $bidanAuth = DB::table('bidan')->where('user_id',$userId)->first();
            $pos = DB::table('posyandu as pd')
                    ->join('posyandu_bidan as pb','pb.posyandu_id','=','pd.id')
                    ->where('pb.bidan_id',$bidanAuth->id)
                    ->select('pd.*')
                    ->groupBy('pd.id')
                    ->get();
        return view('dashboard.kader.edit',compact('data','pos'));
    }

    public function update(Request $request,$id)
    {

       $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

            DB::table('kader')->where('id',$id)->update([
                'nama'=>$request->nama,
                'no_tlp'=>$request->no_tlp,
                'alamat'=>$request->alamat,
                'posyandu_id'=>$request->posyandu_id,
                'updated_at'=>$createdAt,
            ]);

        return redirect('data/kader')->with('success','Berhasil mengubah data Kader');
    }

    public function delete($id)
    {
        $data = DB::table('kader')->where('id',$id)->first();
        if($data)
        {
            DB::table('kader')->where('id',$id)->delete();
            return redirect('data/kader')->with('success','Berhasil menghapus data Kader');
        }else{
            return redirect('data/kader')->with('error','Tidak dapat menemukan data Kader');
        }
    }
}
