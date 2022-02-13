@extends('layouts.main')
@section('title', $page)
@section('content')
<div class="page-heading">
    <h1 class="page-title">@if($isEdit) Edit @else Tambah @endif Rule Telat</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">@if($isEdit) Edit @else Tambah @endif Rule Telat</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-body">
        @if($isEdit)
            @php $url = route('ruletelat.update', $ruleTelat->id) @endphp
        @else
            @php $url = route('ruletelat.store') @endphp
        @endif
        <form method="POST" action="{{ $url }}">
            @if($isEdit)
                {{ method_field('put') }}
            @endif
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Rule Telat</label>
                        <input class="form-control @error('namaRuleTelat') is-invalid @enderror" name="namaRuleTelat"
                            type="text" @if($isEdit) value="{{ $ruleTelat->namaRuleTelat }}" @endif />
                        @error('namaRuleTelat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Maksimal Telat Jam Masuk</label>
                        <input class="form-control @error('maxTelatMasuk') is-invalid @enderror" name="maxTelatMasuk"
                            type="number" placeholder="Satuan menit"
                            @if($isEdit) value="{{ $ruleTelat->maxTelatMasuk }}" @endif />
                        @error('maxTelatMasuk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Maksimal Telat Jam Pulang</label>
                        <input class="form-control @error('maxTelatPulang') is-invalid @enderror" name="maxTelatPulang"
                            type="number" placeholder="Satuan menit"
                            @if($isEdit) value="{{ $ruleTelat->maxTelatPulang }}" @endif />
                        @error('maxTelatPulang')
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