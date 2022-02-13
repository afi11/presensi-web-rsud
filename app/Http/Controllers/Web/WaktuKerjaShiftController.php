<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WaktuKerjaShift;
use App\Models\DetailWaktuKerjaShift;

class WaktuKerjaShiftController extends Controller
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
                'namaProfile' => 'required',
            ],
            [
                'namaProfile.required' => 'Nama profil harus diisi',
            ]
        );
        return $validate_data;
    }

    public function index()
    {
        $jamKerja = WaktuKerjaShift::all();
        return view('pages.jam_kerja_shift.index', compact('jamKerja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "Tambah Nama Jam Kerja";
        $isEdit = false;
        return view('pages.jam_kerja_shift.create_edit', compact('page', 'isEdit'));
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
        $kodeJamKerja = getKodeJamKerja();
        WaktuKerjaShift::create($request->except(['kodeJamKerja'])+['kodeJamKerja' => $kodeJamKerja]);
        DetailWaktuKerjaShift::create([
            'kodeJamKerja' => $kodeJamKerja,
            'shift' => 'PAGI'
        ]);
        DetailWaktuKerjaShift::create([
            'kodeJamKerja' => $kodeJamKerja,
            'shift' => 'SIANG'
        ]);
        DetailWaktuKerjaShift::create([
            'kodeJamKerja' => $kodeJamKerja,
            'shift' => 'MALAM'
        ]);
        return redirect('jam_kerja_shift')->with('success','Berhasil Menambah Data Jam Kerja');
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
        $jamKerja = WaktuKerjaShift::find($id);
        return view('pages.jam_kerja_shift.create_edit', compact('page', 'isEdit', 'jamKerja'));
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
        $jamKerja = WaktuKerjaShift::find($id);
        $jamKerja->namaProfile = $request->namaProfile;
        $jamKerja->save();
        return redirect('jam_kerja_shift')->with('success','Berhasil Mengubah Data Nam Jam Kerja');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jamkerja = WaktuKerjaShift::find($id);
        $jamkerja->delete();
        return redirect('jam_kerja_shift')->with('success','Berhasil Menghapus Data Jam Kerja');
    }

    public function createJamKerja($kode)
    {
        $jamKerja = WaktuKerjaShift::where('kodeJamKerja',$kode)->first();
        $detailJamKerja = DetailWaktuKerjaShift::where('kodeJamKerja', $kode)->get();
        $page = "Tambah Jam Kerja Pegawai";
        return view('pages.jam_kerja_shift.create_jam_kerja', compact('page', 'jamKerja', 'detailJamKerja'));
    }

    public function storeJamKerja(Request $request, $id)
    {
        $detailJamKerja = DetailWaktuKerjaShift::find($id);
        $detailJamKerja->shift = $request->shift;
        $detailJamKerja->jam_mulai_masuk = $request->jam_mulai_masuk;
        $detailJamKerja->jam_akhir_masuk = $request->jam_akhir_masuk;
        $detailJamKerja->jam_awal_pulang = $request->jam_awal_pulang;
        $detailJamKerja->jam_akhir_pulang = $request->jam_akhir_pulang;
        $detailJamKerja->is_active = $request->is_active;
        $detailJamKerja->save();
        return redirect()->back()->with('success','Berhasil Menambahkan Data Jam Kerja Shift');
    }
}
