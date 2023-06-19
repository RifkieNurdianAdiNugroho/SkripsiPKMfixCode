<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataPosyanduExport;
class PosyanduController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('posyandu')->get();
        $bidanPos = [];
        foreach ($data as $key => $value) 
        {
           $check = DB::table('posyandu_bidan')->where('posyandu_id',$value->id)->where('status',1)->get();
           if(!$check->isEmpty())
           {
             $noBidan = 0;
             foreach ($check as $checkKey => $checkValue) 
             {
                 $bidan = DB::table('bidan')->where('id',$checkValue->bidan_id)->first();
                 if($bidan)
                 {
                    $noBidan++;
                    $bidanPos[$key][$noBidan]['nama'] = $bidan->nama;
                 }
             }
           }
        }
        Session::put('dataPosyandu',$data);
        Session::put('bidanPos',$bidanPos);
        return view('dashboard.posyandu.index',compact('data','bidanPos'));
    }

    public function exportExcel()
    {
        return Excel::download(new DataPosyanduExport, 'data_posyandu.xlsx');
    }

    public function create()
    {
        $bidan = DB::table('bidan')->get();
        return view('dashboard.posyandu.add',compact('bidan'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $Id = DB::table('posyandu')->insertGetId([
                'desa'=>$request->desa,
                'alamat'=>$request->alamat,
                'nama_pos'=>$request->nama_pos,
                'created_at'=>$createdAt
            ]);
        if($request->bidan_id)
        {
            foreach ($request->bidan_id as $key => $value) 
            {
                DB::table('posyandu_bidan')->insert([
                    'posyandu_id'=>$Id,
                    'bidan_id'=>$value,
                    'created_at'=>$createdAt
                ]);
            }
        }
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
        $bidanChecked = [];
        $bidanData = DB::table('posyandu_bidan')->where('posyandu_id',$id)->get();
        foreach ($bidanData as $key => $value) 
        {
            array_push($bidanChecked, $value->bidan_id);
        }
        $bidanYes = DB::table('bidan')->whereIn('id',$bidanChecked)->get();
        $bidanNot = DB::table('bidan')->whereNotIn('id',$bidanChecked)->get();
        //dd($bidanYes);
        return view('dashboard.posyandu.edit',compact('data','bidanYes','bidanNot'));
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
        DB::table('posyandu_bidan')->where('posyandu_id',$id)->update(['status'=>0]);
        if($request->bidan_id)
        {
            foreach ($request->bidan_id as $key => $value) 
            {
                $check = DB::table('posyandu_bidan')->where('posyandu_id',$id)->where('bidan_id',$value)->first();
                if(!$check)
                {
                   DB::table('posyandu_bidan')->insert([
                        'posyandu_id'=>$id,
                        'bidan_id'=>$value,
                        'created_at'=>$createdAt
                    ]);
                }else
                {
                    DB::table('posyandu_bidan')->where('id',$check->id)->update(['status'=>1]);
                }
            }
        }
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
