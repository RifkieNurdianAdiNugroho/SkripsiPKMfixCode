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

    public function kader($id)
    {
       $data = DB::table('posyandu as kp')
                ->where('kp.id',$id)
                ->first();
        if(!$data)
        {
            return redirect('data/posyandu')->with('error','Tidak dapat menemukan data Pos');
        }
        $kader = DB::table('kader')->get();
        $kader = json_decode(json_encode($kader),true);
        $kaderArr = [];
        foreach ($kader as $key => $value) 
        {
            $check = DB::table('posyandu_kader')
            ->where('kader_id',$value['id'])
            ->where('hide','no')
            ->where('posyandu_id',$id)
            ->first();
            if($check)
            {
                array_push($kaderArr, $check->kader_id);
            }
        }
        return view('dashboard.posyandu.kader',compact('data','kaderArr','kader'));
    }

    public function kaderStore(Request $request)
    {
        $kaderSelected = $request->kader_id;
        if(count($kaderSelected) < 0)
        {
            return redirect()->back()->with('error','Minimal harus memilih salah satu kader');
        }
        DB::table('posyandu_kader')->where('posyandu_id',$request->posyandu_id)->update(['hide'=>'yes']);
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        foreach ($kaderSelected as $key => $value) 
        {
            $data = DB::table('posyandu_kader')
            ->where('kader_id',$value)
            ->where('posyandu_id',$request->posyandu_id)
            ->first();
            if($data)
            {
                DB::table('posyandu_kader')
                ->where('kader_id',$value)
                ->where('posyandu_id',$request->posyandu_id)
                ->update(['hide'=>'no']);
            }else{
                DB::table('posyandu_kader')->insert([
                    'posyandu_id'=>$request->posyandu_id,
                    'kader_id'=>$value,
                    'hide'=>'no',
                    'created_at'=>$createdAt
                ]);
            }
        }
         return redirect()->back()->with('success','Berhasil menambahkan kader');
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
