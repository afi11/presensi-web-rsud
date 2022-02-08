@extends('layouts.main')
@section('title', $page)
@section('content')
<div class="page-heading">
    <h1 class="page-title">@if($isEdit) Edit @else Tambah @endif Hari Libur</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">@if($isEdit) Edit @else Tambah @endif Hari Libur</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-body">
        @if($isEdit)
            @php $url = route('harilibur.update', $hariLibur->id) @endphp
        @else
            @php $url = route('harilibur.store') @endphp
        @endif
        <form method="POST" action="{{ $url }}">
            @if($isEdit)
                {{ method_field('put') }}
            @endif
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Hari Libur</label>
                        <input class="form-control @error('tanggal_libur') is-invalid @enderror" 
                            name="tanggal_libur" type="date" 
                            @if($isEdit) value="{{ $hariLibur->tanggal_libur }}" @endif />
                        @error('tanggal_libur')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Shift</label>
                        <select class="custom-select" name="shift_id">
                            <option value="">Pilih salah satu</option>
                            @foreach($shift as $row)
                                <option value="{{ $row->id }}" 
                                @if($isEdit) 
                                    @if($row->id == $hariLibur->shift_id)
                                        selected
                                    @endif
                                @endif>{{ $row->nama_shift }}</option>
                            @endforeach
                        </select>
                        @error('shift_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control  @error('keterangan') is-invalid @enderror" name="keterangan">
                            @if($isEdit) {{ $hariLibur->keterangan }} @endif
                        </textarea>
                        @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success text-white pointer">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-primary text-white pointer">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection