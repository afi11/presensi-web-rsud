@extends('layouts.main')
@section('title', $page)
@section('content')
<div class="page-heading">
    <h1 class="page-title">@if($isEdit) Edit @else Tambah @endif Divisi</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">@if($isEdit) Edit @else Tambah @endif Divisi</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-body">
        @if($isEdit)
        @php $url = route('ruangan.update', $ruangan->id) @endphp
        @else
        @php $url = route('ruangan.store') @endphp
        @endif
        <form method="POST" action="{{ $url }}">
            @if($isEdit)
            {{ method_field('put') }}
            @endif
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Divisi<span class="text-danger"> * </span></label>
                        <input class="form-control @error('namaDivisi') is-invalid @enderror" name="namaDivisi"
                            type="text" placeholder="Contoh: Kertajaya/Perencanaan/Keuangan" @if($isEdit)
                            value="{{ $ruangan->namaDivisi }}" @endif />
                        @error('namaDivisi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Keterangan Divisi</label>
                        <input class="form-control" name="keteranganDivisi"
                            type="text" placeholder=".." @if($isEdit)
                            value="{{ $ruangan->keteranganDivisi }}" @endif />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-success text-white pointer">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-primary text-white pointer">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection