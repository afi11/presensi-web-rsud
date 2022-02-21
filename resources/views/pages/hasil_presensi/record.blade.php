@extends('layouts.main')
@section('title','Halaman Riwayat Presensi')
@section('content')
<div class="page-heading">
    <h1 class="page-title">Halaman Riwayat Presensi</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Halaman Riwayat Presensi</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-head">
        <div class="ibox-title">Riwayat Presensi</div>
    </div>
    <div class="ibox-body">
        <table class="table table-bordered table-striped" id="tableDataMaster">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jam Masuk</th>
                    <th>Telat Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Telat Pulang</th>
                    <th>Status Jam Masuk</th>
                    <th>Status Jam Pulang</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection
@push('scripts')
<script>
var tabelEquipment = $("#tableDataMaster").DataTable({
    ajax: '{{ url("fetch_record_presensi/".Request::segment(2)) }}',

    order: [
        [0, "asc"]
    ],
    columns: [{
            data: "id",
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: "tanggalPresensi"
        },
        {
            data: "jamMasuk"
        },
        {
            data: "telatMasuk"
        },
        {
            data: "jamPulang"
        },
        {
            data: "lewatPulang"
        },
        {
            data: "statusTelatMasuk"
        },
        {
            data: "statusTelatMasuk"
        },
    ]
});
</script>
@endpush