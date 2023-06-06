<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
class DataTimbangController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //dd($request->all());
        $userId = Auth::user()->id;
        $role = Auth::user()->role;
        $bidan = DB::table('bidan')->where('user_id',$userId)->first();

        $getJadwal = DB::table('posyandu_jadwal as pj');
        $getJadwal->join('bidan as bd','bd.id','=','pj.bidan_id');
        $getJadwal->join('posyandu as pd','pd.id','=','pj.posyandu_id');
        if($role == 'bidan')
        {
            $getJadwal->where('pj.bidan_id',$bidan->id);
        }else{
            if($request->bidan_id != null)
            {
                $getJadwal->where('pj.bidan_id',$request->bidan_id);
            }
        }
        $getJadwal->where('pj.jenis','posyandu');
        if($request->pos_id != null)
        {
            $getJadwal->where('pd.id',$request->pos_id);
        }
        if($request->start_month != null && $request->end_month == null)
        {
            $start = explode('-', $request->start_month);
            $getJadwal->whereMonth('pj.tanggal','=',$start[1]);
        }
        if($request->start_month == null && $request->end_month != null)
        {
            $end = explode('-', $request->end_month);
            $getJadwal->whereMonth('pj.tanggal','=',$end[1]);
        }
        if($request->start_month != null && $request->end_month != null)
        {
            $start = $request->start_month.'-01';
            //$start = Carbon::parse($start)->addMonths(1)->format('Y-m-d');
           // $start = Carbon::parse($start)->subDays(1)->format('Y-m-d');
            $end = $request->end_month.'-01';
            $end = Carbon::parse($end)->addMonths(1)->format('Y-m-d');
            $end = Carbon::parse($end)->subDays(1)->format('Y-m-d');
            $arr = [$start,$end];
            $getJadwal->whereBetween('pj.tanggal',$arr);
            //dd($arr);
        }
        $getJadwal->select('bd.nama as bidan_name','pj.tanggal','pd.id as posyandu_id','bd.id as bidan_id'
                        ,'pj.jenis as jadwal_type','pd.nama_pos as posyandu_name','pj.id');
        $getJadwal->orderBy('pj.tanggal');
        $jadwal = $getJadwal->get();
        $getBalita = DB::table('balita');
        if($request->balita != null)
        {
            $getBalita->where('nama', 'like', '%' . $request->balita . '%');
        }
        if($request->ortu != null)
        {
            $getBalita->where('nama_ortu', 'like', '%' . $request->ortu . '%');
        }
        $balita = $getBalita->get();
        $posyandu = DB::table('posyandu')->get();
        $now = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $data = [];
        if(count($request->all()) > 0)
        {
            foreach ($jadwal as $jadwalKey => $jadwalValue) 
            {
                $bulan = Carbon::parse($jadwalValue->tanggal)->locale('id')
                        ->settings(['formatFunction' => 'translatedFormat'])
                        ->format('F');
                $data['bulan'][$jadwalKey] = $bulan;
                $data['jadwal'][$jadwalKey]['bidan_id'] = $jadwalValue->bidan_id;
                $data['jadwal'][$jadwalKey]['pos_id'] = $jadwalValue->posyandu_id;
                $data['jadwal'][$jadwalKey]['jadwal_id'] = $jadwalValue->id;
                foreach ($balita as $balitaKey => $balitaValue) 
                {
                    $jadwalDate = Carbon::parse($jadwalValue->tanggal);
                    $tglLahir =  Carbon::parse($balitaValue->tgl_lahir);
                    $umur = Carbon::parse($tglLahir)->diffInMonths($jadwalDate);
                    $data['balita'][$balitaKey]['pos']= $jadwalValue->posyandu_name;
                    $data['balita'][$balitaKey]['balita_id'] = $balitaValue->id;
                    $data['balita'][$balitaKey]['nama']= $balitaValue->nama;
                    $data['balita'][$balitaKey]['ortu']= $balitaValue->nama_ortu;
                    $data['balita'][$balitaKey]['status_gizi'] = 'Belum Dihitung';
                    $data['hasil'][$jadwalValue->id][$balitaKey]['umur'] = $umur;
                    $data['hasil'][$jadwalValue->id][$balitaKey]['tb'] = '';
                    $data['hasil'][$jadwalValue->id][$balitaKey]['bb'] = '';
                    $hasil = DB::table('posyandu_hasil')
                            ->where('jadwal_id',$jadwalValue->id)
                            ->where('balita_id',$balitaValue->id)
                            ->first();
                    if($hasil)
                    {
                        $data['hasil'][$jadwalValue->id][$balitaKey]['tb'] = $hasil->tb;
                        $data['hasil'][$jadwalValue->id][$balitaKey]['bb'] = $hasil->bb;
                    }
                }
            }
        }
        $bidan = DB::table('bidan')->get();
        return view('dashboard.timbang.index',compact('data','now','posyandu','request','bidan','role'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $jadwal_id = $request->jadwal_id;
        if($request->balita_id)
        {
            foreach ($request->balita_id as $key => $value) 
            {
                foreach ($jadwal_id as $jadwalKey => $jadwalValue) 
                {
                    $umur = $request->umur[$value][$jadwalValue];
                    $tb = $request->tb[$value][$jadwalValue];
                    $bidan_id = $request->bidan_id;
                    $bb = $request->bb[$value][$jadwalValue];
                    $check = DB::table('posyandu_hasil')->where('jadwal_id',$jadwalValue)->where('balita_id',$value)->first();
                    //dd($check);
                    if($check)
                    {
                        DB::table('posyandu_hasil')->where('id',$check->id)->update([
                            'balita_id'=>$value,
                            'bidan_id'=>$bidan_id,
                            'jadwal_id'=>$jadwalValue,
                            'tb'=>$tb,
                            'bb'=>$bb,
                            'umur'=>$umur,
                            'updated_at'=>$createdAt
                        ]);
                    }else
                    {
                        //return $jadwalValue.' - '.$value;
                        DB::table('posyandu_hasil')->insert([
                            'balita_id'=>$value,
                            'bidan_id'=>$bidan_id,
                            'jadwal_id'=>$jadwalValue,
                            'tb'=>$tb,
                            'bb'=>$bb,
                            'umur'=>$umur,
                            'created_at'=>$createdAt
                        ]);
                    }
                }
            }
            return redirect()->back()->with('success','Berhasil menambahakan data timbangan');
        }else{
            return redirect()->back()->with('error','Filter data terlebih dahulu!');
        }
    }

    public function calculateSaw()
    {
        //step 1
        
    }
}
