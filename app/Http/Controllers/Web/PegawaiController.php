<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Ruangan;
use App\Models\TipeShift;

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
                'ruangan_id' => 'required',
                'shift_id' => 'required',
                'nama_pegawai' => 'required',
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'ruangan_id.required' => 'Nama ruangan harus diisi',
                'shift_id.required' => 'Shift pegawai harus diisi',
                'nama_pegawai.required' => 'Nama pegawai harus diisi',
                'username.required' => 'Username pegawai harus diisi',
                'password.required' => 'Password pegawai harus diisi',
            ]
        );
        return $validate_data;
    }

    public function validation2($request)
    {
        $validate_data = $this->validate(
            $request,
            [
                'ruangan_id' => 'required',
                'shift_id' => 'required',
                'nama_pegawai' => 'required',
                'username' => 'required',
            ],
            [
                'ruangan_id.required' => 'Nama ruangan harus diisi',
                'shift_id.required' => 'Shift pegawai harus diisi',
                'nama_pegawai.required' => 'Nama pegawai harus diisi',
                'username.required' => 'Username pegawai harus diisi',
            ]
        );
        return $validate_data;
    }

    public function index()
    {
        $pegawai = Pegawai::join('users', 'users.pegawai_code', '=', 'pegawai.code')
            ->join('ruangan', 'ruangan.id', '=', 'pegawai.ruangan_id')
            ->join('tipe_shift', 'tipe_shift.id', '=', 'pegawai.shift_id')
            ->select('users.username', 'ruangan.nama_ruangan', 'tipe_shift.nama_shift', 'pegawai.*')
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
        $ruangan = Ruangan::all();
        $shift = TipeShift::all();
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
        $this->validation($request);
        $kodePegawai = genKodePegawai();
        if($request->file('foto_pegawai') != ""){
            $resorce = $request->file('foto_pegawai');
            $fileName = time().$resorce->getClientOriginalName();
            $resorce->move(\base_path() ."/public/assets/img/users", $fileName);
        }else{
            if($request->gender == "MALE"){
                $fileName = "male.png";
            }else if($request->gender == "FEMALE"){
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
            "username" => $request->username,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "password_hint" => $request->password,
            "role" => "pegawai",
        ]);

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
        $ruangan = Ruangan::all();
        $shift = TipeShift::all();
        $pegawai = Pegawai::join('users', 'users.pegawai_code', '=', 'pegawai.code')
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
        $this->validation2($request);
        $pegawai = Pegawai::find($id);
        $pegawai->nik_pegawai = $request->nik_pegawai;
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->ruangan_id = $request->ruangan_id;
        $pegawai->shift_id = $request->shift_id;
        $pegawai->gender = $request->gender;
        $pegawai->telepon_pegawai = $request->telepon_pegawai;
        $pegawai->alamat_pegawai = $request->alamat_pegawai;
        $pegawai->nik_pegawai = $request->nik_pegawai;
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
        $user->username = $request->username;
        $user->email = $request->email;
        if($request->password != ""){
            $user->password = bcrypt($request->password);
            $user->password_hint = $request->password;
        }
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
}
