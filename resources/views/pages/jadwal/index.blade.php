@extends('layouts.main')
@section('title','Halaman Kelola Jadwal')
@section('content')
<div class="page-heading">
    <h1 class="page-title">Kelola Jadwal Pegawai</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Daftar Ruangan</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-head">
        <div class="ibox-title">Daftar Ruangan</div>
    </div>
    <div class="ibox-body">
        <table class="table table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($ruangan as $row)
                @php $no++; @endphp
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $row->nama_ruangan }}</td>
                        <td>
                            <a href="{{ url('import_jadwal/'.$row->id) }}" class="btn btn-primary">Kelola Jadwal</a>
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