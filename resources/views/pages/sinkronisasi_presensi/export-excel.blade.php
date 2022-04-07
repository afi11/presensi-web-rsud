<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Pegawai</th>
            <th>Presentase Kehadiran</th>
            <th>Kehadiran</th>
            <th>Ketidakhadiran</th>
            <th>Jumlah Hari Kerja</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>11</th>
            <th>12</th>
            <th>13</th>
            <th>14</th>
            <th>15</th>
            <th>16</th>
            <th>17</th>
            <th>18</th>
            <th>19</th>
            <th>20</th>
            <th>21</th>
            <th>22</th>
            <th>23</th>
            <th>24</th>
            <th>25</th>
            <th>26</th>
            <th>27</th>
            <th>28</th>
            <th>29</th>
            <th>30</th>
            <th>31</th>
            <th>TL-1</th>
            <th>TL-2</th>
            <th>TL-3</th>
            <th>TL-4</th>
            <th>PSW-1</th>
            <th>PSW-2</th>
            <th>PSW-3</th>
            <th>PSW-4</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 0; @endphp
        @foreach($logPresensi as $row)
        @php $no++; @endphp
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $row->pegawaiCode }}</td>
            <td>{{ getPegawaiName($row->pegawaiCode) }}</td>
            <td>{{ round(cekStatistikPresensi($row->pegawaiCode, $bulan, $tahun, 'presentase_kehadiran'), 2) }}</td>
            <td>{{ cekStatistikPresensi($row->pegawaiCode, $bulan, $tahun, 'masuk_kerja') }}</td>
            <td>{{ cekStatistikPresensi($row->pegawaiCode, $bulan, $tahun, 'tidak_masuk_kerja') }}</td>
            <td>{{ cekStatistikPresensi($row->pegawaiCode, $bulan, $tahun, 'jumlah_kerja') }}</td>
            <td>{{ getJamMasukExcel($row->tgl_01) }}
                <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_01) }}
                <br style="mso-data-placement:same-cell;" />
                {{ $row->hasil_tgl_01 }}
            </td>
            <td> {{ getJamMasukExcel($row->tgl_02) }}
                <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_02) }}
                <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_02 }}
            </td>
            <td> {{ getJamMasukExcel($row->tgl_03) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_03) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_03 }}</td>
            <td> {{ getJamMasukExcel($row->tgl_04) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_04) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_04 }}</td>
            <td> {{ getJamMasukExcel($row->tgl_05) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_05) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_05 }}</td>
            <td> {{ getJamMasukExcel($row->tgl_06) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_06) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_06 }}</td>
            <td> {{ getJamMasukExcel($row->tgl_07) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_07) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_07 }}</td>
            <td> {{ getJamMasukExcel($row->tgl_08) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_08) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_08 }}</td>
            <td> {{ getJamMasukExcel($row->tgl_09) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_09) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_09 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_10) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_10) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_10 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_11) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_11) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_11 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_12) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_12) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_12 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_13) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_13) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_13 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_14) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_14) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_14 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_15) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_15) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_15 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_16) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_16) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_16 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_17) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_17) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_17 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_18) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_18) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_18 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_19) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_19) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_19 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_20) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_20) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_20 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_21) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_21) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_21 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_22) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_22) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_22 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_23) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_23) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_23 }}</td>
            <td> {{ getJamMasukExcel($row->tgl_24) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_24) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_24 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_25) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_25) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_25 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_26) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_26) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_26 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_27) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_27) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_27 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_28) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_28) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_28 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_29) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_29) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_29 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_30) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_30) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_30 }}</td>
            <td> {{  getJamMasukExcel($row->tgl_31) }} <br style="mso-data-placement:same-cell;" />
                {{ getJamPulangExcel($row->tgl_31) }} <br style="mso-data-placement:same-cell;" />
                {{$row->hasil_tgl_31 }}</td>
            <td>{{ sumTelatTLPSW($ruangan->id, $row->pegawaiCode, $bulan, "jam-masuk", 1) }}</td>
            <td>{{ sumTelatTLPSW($ruangan->id, $row->pegawaiCode, $bulan, "jam-masuk", 2) }}</td>
            <td>{{ sumTelatTLPSW($ruangan->id, $row->pegawaiCode, $bulan, "jam-masuk", 3) }}</td>
            <td>{{ sumTelatTLPSW($ruangan->id, $row->pegawaiCode, $bulan, "jam-masuk", 4) }}</td>
            <td>{{ sumTelatTLPSW($ruangan->id, $row->pegawaiCode, $bulan, "jam-pulang", 5) }}</td>
            <td>{{ sumTelatTLPSW($ruangan->id, $row->pegawaiCode, $bulan, "jam-pulang", 6) }}</td>
            <td>{{ sumTelatTLPSW($ruangan->id, $row->pegawaiCode, $bulan, "jam-pulang", 7) }}</td>
            <td>{{ sumTelatTLPSW($ruangan->id, $row->pegawaiCode, $bulan, "jam-pulang", 8) }}</td>
            <td> {{ $row->keterangan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>