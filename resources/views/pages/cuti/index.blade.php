@extends('layouts.main')
@section('title','Riwayat Pengajuan Izin / Cuti')
@section('content')
<div class="page-heading">
    <h1 class="page-title">Riwayat Pengajuan Izin / Cuti</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Riwayat Pengajuan Izin / Cuti</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-head">
        <div class="ibox-title">Daftar Pengajuan</div>
    </div>
    <div class="ibox-body">
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pegawai</th>
                    <th>Pegawai</th>
                    <th>Izin / Cuti</th>
                    <th>Tanggal Izin</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($izins as $row)
                @php $no++; @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $row->pegawaiCode }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->namaIzin }}</td>
                    <td>{{ $row->tanggalMulaiIzin }} - {{ $row->tanggalAkhirIzin }}</td>
                    <td>
                        @if($row->statusIzin == 0)
                            <span class="text-warning">Pending</span>
                        @elseif($row->statusIzin == 1)
                            <span class="text-success">Diterima</span>
                        @else
                            <span class="text-danger">Ditolak</span>
                        @endif
                    <td>
                        <a href="{{ route('pengajuan_cuti.show', $row->activityCode) }}"
                            class="btn btn-primary btn-sm mb-3 text-white">Detail</a>
                    </td>
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