<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Presensi;

class PresensiController extends Controller
{
    
    public function fetchTime(Request $request)
    {
        $sudahPresensiMasuk = cekPresensiMasuk($request->pegawaiCode, $request->currentDate);
        $sudahPresensiPulang = cekPresensiPulang($request->pegawaiCode, $request->currentDate);
        $jadwal = Jadwal::join('tipe_shift', 'tipe_shift.id', '=', 'jadwal.shift_jadwal_id')
            ->where('jadwal.pegawai_code', $request->pegawaiCode)
            ->where('jadwal.tanggal', $request->currentDate)
            ->select('tipe_shift.nama_shift', 'tipe_shift.jam_masuk', 'tipe_shift.jam_pulang',
                    'jadwal.*')
            ->first();
        return response()->json([
            "code" => 200, 
            "presensiMasuk" => $sudahPresensiMasuk,
            "presensiPulang" => $sudahPresensiPulang,
            "data" => $jadwal
        ]);
    }

}
