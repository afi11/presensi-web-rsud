<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Divisi;
use App\Models\WaktuKerjaShift;
use App\Models\WaktuReguler;
use App\Imports\ImportPegawai;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validation($request)
    {
        $validate_data = $this->validate(
            $request,
            [
                'idDivisi' => 'required',
                'statusShift' => 'required',
                'nama' => 'required',
            ],
            [
                'idDivisi.required' => 'Nama divisi harus diisi',
                'statusShift.required' => 'Status Shift pegawai harus diisi',
                'nama.required' => 'Nama pegawai harus diisi',
            ]
        );
        return $validate_data;
    }

    public function validation2($request)
    {
        $validate_data = $this->validate(
            $request,
            [
                'idDivisi' => 'required',
                'statusShift' => 'required',
                'nama' => 'required',
                'username' => 'required',
            ],
            [
                'idDivisi.required' => 'Nama divisi harus diisi',
                'statusShift.required' => 'Status Shift pegawai harus diisi',
                'nama.required' => 'Nama pegawai harus diisi',
                'username.required' => 'Username pegawai harus diisi',
            ]
        );
        return $validate_data;
    }

    public function index()
    {
        $pegawai = Pegawai::leftJoin('users', 'users.pegawai_code', '=', 'pegawai.code')
            ->leftJoin('divisi', 'divisi.id', '=', 'pegawai.idDivisi')
            ->select('users.username', 'divisi.namaDivisi', 'pegawai.*')
            ->get();
        return view('pages.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Tambah Pegawai";
        $isEdit = false;
        $ruangan = Divisi::where('asal', 'duk_up')->get();
        $shift = WaktuKerjaShift::all();
        return view('pages.pegawai.create_edit', compact('page', 'isEdit', 'ruangan', 'shift'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validation($request);
        DB::transaction(function() use ($request) {
            $kodePegawai = genKodePegawai();
            if($request->file('foto_pegawai') != ""){
                $resorce = $request->file('foto_pegawai');
                $fileName = time().$resorce->getClientOriginalName();
                $resorce->move(\base_path() ."/public/assets/img/users", $fileName);
            }else{
                if($request->gender == "L"){
                    $fileName = "male.png";
                }else if($request->gender == "P"){
                    $fileName = "female.png";
                }else{
                    $fileName = "default.jpg";
                }
            }
            Pegawai::create($request->except(['code', 'foto_pegawai', 'status'])+[
                "code" => $kodePegawai,
                "foto_pegawai" => $fileName,
                "status" => "kontrak",
            ]);

            User::create([
                "pegawai_code" => $kodePegawai,
                "username" => $kodePegawai,
                "email" => $request->email,
                "password" => bcrypt($kodePegawai),
                "password_hint" => 'Default Sama dengan kode pegawai',
                "role" => "pegawai",
            ]);
        });
        //return response()->json(["kode" => $kodePegawai]);
        return redirect('pegawai')->with('success','Berhasil Menambah Data Pegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = "Edit Pegawai";
        $isEdit = true;
        $ruangan = Divisi::where('asal', 'duk_up')->get();
        $shift = WaktuKerjaShift::all();
        $pegawai = Pegawai::leftJoin('users', 'users.pegawai_code', '=', 'pegawai.code')
            ->where('pegawai.id', $id)
            ->select('pegawai.*','users.username','users.email')
            ->first();
        return view('pages.pegawai.create_edit', compact('pegawai', 'page', 'isEdit', 'ruangan', 'shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$this->validation2($request);
        $pegawai = Pegawai::find($id);
        $pegawai->nik = $request->nik;
        $pegawai->nama = $request->nama;
        $pegawai->idDivisi = $request->idDivisi;
        $pegawai->idJamKerjaShift = $request->idJamKerjaShift;
        $pegawai->statusShift = $request->statusShift;
        $pegawai->gender = $request->gender;
        $pegawai->telepon = $request->telepon;
        $pegawai->tglLahir = $request->tglLahir;
        $pegawai->alamat = $request->alamat;
        if($request->foto_pegawai != ""){
            $resorce = $request->file('foto_pegawai');
            $fileName = time().$resorce->getClientOriginalName();
            $resorce->move(\base_path() ."/public/assets/img/users", $fileName);
            // if($pegawai->foto_pegawai != "female.png" || $pegawai->foto_pegawai != "male.png" || $pegawai->foto_pegawai != "default.jpg"){
            //     \File::delete(public_path('assets/img/users/'.$pegawai->foto_pegawai));
            // }
            $pegawai->foto_pegawai = $fileName;
        }
        $pegawai->save();
        
        $user = User::where('pegawai_code', $pegawai->code)->first();
        //$user->username = $request->username;
        $user->email = $request->email;
        //if($request->password != ""){
            // $user->password = bcrypt($request->password);
            // $user->password_hint = $request->password;
       // }
        $user->save();
        return redirect('pegawai')->with('success','Berhasil Mengubah Data Pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        User::where('pegawai_code', $pegawai->code)->delete();
        // if($pegawai->foto_pegawai != "male.png" || $pegawai->foto_pegawai != "female.png" || $pegawai->foto_pegawai != "default.jpg"){
        //     \File::delete(public_path('assets/img/users/'.$pegawai->foto_pegawai));
        // }
        $pegawai->delete();
        return redirect('pegawai')->with('success','Berhasil Menghapus Data Pegawai');
    }

    public function import(Request $request)
    {
        $import = Excel::import(new ImportPegawai(), $request->file('data_pegawai'));
        return redirect('pegawai')->with('success','Berhasil Mengimport data pegawai');
    }
}
