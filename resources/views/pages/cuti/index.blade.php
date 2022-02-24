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
        <div class="ibox-title">Daftar Ruangan</div>
    </div>
    <div class="ibox-body">
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($listRuangan as $row)
                @php $no++; @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $row->namaDivisi }}</td>
                    <td>
                        <a href="{{ route('pengajuan_cuti.show', $row->id) }}"
                            class="btn btn-primary btn-sm mb-3 text-white"><span class="fa fa-user"></span> Daftar Pegawai</a>
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