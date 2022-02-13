@extends('layouts.main')
@section('title', $page)
@section('content')
<div class="page-heading">
    <h1 class="page-title">@if($isEdit) Edit @else Tambah @endif Waktu Kerja Reguler</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">@if($isEdit) Edit @else Tambah @endif Waktu Kerja Reguler</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-body">
        @if($isEdit)
        @php $url = route('waktu_reguler.update', $waktuReguler->id) @endphp
        @else
        @php $url = route('waktu_reguler.store') @endphp
        @endif
        <form method="POST" action="{{ $url }}">
            @if($isEdit)
            {{ method_field('put') }}
            @endif
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Pilih Hari Kerja</label>
                        <select
                            class="@if(!$isEdit) selectMultipleHari @endif custom-select @error('hariKerja') is-invalid @enderror"
                            @if(!$isEdit) name="hariKerja[]" multiple="multiple" @else name="hariKerja" @endif>
                            <option value="">Pilih salah satu</option>
                            <option value="Sunday" @if($isEdit ) @if($waktuReguler->hariKerja == 'Sunday')
                                selected
                                @endif
                                @endif>Minggu</option>
                            <option value="Monday" @if($isEdit ) @if($waktuReguler->hariKerja == 'Monday')
                                selected
                                @endif
                                @endif>Senin</option>
                            <option value="Tuesday" @if($isEdit ) @if($waktuReguler->hariKerja == 'Tuesday')
                                selected
                                @endif
                                @endif>Selasa</option>
                            <option value="Wednesday" @if($isEdit ) @if($waktuReguler->hariKerja == 'Wednesday')
                                selected
                                @endif
                                @endif>Rabu</option>
                            <option value="Thursday" @if($isEdit ) @if($waktuReguler->hariKerja == 'Thursday')
                                selected
                                @endif
                                @endif>Kamis</option>
                            <option value="Friday" @if($isEdit ) @if($waktuReguler->hariKerja == 'Friday')
                                selected
                                @endif
                                @endif>Jumat</option>
                            <option value="Saturday" @if($isEdit ) @if($waktuReguler->hariKerja == 'Saturday')
                                selected
                                @endif
                                @endif>Sabtu</option>
                        </select>
                        @error('hariKerja')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jam Mulai Masuk</label>
                        <input class="form-control" name="jam_mulai_masuk" @if($isEdit )
                            value="{{ $waktuReguler->jam_mulai_masuk }}" @endif type="time" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jam Akhir Masuk</label>
                        <input class="form-control" name="jam_akhir_masuk" @if($isEdit )
                            value="{{ $waktuReguler->jam_akhir_masuk }}" @endif type="time" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jam Mulai Pulang</label>
                        <input class="form-control" name="jam_awal_pulang" @if($isEdit )
                            value="{{ $waktuReguler->jam_awal_pulang }}" @endif type="time" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Jam Akhir Pulang</label>
                        <input class="form-control" name="jam_akhir_pulang" @if($isEdit )
                            value="{{ $waktuReguler->jam_akhir_pulang }}" @endif type="time" />
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
@push('scripts')
<script>
$(document).ready(function() {
    $('.selectMultipleHari').select2();
});
</script>
@endpush