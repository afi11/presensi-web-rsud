<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\PresensiCroscheck;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PresensiCroscheckImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    private $bulan;
    private $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan; 
        $this->tahun = $tahun; 
    }

    public function collection(Collection $collection)
    {
        $results = array();
        foreach ($rows as $row) 
        {
            $lamaHari = hitungJumlahHari($this->bulan, $this->tahun);
            if($lamaHari == 31){
                array_push($results, [
                    "pegawaiCode" => $row["KODE PEGAWAI"],
                    "tgl_01" => $row["1"],
                    "tgl_02" => $row["2"],
                    "tgl_03" => $row["3"],
                    "tgl_04" => $row["4"],
                    "tgl_05" => $row["5"],
                    "tgl_06" => $row["6"],
                    "tgl_07" => $row["7"],
                    "tgl_08" => $row["8"],
                    "tgl_09" => $row["9"],
                    "tgl_11" => $row["10"],
                    "tgl_12" => $row["12"],
                    "tgl_13" => $row["13"],
                    "tgl_14" => $row["14"],
                    "tgl_15" => $row["15"],
                    "tgl_16" => $row["16"],
                    "tgl_17" => $row["17"],
                    "tgl_18" => $row["18"],
                    "tgl_19" => $row["19"],
                    "tgl_20" => $row["20"],
                    "tgl_21" => $row["21"],
                    "tgl_22" => $row["22"],
                    "tgl_23" => $row["23"],
                    "tgl_24" => $row["24"],
                    "tgl_25" => $row["25"],
                    "tgl_26" => $row["26"],
                    "tgl_27" => $row["27"],
                    "tgl_28" => $row["28"],
                    "tgl_29" => $row["29"],
                    "tgl_30" => $row["30"],
                    "tgl_31" => $row["31"],
                ]);
            }
            else if($lamaHari == 30){
                array_push($results, [
                    "pegawaiCode" => $row["KODE PEGAWAI"],
                    "tgl_01" => $row["1"],
                    "tgl_02" => $row["2"],
                    "tgl_03" => $row["3"],
                    "tgl_04" => $row["4"],
                    "tgl_05" => $row["5"],
                    "tgl_06" => $row["6"],
                    "tgl_07" => $row["7"],
                    "tgl_08" => $row["8"],
                    "tgl_09" => $row["9"],
                    "tgl_11" => $row["10"],
                    "tgl_12" => $row["12"],
                    "tgl_13" => $row["13"],
                    "tgl_14" => $row["14"],
                    "tgl_15" => $row["15"],
                    "tgl_16" => $row["16"],
                    "tgl_17" => $row["17"],
                    "tgl_18" => $row["18"],
                    "tgl_19" => $row["19"],
                    "tgl_20" => $row["20"],
                    "tgl_21" => $row["21"],
                    "tgl_22" => $row["22"],
                    "tgl_23" => $row["23"],
                    "tgl_24" => $row["24"],
                    "tgl_25" => $row["25"],
                    "tgl_26" => $row["26"],
                    "tgl_27" => $row["27"],
                    "tgl_28" => $row["28"],
                    "tgl_29" => $row["29"],
                    "tgl_30" => $row["30"],
                ]);
            }else if($lamaHari == 29){
                array_push($results, [
                    "pegawaiCode" => $row["KODE PEGAWAI"],
                    "tgl_01" => $row["1"],
                    "tgl_02" => $row["2"],
                    "tgl_03" => $row["3"],
                    "tgl_04" => $row["4"],
                    "tgl_05" => $row["5"],
                    "tgl_06" => $row["6"],
                    "tgl_07" => $row["7"],
                    "tgl_08" => $row["8"],
                    "tgl_09" => $row["9"],
                    "tgl_11" => $row["10"],
                    "tgl_12" => $row["12"],
                    "tgl_13" => $row["13"],
                    "tgl_14" => $row["14"],
                    "tgl_15" => $row["15"],
                    "tgl_16" => $row["16"],
                    "tgl_17" => $row["17"],
                    "tgl_18" => $row["18"],
                    "tgl_19" => $row["19"],
                    "tgl_20" => $row["20"],
                    "tgl_21" => $row["21"],
                    "tgl_22" => $row["22"],
                    "tgl_23" => $row["23"],
                    "tgl_24" => $row["24"],
                    "tgl_25" => $row["25"],
                    "tgl_26" => $row["26"],
                    "tgl_27" => $row["27"],
                    "tgl_28" => $row["28"],
                ]);
            }else{
                array_push($results, [
                    "pegawaiCode" => $row["KODE PEGAWAI"],
                    "tgl_01" => $row["1"],
                    "tgl_02" => $row["2"],
                    "tgl_03" => $row["3"],
                    "tgl_04" => $row["4"],
                    "tgl_05" => $row["5"],
                    "tgl_06" => $row["6"],
                    "tgl_07" => $row["7"],
                    "tgl_08" => $row["8"],
                    "tgl_09" => $row["9"],
                    "tgl_11" => $row["10"],
                    "tgl_12" => $row["12"],
                    "tgl_13" => $row["13"],
                    "tgl_14" => $row["14"],
                    "tgl_15" => $row["15"],
                    "tgl_16" => $row["16"],
                    "tgl_17" => $row["17"],
                    "tgl_18" => $row["18"],
                    "tgl_19" => $row["19"],
                    "tgl_20" => $row["20"],
                    "tgl_21" => $row["21"],
                    "tgl_22" => $row["22"],
                    "tgl_23" => $row["23"],
                    "tgl_24" => $row["24"],
                    "tgl_25" => $row["25"],
                    "tgl_26" => $row["26"],
                    "tgl_27" => $row["27"],
                    "tgl_28" => $row["28"],
                ]);
            }
        }
        return $results;
    }
}
