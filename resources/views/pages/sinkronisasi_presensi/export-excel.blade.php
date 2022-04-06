<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Pegawai</th>
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
            <th>Telat Masuk</th>
            <th>Telat Pulang</th>
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
            <td>{{ getJamMasukPulangExcel($row->tgl_1) }} <br style="mso-data-placement:same-cell;"/> {{ $row->hasil_tgl_01 }}</td>
            <td> {{ getJamMasukPulangExcel($row->tgl_2) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_02 }}</td>
            <td> {{ getJamMasukPulangExcel($row->tgl_3) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_03 }}</td>
            <td> {{ getJamMasukPulangExcel($row->tgl_4) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_04 }}</td>
            <td> {{ getJamMasukPulangExcel($row->tgl_5) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_05 }}</td>
            <td> {{ getJamMasukPulangExcel($row->tgl_6) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_06 }}</td>
            <td> {{ getJamMasukPulangExcel($row->tgl_7) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_07 }}</td>
            <td> {{ getJamMasukPulangExcel($row->tgl_8) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_08 }}</td>
            <td> {{ getJamMasukPulangExcel($row->tgl_9) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_09 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_10) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_10 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_11) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_11 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_12) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_12 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_13) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_13 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_14) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_14 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_15) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_15 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_16) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_16 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_17) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_17 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_18) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_18 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_19) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_19 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_20) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_20 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_21) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_21 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_22) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_22 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_23) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_23 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_24) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_24 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_25) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_25 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_26) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_26 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_27) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_27 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_28) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_28 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_29) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_29 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_30) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_30 }}</td>
            <td> {{  getJamMasukPulangExcel($row->tgl_31) }} <br style="mso-data-placement:same-cell;"/> {{$row->hasil_tgl_31 }}</td>
            <td> {{ sumTelatMasuk($ruangan->id, $row->pegawaiCode, $bulan) }}</td>
            <td> {{ sumLewatPulang($ruangan->id, $row->pegawaiCode, $bulan) }}</td>
            <td> {{ $row->keterangan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>