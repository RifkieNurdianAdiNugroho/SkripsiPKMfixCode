<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class BalitaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('balita as bd')
                ->get();
        return view('dashboard.balita.index',compact('data'));
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
