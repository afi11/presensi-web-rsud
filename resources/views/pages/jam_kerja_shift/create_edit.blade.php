@extends('layouts.main')
@section('title', $page)
@section('content')
<div class="page-heading">
    <h1 class="page-title">@if($isEdit) Edit @else Tambah @endif Waktu Shift Pegawai</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Tambah Waktu Shift Pegawai</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-body">
        @if($isEdit)
            @php $url = route('jam_kerja_shift.update', $jamKerja->id) @endphp
        @else
            @php $url = route('jam_kerja_shift.store') @endphp
        @endif
        <form method="POST" action="{{ $url }}">
            @if($isEdit)
                {{ method_field('put') }}
            @endif
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Jam Kerja</label>
                        <input class="form-control @error('namaProfile') is-invalid @enderror" name="namaProfile"
                            type="text" placeholder="Contoh: PAGI-REGULER/SHIFT 1"
                            @if($isEdit) value="{{ $jamKerja->namaProfile }}" @endif />
                        @error('namaProfile')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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