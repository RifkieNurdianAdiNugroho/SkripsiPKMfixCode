<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
class SimulatorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$data = [];
    	if(count($request->all()))
    	{
    		$data = $this->calculateSaw($request);
    	}
    	//dd($data);
    	return view('dashboard.simulator.index',compact('request','data'));
    }

    public function calculateSaw($request)
    {
        //$balita = DB::table('balita')->whereIn('id',$request->balita_id)->get();
        $data = [];
       // foreach ($balita as $balitaKey => $balitaValue) 
        //{
            $umur = 0;
            $tb = 0;
            $bb = 0;
            $jenis_kelamin = $request->jenis_kelamin;
            //foreach ($request->jadwal_id as $jadwalKey => $jadwalValue) 
            //{
               $umur = $request->umur;
               $tb = $request->tb;
               $bb = $request->bb;
               $data = [];
               $data[0] = 0;
               $data[1] = 0;
               $data[2] = 0;
               $data['c1']  = 0;
               $data['c2'] = 0;
               $data['c3'] = 0;
               $data['saw'] = 0;
               $data['status'] = null;
               if($jenis_kelamin == 'L')
               {
                    if($tb != null && $bb != null)
                    {
                        //c1
                        $ceSatu = $this->getBobot($jenis_kelamin,$umur,$tb,null,'standart_tb_umur_laki_laki','tb_char','tb/u','data');
                        //dd($ceSatu);
                        $ceSatu = $this->normalizeKategori($ceSatu); //30
                        $data[0] = $ceSatu;
                        //c2
                        $ceDua = $this->getBobot($jenis_kelamin,$umur,$bb,null,'standart_bb_umur_laki_laki','bb_char','bb/u','data');
                        // dd($ceDua);
                        $ceDua = $this->normalizeKategori($ceDua); //40
                        $data[1] = $ceDua;
                        //c3
                        $ceTiga = $this->getBobot($jenis_kelamin,$umur,$tb,$bb,'standart_bb_tb_laki_laki','tb_bb_char','bb/tb','data');
                        $ceTiga = $this->normalizeKategori($ceTiga); //30
                        $data[2] = $ceTiga;
                    }
               }else
               {
                    if($tb != null && $bb != null)
                    {
                        //c1
                        $ceSatu = $this->getBobot($jenis_kelamin,$umur,$tb,null,'standart_tb_umur_perempuan','tb_char','tb/u','data');
                        $ceSatu = $this->normalizeKategori($ceSatu); //30
                        $data[0] = $ceSatu;
                        //c2
                        $ceDua = $this->getBobot($jenis_kelamin,$umur,$bb,null,'standart_bb_umur_perempuan','bb_char','bb/u','data');
                        $ceDua = $this->normalizeKategori($ceDua); //40
                        $data[1] = $ceDua;
                        //c3
                        $ceTiga = $this->getBobot($jenis_kelamin,$umur,$tb,$bb,'standart_bb_tb_perempuan','tb_bb_char','bb/tb','data');
                        $ceTiga = $this->normalizeKategori($ceTiga); //30
                        $data[2] = $ceTiga;
                    }
               }

               if($tb != null && $bb != null)
               {
                //benefit
                   $max = max($data);
                   $c1 = $data[0] / $max;
                   $c2 = $data[1] / $max;
                   $c3 = $data[2] / $max;
                   //kali
                   $c1 = $c1 * 30;
                   $c2 = $c2 * 40;
                   $c3 = $c3 * 30;
                   $hasil =  $c1 + $c2 + $c3;
                   $data['c1']  = $c1;
                   $data['c2'] = $c2;
                   $data['c3'] = $c3;
                   $data['saw'] = $hasil;
               }

               if ($data['saw'] < 60 && $data['c1'] > 0 && $data['c2'] > 0 && $data['c3'] > 0) 
               {
                   $data['status'] = 'Gizi Buruk';
               }elseif ($data['saw'] <= 69.9 && $data['c1'] > 0 && $data['c2'] > 0 && $data['c3'] > 0) 
               {
                  $data['status'] = 'Gizi Kurang';
               }elseif ($data['saw'] <= 79.9 && $data['c1'] > 0 && $data['c2'] > 0 && $data['c3'] > 0) 
               {
                  $data['status'] = 'Gizi Sedang';
               }elseif ($data['saw'] <= 100 && $data['c1'] > 0 && $data['c2'] > 0 && $data['c3'] > 0) 
               {
                  $data['status'] = 'Gizi Baik';
                }else{
                   $c1 = $c1 * 50;
                   $c2 = $c2 * 50;
                   $c3 = $c3 * 50;
                   $hasil =  $c1 + $c2 + $c3;
                   $data['c1']  = $c1;
                   $data['c2'] = $c2;
                   $data['c3'] = $c3;
                   $data['saw'] = $hasil;
                  $data['status'] = 'Gizi Lebih';
               }
            //}
        //}
        //dd($data);
        return $data;
    }

    public function getBobot($jenis_kelamin,$umur,$val,$val2,$table,$column,$type,$balitaName)
    {
       
        if($type != 'bb/tb')
        {
            $result = [];
            $data = DB::table($table)->where('umur',$umur)->select($column,'value')->get();
            if(!$data->isEmpty())
            {
                foreach ($data as $key => $value) 
                {
                 if(round($value->value) <= round($val))
                  {
                    array_push($result, $value->$column);
                  }
                }

                if(count($result) > 2)
                {
                    unset($result[0]);
                }
            }
        }else
        {
            $result = [];
            $data = DB::table($table)->where('tb','>=',$val)->select($column,'bb')->get();
            if(!$data->isEmpty())
            {
                foreach ($data as $key => $value) 
                {
                   $bb = round($value->bb);
                   if($bb <= $val2)
                   {
                        array_push($result, $value->$column);
                   }
                }
            }
        }
        $result = array_unique($result);
        $arr  = ['result'=>$result,'type'=>$type,'val'=>$val,'umur'=>$umur,'balita'=>$balitaName]; 
        return $arr;
    }

    public function normalizeKategori($arr)
    {
        //dd($arr);
        $imp = implode('|', $arr['result']);
        $imp = str_replace(' SD', '', $imp);
        $data = DB::table('kategori_status_gizi')->where('type',$arr['type'])->where('z_score',$imp)->first();
        $result = [];
        $bobot = 0;
        $plod = [];
        if($data)
        {
          $arr['data'] = $data;
          $bobot = $data->bobot;
        }else
        {
         $data = DB::table('kategori_status_gizi')->where('type',$arr['type'])->where('z_score', 'like', '%' .$imp. '%')->first();
         if($data)
         {
            $arr['data'] = $data;
            $bobot = $data->bobot;
         }
        }

        $arr['imp'] = $imp;
        return $bobot;
    }
}