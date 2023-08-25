<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataAhliGiziExport;
class AhliGiziController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('ahli_gizi as agz')
                ->join('users as us','us.id','=','agz.user_id')
                ->select('agz.*','us.email')
                ->get();
        Session::put('dataAhliGizi',$data);
        return view('dashboard.ahli_gizi.index',compact('data'));
    }

    public function exportExcel()
    {
        return Excel::download(new DataAhliGiziExport, 'data_ahli_gizi.xlsx');
    }

    public function create()
    {
        return view('dashboard.ahli_gizi.add');
    }

    public function store(Request $request)
    {
        $check = DB::table('users')->where('email',$request->email_aktif)->first();
        if($check)
        {
            return redirect('user/ahli_gizi')
                ->with('error','Gagal menambahakan data Ahli Gizi email '.$request->email_aktif.' sudah terpakai mohon gunakan email yang lain');
        }

        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $userId = DB::table('users')->insertGetId([
            'role'=>'ahli_gizi',
            'email'=>$request->email_aktif,
            'password'=>bcrypt($request->password),
            'created_at'=>$createdAt,
        ]);

        DB::table('ahli_gizi')->insert([
            'user_id'=>$userId,
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'jabatan_fungsional'=>$request->jabatan_fungsional,
            'no_tlp'=>$request->no_tlp,
            'created_at'=>$createdAt
        ]);
        return redirect('user/ahli_gizi')->with('success','Berhasil menambahakan data Ahli Gizi');
    }

    public function edit($id)
    {
        $data = DB::table('ahli_gizi as agz')
                ->join('users as us','us.id','=','agz.user_id')
                ->where('agz.id',$id)
                ->select('agz.*','us.email')
                ->first();
        if(!$data)
        {
            return redirect('user/ahli_gizi')->with('error','Tidak dapat menemukan data Ahli Gizi');
        }
        return view('dashboard.ahli_gizi.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
       $check = DB::table('users')->where('email',$request->email_aktif)->first();
       if($check)
       {
            if($check->id != $request->user_id)
            {
                return redirect('user/ahli_gizi/edit/'.$id)
                ->with('error','Gagal mengubah data Ahli Gizi email '.$request->email_aktif.' sudah terpakai mohon gunakan email yang lain');
            }
       }

       $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

       if($request->password != null)
       {
            DB::table('users')->where('id',$request->user_id)->update([
                'role'=>'ahli_gizi',
                'email'=>$request->email_aktif,
                'password'=>bcrypt($request->password),
                'updated_at'=>$createdAt,
            ]);
       }else{
            DB::table('users')->where('id',$request->user_id)->update([
                'role'=>'ahli_gizi',
                'email'=>$request->email_aktif,
                'updated_at'=>$createdAt,
            ]);
       }
        

        DB::table('ahli_gizi')->where('id',$id)->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'jabatan_fungsional'=>$request->jabatan_fungsional,
            'no_tlp'=>$request->no_tlp,
            'updated_at'=>$createdAt
        ]);
        if(Auth::user()->role == 'ahli_gizi')
        {
            return redirect()->back()->with('success','Berhasil mengubah data Ahli Gizi');
        }
        return redirect('user/ahli_gizi')->with('success','Berhasil mengubah data Ahli Gizi');
    }

    public function delete($id)
    {
        $data = DB::table('ahli_gizi')->where('id',$id)->first();
        if($data)
        {
            DB::table('users')->where('id',$data->user_id)->delete();
            DB::table('ahli_gizi')->where('id',$id)->delete();
            return redirect('user/ahli_gizi')->with('success','Berhasil menghapus data Ahli Gizi');
        }else{
            return redirect('user/ahli_gizi')->with('error','Tidak dapat menemukan data Ahli Gizi');
        }
    }
}
