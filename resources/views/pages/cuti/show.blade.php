@extends('layouts.main')
@section('title','Pengajuan Izin / Cuti {{ $izin->nama }}')
@section('content')
<div class="page-heading">
    <h1 class="page-title">Pengajuan Izin / Cuti {{ $izin->nama }}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Pengajuan Izin / Cuti {{ $izin->nama }}</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-head">
        <div class="ibox-title">Pengajuan Izin / Cuti {{ $izin->nama }}</div>
    </div>
    <div class="ibox-body">
       <form method="POST" action="{{ route('pengajuan_cuti.update', $izin->id) }}">
           {{ method_field('put') }}
           @csrf
           <input type="hidden" name="statusIzin" id="statusIzin" />
           <div class="row">
               <div class="col-md-6">
                    <div class="form-group">
                        <label>Kode Pegawai</label>
                        <input type="text" readonly class="form-control" value="{{ $izin->pegawaiCode }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>NIK Pegawai</label>
                        <input type="text" readonly class="form-control" value="{{ $izin->nik }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input type="text" readonly class="form-control" value="{{ $izin->nama }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Izin / Cuti</label>
                        <input type="text" readonly class="form-control" value="{{ $izin->namaIzin }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Mulai Izin / Cuti</label>
                        <input type="text" readonly class="form-control" value="{{ $izin->tanggalMulaiIzin }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Akhir Izin / Cuti</label>
                        <input type="text" readonly class="form-control" value="{{ $izin->tanggalAkhirIzin }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" readonly class="form-control" value="{{ $izin->keteranganIzin }}" />
                    </div>
                </div>
                <div class="col-md-12">
                    <label>Dokumen Pendukung</label>
                    <iframe style="border:none;" width="100%" height="600" src="{{ asset('files/izin/'.$izin->dokumenPendukung) }}"></iframe>
                </div>
                <div class="col-md-12 mt-3">
                    @if($izin->statusIzin == 0)   
                        <button class="btn btn-success" id="btnTerima" type="submit">Terima</button>&nbsp;
                        <button class="btn btn-danger" id="btnTolak" type="submit">Tolak</button>&nbsp;
                        <a href="{{ url()->previous() }}" class="btn btn-info">Kembali</a>
                    @else
                        <a href="{{ url()->previous() }}" class="btn btn-info">Kembali</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
$("#datatable").DataTable();

const btnTerima = document.querySelector("#btnTerima");
const btnTolak = document.querySelector("#btnTolak");
const statusIzin = document.querySelector("#statusIzin");

btnTerima.addEventListener("click", function(){
    statusIzin.value = "1";
});

btnTolak.addEventListener("click", function(){
    statusIzin.value = "2";
});
</script>
@endpush