@extends('layouts.main')
@section('title','Halaman Kelola Rule Telat')
@section('content')
<div class="page-heading">
    <h1 class="page-title">Kelola Rule Telat</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Kelola Rule Telat</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-head">
        <div class="ibox-title">Data Rule Telat</div>
    </div>
    <div class="ibox-body">
        <a href="{{ route('ruletelat.create') }}" class="btn btn-success mb-3 text-white"><span class="fa fa-plus"></span>
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
                    <th>Nama Rule</th>
                    <th>Mak. Telat Jam Masuk</th>
                    <th>Mak. Telat Jam Pulang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach($ruleTelat as $row)
                @php $no++; @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $row->namaRuleTelat }}</td>
                    <td>{{ $row->maxTelatMasuk }}</td>
                    <td>{{ $row->maxTelatPulang }}</td>
                    <td>
                        <a href="{{ route('ruletelat.edit', $row->id) }}"
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
                                Apakah rule telat {{ $row->namaRuleTelat }} akan dihapus ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-pill"
                                    data-dismiss="modal">Tidak</button>
                                <form action="{{ route('ruletelat.destroy', $row->id) }}" method="post">
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