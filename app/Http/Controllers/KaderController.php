<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class KaderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('kader as bd')
                ->get();
        return view('dashboard.kader.index',compact('data'));
    }

    public function create()
    {
        return view('dashboard.kader.add');
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
        return view('dashboard.kader.edit',compact('data'));
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
