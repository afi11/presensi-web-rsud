@extends('layouts.main')
@section('title', $page)
@section('content')
<div class="page-heading">
    <h1 class="page-title">@if($isEdit) Edit @else Tambah @endif Tipe Shift Pegawai</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Tambah Tipe Shift Pegawai</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-body">
        @if($isEdit)
            @php $url = route('shift.update', $shift->id) @endphp
        @else
            @php $url = route('shift.store') @endphp
        @endif
        <form method="POST" action="{{ $url }}">
            @if($isEdit)
                {{ method_field('put') }}
            @endif
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Kode Shift</label>
                        <input class="form-control @error('kode_shift') is-invalid @enderror" name="kode_shift"
                            type="text" placeholder="Contoh: PAGI-CM/PAGI-GIZI"
                            @if($isEdit) value="{{ $shift->kode_shift }}" @endif />
                        @error('kode_shift')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Shift</label>
                        <input class="form-control @error('nama_shift') is-invalid @enderror" name="nama_shift"
                            type="text" placeholder="Contoh: Pagi/Siang/Malam"
                            @if($isEdit) value="{{ $shift->nama_shift }}" @endif />
                        @error('nama_shift')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jam Masuk</label>
                        <input class="form-control  @error('jam_masuk') is-invalid @enderror" name="jam_masuk"
                            type="time"  @if($isEdit) value="{{ $shift->jam_masuk }}" @endif  />
                        @error('jam_masuk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jam Pulang</label>
                        <input class="form-control  @error('jam_pulang') is-invalid @enderror" name="jam_pulang"
                            type="time"  @if($isEdit) value="{{ $shift->jam_pulang }}" @endif />
                        @error('jam_pulang')
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