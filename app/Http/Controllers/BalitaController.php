<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
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
            if($request->pos_id != null)
            {
                $hasilPos = DB::table('posyandu_hasil as ph')
                            ->join('posyandu_jadwal as pj','ph.jadwal_id','=','pj.id')
                            ->where('pj.posyandu_id',$request->pos_id)
                            ->select('ph.balita_id')
                            ->groupBy('ph.balita_id')
                            ->get();
                foreach ($hasilPos as $key => $value) 
                {
                    array_push($balitaArr, $value->balita_id);
                }
            }
            if($request->bidan_id != null)
            {
                $hasilPos = DB::table('posyandu_hasil as ph')
                            ->join('posyandu_jadwal as pj','ph.jadwal_id','=','pj.id')
                            ->where('ph.bidan_id',$request->bidan_id)
                            ->select('ph.balita_id')
                            ->groupBy('ph.balita_id')
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
                $balita->whereIn('id',$balitaArr);
            $data = $balita->get();
            //dd($data);
        }
        return view('dashboard.balita.index',compact('data','bidan','posyandu','request'));
    }

    public function create()
    {
        return view('dashboard.balita.add');
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('balita')->insert([
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
        return view('dashboard.balita.edit',compact('data'));
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
