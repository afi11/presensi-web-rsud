@extends('layouts.main')
@section('title', $page)
@section('content')
<div class="page-heading">
    <h1 class="page-title">@if($isEdit) Edit @else Tambah @endif Pegawai</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Tambah Pegawai</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-body">
        @if($isEdit)
        @php $url = route('pegawai.update', $pegawai->id) @endphp
        @else
        @php $url = route('pegawai.store') @endphp
        @endif
        <form method="POST" action="{{ $url }}" enctype="multipart/form-data">
            @if($isEdit)
            {{ method_field('put') }}
            @endif
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>NIK Pegawai</label>
                        <input class="form-control" name="nik" type="number" length="20" @if($isEdit)
                            value="{{ $pegawai->nik }}" @endif />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input class="form-control  @error('nama') is-invalid @enderror" name="nama" type="text"
                            @if($isEdit) value="{{ $pegawai->nama }}" @endif />
                        @error('nama')
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
                                <input type="radio" id="customRadioInline1" value="L" name="gender"
                                    class="custom-control-input" @if($isEdit) @if($pegawai->gender == "L")
                                checked
                                @endif
                                @endif>
                                <label class="custom-control-label" for="customRadioInline1">Pria</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" value="P" name="gender"
                                    class="custom-control-input" @if($isEdit) @if($pegawai->gender == "P")
                                checked
                                @endif
                                @endif>
                                <label class="custom-control-label" for="customRadioInline2">Wanita</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input class="form-control  @error('tglLahir') is-invalid @enderror" name="tglLahir"
                            type="date" @if($isEdit) value="{{ $pegawai->tglLahir }}" @endif />
                        @error('tglLahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <!-- <div class="col-md-4">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control  @error('username') is-invalid @enderror" name="username" type="text"
                            @if($isEdit) value="{{ $pegawai->username }}" @endif />
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div> -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control  @error('email') is-invalid @enderror" name="email" type="email"
                            @if($isEdit) value="{{ $pegawai->email }}" @endif />
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <!-- <div class="col-md-4">
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control  @error('password') is-invalid @enderror" name="password"
                            type="password" @if($isEdit) placeholder="Isikan password baru" @endif />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div> -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Shift Pegawai</label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline  @error('statusShift') is-invalid @enderror">
                                <input type="radio" id="customRadioInline3" name="statusShift"
                                    class="custom-control-input" value="0" @if($isEdit) @if($pegawai->statusShift == 0)
                                checked
                                @endif
                                @endif>
                                <label class="custom-control-label" for="customRadioInline3">Non Shift / Reguler</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline4" name="statusShift"
                                    class="custom-control-input" value="1"  @if($isEdit) @if($pegawai->statusShift == 1)
                                checked
                                @endif
                                @endif>
                                <label class="custom-control-label" for="customRadioInline4">Shift</label>
                            </div>
                        </div>
                        @error('statusShift')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 @if(!$isEdit) hidden @endif @if($isEdit && $pegawai->idJamKerjaShift == null) hidden @endif" id="idJamKerjaShift">
                    <div class="form-group">
                        <label>Shift Jam Kerja</label>
                        <select class="custom-select" name="idJamKerjaShift">
                            @foreach($shift as $row)
                            <option value="{{ $row->id }}" @if($isEdit) @if($row->id == $pegawai->idJamKerjaShift)
                                selected
                                @endif
                                @endif>{{ $row->namaProfile }}</option>
                            @endforeach
                        </select>
                        @error('idDivisi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Divisi Pegawai</label>
                        <select class="custom-select" name="idDivisi">
                            <option value="">Pilih salah satu</option>
                            @foreach($ruangan as $row)
                            <option value="{{ $row->id }}" @if($isEdit) @if($row->id == $pegawai->idDivisi)
                                selected
                                @endif
                                @endif>{{ $row->namaDivisi }}</option>
                            @endforeach
                        </select>
                        @error('idDivisi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Telepon / No HP</label>
                        <input class="form-control  @error('telepon') is-invalid @enderror" name="telepon" type="text"
                            @if($isEdit) value="{{ $pegawai->telepon }}" @endif />
                        @error('telepon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control  @error('alamat') is-invalid @enderror" name="alamat">
                            @if($isEdit) {{ $pegawai->alamat }} @endif
                        </textarea>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Foto</label>
                        <div class="custom-file">
                            <input name="foto_pegawai" type="file"
                                class="custom-file-input @error('foto_pegawai') is-invalid @enderror" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        @if($isEdit)
                        <img class="img-profil mt-3" src="{{ asset('assets/img/users/'.$pegawai->foto_pegawai) }}" />
                        @endif
                        @error('foto_pegawai')
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
@push('scripts')
<script>
    const customRadioInline3 = document.querySelector('#customRadioInline3');
    const customRadioInline4 = document.querySelector('#customRadioInline4');
    const idJamKerjaShift = document.querySelector("#idJamKerjaShift");

    customRadioInline3.addEventListener("change", function(e){
        idJamKerjaShift.classList.add("hidden");
    });

    customRadioInline4.addEventListener("change", function(e){
        idJamKerjaShift.classList.remove("hidden");
    });
</script>
@endpush