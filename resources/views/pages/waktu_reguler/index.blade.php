@extends('layouts.main')
@section('title','Halaman Kelola Waktu Reguler')
@section('content')
<div class="page-heading">
    <h1 class="page-title">Kelola Waktu Reguler</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Kelola Waktu Reguler</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-head">
        <div class="ibox-title">Data Waktu Reguler</div>
    </div>
    <div class="ibox-body">
        <a href="{{ route('waktu_reguler.create') }}" class="btn btn-success mb-3 text-white"><span class="fa fa-plus"></span>
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
                    <th>Hari Kerja</th>
                    <th>Jam Mulai Masuk</th>
                    <th>Jam Akhir Masuk</th>
                    <th>Jam Mulai Pulang</th>
                    <th>Jam Akhir Pulang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($waktuReguler as $row)
                @php $no++; @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $row->hariKerja }}</td>
                    <td>{{ $row->jam_mulai_masuk }}</td>
                    <td>{{ $row->jam_akhir_masuk }}</td>
                    <td>{{ $row->jam_awal_pulang }}</td>
                    <td>{{ $row->jam_akhir_pulang }}</td>
                    <td>
                        <a href="{{ route('waktu_reguler.edit', $row->id) }}"
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
                                Apakah hari kerja reguler {{ $row->hariKerja }} akan dihapus ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-pill"
                                    data-dismiss="modal">Tidak</button>
                                <form action="{{ route('waktu_reguler.destroy', $row->id) }}" method="post">
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