<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
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
                'nama_ruangan' => 'required',
            ],
            [
                'nama_ruangan.required' => 'Nama ruangan harus diisi',
            ]
        );
        return $validate_data;
    }

    public function index()
    {
        $ruangan = Ruangan::all();
        return view('pages.ruangan.index', compact('ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Tambah Ruangan";
        $isEdit = false;
        return view('pages.ruangan.create_edit', compact('page', 'isEdit'));
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
        Ruangan::create($request->all());
        return redirect('ruangan')->with('success','Berhasil Menambah Data Ruangan');
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
        $page = "Edit Ruangan";
        $isEdit = true;
        $ruangan = Ruangan::find($id);
        return view('pages.ruangan.create_edit', compact('page', 'isEdit', 'ruangan'));
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
        $this->validation($request);
        $ruangan = Ruangan::find($id);
        $ruangan->nama_ruangan = $request->nama_ruangan;
        $ruangan->save();
        return redirect('ruangan')->with('success','Berhasil Mengubah Data Ruangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->delete();
        return redirect('ruangan')->with('success','Berhasil Menghapus Data Ruangan');
    }
}
