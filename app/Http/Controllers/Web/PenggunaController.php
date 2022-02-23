<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PenggunaController extends Controller
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
                'username' => 'required',
                'password' => 'required',
                'role' => 'required'
            ],
            [
                'username.required' => 'Username harus diisi',
                'password.required' => 'Password harus diisi',
                'role.required' => 'Role harus diisi'
            ]
        );
        return $validate_data;
    }

    public function index()
    {
        $pengguna = User::where('role', '<>', 'pegawai')->get();
        return view('pages.pengguna.index', compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Tambah Pengguna";
        $isEdit = false;
        return view('pages.pengguna.create_edit', compact('page', 'isEdit'));
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
        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'password_hint' => $request->password_hint,
            'role' => $request->role,
            'enable_presensi' => 0
        ]);
        return redirect('pengguna')->with('success','Berhasil Menambah Data Pengguna');
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
        $page = "Edit Pengguna";
        $isEdit = true;
        $pengguna = User::find($id);
        return view('pages.pengguna.create_edit', compact('page', 'isEdit', 'pengguna'));
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
        $pengguna = User::find($id);
        $pengguna->username = $request->username;
        if($request->password != $pengguna->password){
            $pengguna->password = bcrypt($request->password);
        }
        $pengguna->password_hint = $request->password_hint;
        $pengguna->role = $request->role;
        $pengguna->save();
        return redirect('pengguna')->with('success','Berhasil Mengubah Data Pengguna');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengguna = User::find($id);
        $pengguna->delete();
        return redirect('pengguna')->with('success','Berhasil Mengubah Data Pengguna');
    }
}
