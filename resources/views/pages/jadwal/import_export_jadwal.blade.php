@extends('layouts.main')
@section('title','Halaman Kelola Jadwal')
@section('content')
<div class="page-heading">
    <h1 class="page-title">Kelola Jadwal Pegawai</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Kelola Jadwal Pegawai</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-head">
        <div class="ibox-title">Data Pegawai</div>
    </div>
    <div class="ibox-body">

        @if(Session::has('success'))
        <div class="alert alert-dismissible fade show alert-success" role="alert">
            {{ Session::get("success") }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif
        <!-- Button trigger modal -->
        <div class="row justify-content-between">
            <div class="col-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    Import File Jadwal
                </button>
            </div>
            <div class="col-6">
                <form action="{{ url('export_jadwal') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="hidden" name="id_ruangan" value="{{ Request::segment(2) }}" />
                        <input type="month" name="month" id="month" class="form-control" />
                        <div class="input-group-append">
                            <button class="btn btn-info" type="submit" id="basic-addon2">Download Format
                                Export</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="tableDataMaster">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pegawai</th>
                    <th>Tanggal</th>
                    <th>Shift</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Import Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ url('import_jadwal') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file mb-2">
                                <input type="file" name="jadwalImport" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
var tabelEquipment = $("#tableDataMaster").DataTable({
    ajax: '{{ url("fetch_jadwal/".Request::segment(2)) }}',
    buttons: [

        'copy', 'csv'
    ],
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
            data: "nama_pegawai"
        },
        {
            data: "tanggal"
        },
        {
            data: "nama_shift"
        },
        {
            data: "jam_masuk"
        },
        {
            data: "jam_pulang"
        },
    ]
});
</script>
@endpush