<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataBidanExport;
class BidanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = DB::table('bidan as bd')
                ->join('users as us','us.id','=','bd.user_id')
                ->select('bd.*','us.email')
                ->get();
        Session::put('dataBidan',$data);
        return view('dashboard.bidan.index',compact('data'));
    }

    public function exportExcel()
    {
        return Excel::download(new DataBidanExport, 'data_bidan.xlsx');
    }

    public function posyandu($id)
    {
        $posyandu = DB::table('posyandu as pd')
                        ->join('posyandu_bidan as pb','pb.posyandu_id','=','pd.id')
                        ->where('pb.bidan_id',$id)
                        ->select('pd.id','pd.nama_pos')
                        ->groupBy('pb.posyandu_id')
                        ->get();
        return response()->json(['data'=>$posyandu]);
    }

    public function create()
    {
        return view('dashboard.bidan.add');
    }

    public function store(Request $request)
    {
        $check = DB::table('users')->where('email',$request->email_aktif)->first();
        if($check)
        {
            return redirect('user/bidan')
                ->with('error','Gagal menambahakan data Bidan email '.$request->email_aktif.' sudah terpakai mohon gunakan email yang lain');
        }

        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $userId = DB::table('users')->insertGetId([
            'role'=>'bidan',
            'email'=>$request->email_aktif,
            'password'=>bcrypt($request->password),
            'created_at'=>$createdAt,
        ]);

        DB::table('bidan')->insert([
            'user_id'=>$userId,
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'polindes'=>$request->polindes,
            'jabatan_fungsional'=>$request->jabatan_fungsional,
            'no_tlp'=>$request->no_tlp,
            'created_at'=>$createdAt
        ]);
        return redirect('user/bidan')->with('success','Berhasil menambahakan data Bidan');
    }

    public function edit($id)
    {
        $data = DB::table('bidan as bd')
                ->join('users as us','us.id','=','bd.user_id')
                ->where('bd.id',$id)
                ->select('bd.*','us.email')
                ->first();
        if(!$data)
        {
            return redirect('user/bidan')->with('error','Tidak dapat menemukan data Bidan');
        }
        return view('dashboard.bidan.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
       $check = DB::table('users')->where('email',$request->email_aktif)->first();
       if($check)
       {
            if($check->id != $request->user_id)
            {
                return redirect('user/bidan/edit/'.$id)
                ->with('error','Gagal mengubah data Bidan email '.$request->email_aktif.' sudah terpakai mohon gunakan email yang lain');
            }
       }

       $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

       if($request->password != null)
       {
            DB::table('users')->where('id',$request->user_id)->update([
                'role'=>'bidan',
                'email'=>$request->email_aktif,
                'password'=>bcrypt($request->password),
                'updated_at'=>$createdAt,
            ]);
       }else{
            DB::table('users')->where('id',$request->user_id)->update([
                'role'=>'bidan',
                'email'=>$request->email_aktif,
                'updated_at'=>$createdAt,
            ]);
       }
        

        DB::table('bidan')->where('id',$id)->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'polindes'=>$request->polindes,
            'jabatan_fungsional'=>$request->jabatan_fungsional,
            'no_tlp'=>$request->no_tlp,
            'updated_at'=>$createdAt
        ]);
        if(Auth::user()->role == 'bidan')
        {
            return redirect()->back()->with('success','Berhasil mengubah data Bidan');
        }
        return redirect('user/bidan')->with('success','Berhasil mengubah data Bidan');
    }

    public function delete($id)
    {
        $data = DB::table('bidan')->where('id',$id)->first();
        if($data)
        {
            DB::table('users')->where('id',$data->user_id)->delete();
            DB::table('bidan')->where('id',$id)->delete();
            return redirect('user/bidan')->with('success','Berhasil menghapus data Bidan');
        }else{
            return redirect('user/bidan')->with('error','Tidak dapat menemukan data Bidan');
        }
    }
}
