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
                        <label>Tanggal Mulai Hari Libur</label>
                        <input class="form-control @error('tanggalMulaiLibur') is-invalid @enderror" 
                            name="tanggalMulaiLibur" type="date" 
                            @if($isEdit) value="{{ $hariLibur->tanggalMulaiLibur }}" @endif />
                        @error('tanggalMulaiLibur')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Selesai Hari Libur</label>
                        <input class="form-control @error('tanggalSelesaiLibur') is-invalid @enderror" 
                            name="tanggalSelesaiLibur" type="date" 
                            @if($isEdit) value="{{ $hariLibur->tanggalSelesaiLibur }}" @endif />
                        @error('tanggalSelesaiLibur')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Gender</label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" value="reguler" name="forlibur"
                                    class="custom-control-input" @if($isEdit) @if($hariLibur->forlibur == "reguler")
                                checked
                                @endif
                                @endif>
                                <label class="custom-control-label" for="customRadioInline1">Reguler</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" value="shift" name="forlibur"
                                    class="custom-control-input" @if($isEdit) @if($hariLibur->forlibur == "shift")
                                checked
                                @endif
                                @endif>
                                <label class="custom-control-label" for="customRadioInline2">Shift</label>
                            </div>
                        </div>
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
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-success text-white pointer">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-primary text-white pointer">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection