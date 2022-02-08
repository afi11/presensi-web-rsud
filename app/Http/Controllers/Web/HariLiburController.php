<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HariLibur;
use App\Models\TipeShift;

class HariLiburController extends Controller
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
                'tanggal_libur' => 'required'
            ],
            [
                'tanggal_libur.required' => 'Tanggal libur harus diisi'
            ]
        );
        return $validate_data;
    }

    public function index()
    {
        $hariLibur = HariLibur::leftJoin('tipe_shift', 'tipe_shift.id', '=', 'hari_libur.shift_id')
            ->select('tipe_shift.nama_shift','hari_libur.*')->get();
        return view('pages.harilibur.index', compact('hariLibur'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Tambah Hari Libur";
        $isEdit = false;
        $shift = TipeShift::all();
        return view('pages.harilibur.create_edit', compact('page', 'isEdit', 'shift'));
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
        HariLibur::create($request->all());
        return redirect('harilibur')->with('success','Berhasil Menambah Data Hari libur');
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
        $page = "Edit Hari Libur";
        $isEdit = true;
        $shift = TipeShift::all();
        $hariLibur = HariLibur::find($id);
        return view('pages.harilibur.create_edit', compact('page', 'isEdit', 'shift', 'hariLibur'));
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
        $hariLibur = HariLibur::find($id);
        $hariLibur->tanggal_libur = $request->tanggal_libur;
        $hariLibur->shift_id = $request->shift_id;
        $hariLibur->keterangan = $request->keterangan;
        $hariLibur->save();
        return redirect('harilibur')->with('success','Berhasil Mengubah Data Hari libur');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hariLibur = HariLibur::find($id);
        $hariLibur->destroy();
        return redirect('harilibur')->with('success','Berhasil Mengubah Data Hari libur');
    }
}
