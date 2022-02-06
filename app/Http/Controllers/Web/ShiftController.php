<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TipeShift;

class ShiftController extends Controller
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
                'nama_shift' => 'required',
                'jam_masuk' => 'required',
                'jam_pulang' => 'required',
            ],
            [
                'nama_shift.required' => 'Nama shift harus diisi',
                'jam_masuk.required' => 'Jam masuk harus diisi',
                'jam_pulang.required' => 'Jam pulang harus diisi',
            ]
        );
        return $validate_data;
    }

    public function index()
    {
        $shift = TipeShift::all();
        return view('pages.shift.index', compact('shift'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Tambah Shift Pegawai";
        $isEdit = false;
        return view('pages.shift.create_edit', compact('page', 'isEdit'));
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
        TipeShift::create($request->all());
        return redirect('shift')->with('success','Berhasil Menambah Data Shift');
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
        $page = "Edit Shift Pegawai";
        $isEdit = true;
        $shift = TipeShift::find($id);
        return view('pages.shift.create_edit', compact('page', 'isEdit', 'shift'));
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
        $shift = TipeShift::find($id);
        $shift->nama_shift = $request->nama_shift;
        $shift->jam_masuk = $request->jam_masuk;
        $shift->jam_pulang = $request->jam_pulang;
        $shift->save();
        return redirect('shift')->with('success','Berhasil Mengubah Data Shift');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift = TipeShift::find($id);
        $shift->delete();
        return redirect('shift')->with('success','Berhasil Menghapus Data Shift');
    }
}
