<table>
    <thead>
        <tr>
            <th>tanggal</th>
            <th>bulan</th>
            <th>tahun</th>
            <th>ruangan_code</th>
            <th>nama ruangan</th>
            <th>pegawai_code</th>
            <th>nama pegawai</th>
            <th>shift</th>
        </tr>
    </thead>
    <tbody>
    @php 
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    @endphp
    @for($i = 1; $i <= $jumlahHari; $i++)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $bulan }}</td>
            <td>{{ $tahun }}</td>
            <td>{{ $ruangan->id }}</td>
            <td>{{ $ruangan->nama_ruangan }}</td>
            <td>{{ $pegawai->code }}</td>
            <td>{{ $pegawai->nama_pegawai }}</td>
            <td></td>
        </tr>
    @endfor
    </tbody>
</table>