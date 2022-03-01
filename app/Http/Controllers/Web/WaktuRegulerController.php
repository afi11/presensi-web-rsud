<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaktuReguler;

class WaktuRegulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waktuReguler = WaktuReguler::all();
        return view('pages.waktu_reguler.index', compact('waktuReguler'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Tambah Jam Kerja Reguler";
        $isEdit = false;
        return view('pages.waktu_reguler.create_edit', compact('isEdit', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        for($i = 0; $i < count($input['hariKerja']); $i++){
            WaktuReguler::create([
                'hariKerja' => $input['hariKerja'][$i],
                'jam_mulai_masuk' => $request->jam_mulai_masuk,
                'jam_akhir_masuk' => $request->jam_akhir_masuk,
                'jam_awal_pulang' => $request->jam_awal_pulang,
                'jam_akhir_pulang' => $request->jam_akhir_pulang,
            ]);
        }
        return redirect('waktu_reguler')->with('success','Berhasil Menambahkan Data Jam Kerja Reguler');
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
        $waktuReguler = WaktuReguler::find($id);
        $page = "Edit Jam Kerja Reguler";
        $isEdit = true;
        return view('pages.waktu_reguler.create_edit', compact('waktuReguler', 'isEdit', 'page'));
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
        $waktuReguler = WaktuReguler::find($id);
        $waktuReguler->hariKerja = $request->hariKerja;
        $waktuReguler->jam_mulai_masuk = $request->jam_mulai_masuk;
        $waktuReguler->jam_akhir_masuk = $request->jam_akhir_masuk;
        $waktuReguler->jam_awal_pulang = $request->jam_awal_pulang;
        $waktuReguler->jam_akhir_pulang = $request->jam_akhir_pulang;
        $waktuReguler->save();
        return redirect('waktu_reguler')->with('success','Berhasil Mengubah Data Jam Kerja Reguler');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $waktuReguler = WaktuReguler::find($id);
        $waktuReguler->delete();
        return redirect()->back()->with('success','Berhasil Menghapus Data Jam Kerja Reguler');
    }
}
