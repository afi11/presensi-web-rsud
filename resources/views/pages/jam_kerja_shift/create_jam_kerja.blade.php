@extends('layouts.main')
@section('title', $page)
@section('content')
<div class="page-heading">
    <h1 class="page-title">Tambah Waktu Jam Kerja Pegawai</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Tambah Waktu Jam Kerja Pegawai</li>
    </ol>
</div>
@foreach($detailJamKerja as $detail)
<div class="ibox mt-3">
    <div class="ibox-body">
        <form method="POST" action="{{ url('store_shift_jam_kerja/'.$detail->id) }}">
            {{ method_field('put') }}
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Waktu Jam Kerja</label>
                        <input class="form-control" name="shift" type="text" value="{{ $detail->shift }}" readonly />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status Jam Kerja</label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline{{ $detail->id }}" value="1" name="is_active"
                                    class="custom-control-input" @if($detail->is_active == 1) checked @endif />
                                <label class="custom-control-label" for="customRadioInline{{ $detail->id }}">Aktif</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline{{ $detail->id }}" value="0" name="is_active"
                                    class="custom-control-input"  @if($detail->is_active == 0) checked @endif />
                                <label class="custom-control-label" for="customRadioInline{{ $detail->id }}">Non Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jam Mulai Masuk</label>
                        <input class="form-control" name="jam_mulai_masuk" value="{{ $detail->jam_mulai_masuk }}" type="time" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jam Akhir Masuk</label>
                        <input class="form-control" name="jam_akhir_masuk" value="{{ $detail->jam_akhir_masuk }}" type="time" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jam Mulai Pulang</label>
                        <input class="form-control" name="jam_awal_pulang" value="{{ $detail->jam_awal_pulang }}" type="time" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jam Akhir Pulang</label>
                        <input class="form-control" name="jam_akhir_pulang" value="{{ $detail->jam_akhir_pulang }}" type="time" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-success text-white pointer">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endforeach
@endsection