@extends('layouts.main')
@section('title','Halaman Riwayat Pengajuan Cuti / Izin {{ $pegawai->nama }}')
@section('content')
<div class="page-heading">
    <h1 class="page-title">Halaman Riwayat Pengajuan Cuti / Izin {{ $pegawai->nama }}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Halaman Riwayat Pengajuan Cuti / Izin {{ $pegawai->nama }}</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-head">
        <div class="ibox-title">Riwayat Pengajuan Cuti / Izin {{ $pegawai->nama }}</div>
    </div>
    <div class="ibox-body">
        <table class="table table-bordered table-striped" id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Jenis Izin / Cuti</th>
                    <th>Keterangan</th>
                    <th>Dokumen Pendukung</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($izins as $row)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $row->tanggalMulaiIzin }}</td>
                    <td>{{ $row->tanggalAkhirIzin }}</td>
                    <td>{{ $row->namaIzin }}</td>
                    <td>{{ $row->keteranganIzin }}</td>
                    <td><a href="{{ asset('files/izin/'.$row->dokumenPendukung) }}">Lihat Dokumen</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
$("#datatable").DataTable();
</script>
@endpush