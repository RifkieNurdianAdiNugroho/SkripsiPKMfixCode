<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataBalitaExport;
class BalitaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
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
        $data = [];
        $balitaArr = [];
        if(count($request->all()) > 0)
        {
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
            }

            $balitaArr = array_unique($balitaArr);
            //dd($balitaArr);
            $balita = DB::table('balita as bta');
            if($request->balita != null)
            {
                $balita->where('bta.nama', 'like', '%' . $request->balita . '%');
            }
            if($request->ortu != null)
            {
                $balita->where('bta.nama_ortu', 'like', '%' . $request->ortu . '%');
            }
            if($request->jenis_kelamin != null)
            {
                $balita->where('bta.jenis_kelamin',$request->jenis_kelamin);
            }
            $balita->whereIn('id',$balitaArr);
            $data = $balita->get();
            Session::put('dataBalita',$data);
        }else
        {
            Session::forget('dataBalita');
        }
        return view('dashboard.balita.index',compact('data','bidan','posyandu','request'));
    }

    public function exportExcel()
    {
        return Excel::download(new DataBalitaExport, 'data_balita.xlsx');
    }

    public function create()
    {
        if(Auth::user()->role == 'bidan')
        {
            $userId = Auth::user()->id;
            $bidan = DB::table('bidan')->where('user_id',$userId)->get();
            $bidanUser = DB::table('bidan')->where('user_id',$userId)->first();
            $posyandu = DB::table('posyandu_bidan as pb')
                        ->join('posyandu as pos','pos.id','=','pb.posyandu_id')
                        ->where('pb.bidan_id',$bidanUser->id)
                        ->select('pos.id','pos.nama_pos')
                        ->get();
        }else
        {
            $bidan = DB::table('bidan')->get();
            $posyandu = [];
        }
        return view('dashboard.balita.add',compact('bidan','posyandu'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $balitaId = DB::table('balita')->insertGetId([
                    'nama'=>$request->nama,
                    'nama_ortu'=>$request->nama_ortu,
                    'pjg_lahir'=>$request->pjg_lahir,
                    'bb_lahir'=>$request->bb_lahir,
                    'tgl_lahir'=>$request->tgl_lahir,
                    'alamat'=>$request->alamat,
                    'gakin'=>$request->gakin,
                    'anak_ke'=>$request->anak_ke,
                    'jenis_kelamin'=>$request->jenis_kelamin,
                    'created_at'=>$createdAt
                ]);
        $posBidan = DB::table('posyandu_bidan')->where('bidan_id',$request->bidan_id)->where('posyandu_id',$request->pos_id)->first();
        if($posBidan)
        {
            DB::table('posyandu_balita_bidan')->insert([
                'balita_id'=>$balitaId,
                'posyandu_bidan_id'=>$posBidan->id,
                'created_at'=>$createdAt
            ]);
        }
        return redirect('data/balita')->with('success','Berhasil menambahakan data Balita');
    }

    public function edit($id)
    {
        $data = DB::table('balita as bd')
                ->where('bd.id',$id)
                ->first();
        if(!$data)
        {
            return redirect('data/balita')->with('error','Tidak dapat menemukan data Balita');
        }
        $posBidanId = 0;
        $posBidanPosId = 0;
        if(Auth::user()->role == 'bidan')
        {
            $userId = Auth::user()->id;
            $bidan = DB::table('bidan')->where('user_id',$userId)->get();
            $bidanUser = DB::table('bidan')->where('user_id',$userId)->first();
            $posyandu = DB::table('posyandu_bidan as pb')
                    ->join('posyandu as pos','pos.id','=','pb.posyandu_id')
                    ->where('pb.bidan_id',$bidanUser->id)
                    ->select('pos.id','pos.nama_pos')
                    ->get();
            $posBidanId = $bidanUser->id;
            $posBidan = DB::table('posyandu_balita_bidan')->where('balita_id',$id)->first();
            if($posBidan)
            {
                $posNya = DB::table('posyandu_bidan')->where('id',$posBidan->posyandu_bidan_id)->first();
                if($posNya)
                {
                    $posBidanPosId = $posNya->posyandu_id;
                }
            }
        }else
        {
            $bidan = DB::table('bidan')->get();
            $posBidan = DB::table('posyandu_balita_bidan')->where('balita_id',$id)->first();
            $posyandu = [];
            if($posBidan)
            {
                
                $posyanduFisrt = DB::table('posyandu_bidan as pb')
                    ->where('pb.id',$posBidan->posyandu_bidan_id)
                    ->first();
                //dd($posyanduFisrt);
                if($posyanduFisrt)
                {
                    $posBidanId = $posyanduFisrt->bidan_id;
                    $posyandu = DB::table('posyandu_bidan as pb')
                    ->join('posyandu as pos','pos.id','=','pb.posyandu_id')
                    ->where('pb.bidan_id',$posBidanId)
                    ->select('pos.id','pos.nama_pos')
                    ->get();
                }
                $posNya = DB::table('posyandu_bidan')->where('id',$posBidan->posyandu_bidan_id)->first();
                if($posNya)
                {
                    $posBidanPosId = $posNya->posyandu_id;
                }
            }
        }
        return view('dashboard.balita.edit',compact('data','bidan','posyandu','posBidanId','posBidanPosId'));
    }

    public function update(Request $request,$id)
    {

       $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

            DB::table('balita')->where('id',$id)->update([
                'nama'=>$request->nama,
                'nama_ortu'=>$request->nama_ortu,
                'pjg_lahir'=>$request->pjg_lahir,
                'bb_lahir'=>$request->bb_lahir,
                'tgl_lahir'=>$request->tgl_lahir,
                'alamat'=>$request->alamat,
                'gakin'=>$request->gakin,
                'jenis_kelamin'=>$request->jenis_kelamin,
                'anak_ke'=>$request->anak_ke,
                'updated_at'=>$createdAt,
            ]);
        $posBidan = DB::table('posyandu_bidan')->where('bidan_id',$request->bidan_id)->where('posyandu_id',$request->pos_id)->first();
        //dd($posBidan);
        if($posBidan)
        {
            $check = DB::table('posyandu_balita_bidan')->where('posyandu_bidan_id',$posBidan->id)->where('balita_id',$id)->first();
            if(!$check)
            {
                DB::table('posyandu_balita_bidan')->where('balita_id',$id)->delete();
                DB::table('posyandu_balita_bidan')->insert([
                    'balita_id'=>$id,
                    'posyandu_bidan_id'=>$posBidan->id,
                    'created_at'=>$createdAt
                ]);
            }
        }
        return redirect('data/balita')->with('success','Berhasil mengubah data Balita');
    }

    public function delete($id)
    {
        $data = DB::table('balita')->where('id',$id)->first();
        if($data)
        {
            DB::table('balita')->where('id',$id)->delete();
            return redirect('data/balita')->with('success','Berhasil menghapus data Balita');
        }else{
            return redirect('data/balita')->with('error','Tidak dapat menemukan data Balita');
        }
    }
}
