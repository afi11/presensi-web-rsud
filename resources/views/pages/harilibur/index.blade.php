@extends('layouts.main')
@section('title','Halaman Kelola Shift')
@section('content')
<div class="page-heading">
    <h1 class="page-title">Kelola Hari Libur</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Kelola Hari Libur</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-head">
        <div class="ibox-title">Data Hari Libur</div>
    </div>
    <div class="ibox-body">
        <a href="{{ route('harilibur.create') }}" class="btn btn-success mb-3 text-white"><span class="fa fa-plus"></span>
            Tambah Data</a>
        @if(Session::has('success'))
        <div class="alert alert-dismissible fade show alert-success" role="alert">
            {{ Session::get("success") }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif
        <table class="table table-striped" id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Libur</th>
                    <th>Divisi</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($hariLibur as $row)
                @php $no++; @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $row->tanggal_libur }}</td>
                    <td>{{ $row->namaDivisi != "" ? $row->namaDivisi : "Semua" }}</td>
                    <td>{{ $row->keterangan }}</td>
                    <td>
                        <a href="{{ route('harilibur.edit', $row->id) }}"
                            class="btn btn-primary btn-sm mb-3 text-white"><span class="fa fa-edit"></span> Edit</a>
                        <button data-toggle="modal" data-target="#exampleModal{{ $row->id }}" 
                            class="btn btn-danger btn-sm mb-3 text-white pointer"><span class="fa fa-trash"></span> Hapus</button>
                    </td>
                </tr>

                <div class="modal fade" id="exampleModal{{ $row->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah hari libur pada tanggal {{ $row->hari_libur }} akan dihapus ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-pill"
                                    data-dismiss="modal">Tidak</button>
                                <form action="{{ route('harilibur.destroy', $row->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary btn-pill">Ya</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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