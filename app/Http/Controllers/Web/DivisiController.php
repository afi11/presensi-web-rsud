<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Divisi;

class DivisiController extends Controller
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
                'namaDivisi' => 'required',
            ],
            [
                'namaDivisi.required' => 'Nama Divisi harus diisi',
            ]
        );
        return $validate_data;
    }

    public function index()
    {
        $ruangan = Divisi::all();
        return view('pages.ruangan.index', compact('ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Tambah Divisi";
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
        Divisi::create($request->all());
        return redirect('ruangan')->with('success','Berhasil Menambah Data Divisi');
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
        $page = "Edit Divisi";
        $isEdit = true;
        $divisi = Divisi::find($id);
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
        $ruangan = Divisi::find($id);
        $ruangan->namaDivisi = $request->namaDivisi;
        $ruangan->keteranganDivisi = $request->keteranganDivisi;
        $ruangan->save();
        return redirect('ruangan')->with('success','Berhasil Mengubah Data Divisi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruangan = Divisi::find($id);
        $ruangan->delete();
        return redirect('ruangan')->with('success','Berhasil Menghapus Data Divisi');
    }
}
