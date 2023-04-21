<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class PosyanduController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('posyandu')->get();
        return view('dashboard.posyandu.index',compact('data'));
    }

     public function create()
    {
        return view('dashboard.posyandu.add');
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('posyandu')->insert([
            'desa'=>$request->desa,
            'alamat'=>$request->alamat,
            'nama_pos'=>$request->nama_pos,
            'created_at'=>$createdAt
        ]);
        return redirect('data/posyandu')->with('success','Berhasil menambahakan data Pos');
    }

    public function edit($id)
    {
       $data = DB::table('posyandu as kp')
                ->where('kp.id',$id)
                ->first();
        if(!$data)
        {
            return redirect('data/posyandu')->with('error','Tidak dapat menemukan data Pos');
        }
        return view('dashboard.posyandu.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {

        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('posyandu')->where('id',$id)->update([
            'desa'=>$request->desa,
            'alamat'=>$request->alamat,
            'nama_pos'=>$request->nama_pos,
            'updated_at'=>$createdAt
        ]);
        return redirect('data/posyandu')->with('success','Berhasil mengubah data Pos');
    }

    public function delete($id)
    {
        $data = DB::table('posyandu')->where('id',$id)->first();
        if($data)
        {
            DB::table('posyandu')->where('id',$id)->delete();
            return redirect('data/posyandu')->with('success','Berhasil menghapus data Pos');
        }else{
            return redirect('data/posyandu')->with('error','Tidak dapat menemukan data Pos');
        }
    }
}
