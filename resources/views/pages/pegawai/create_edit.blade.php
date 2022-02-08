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
                        <input class="form-control" name="nik_pegawai" 
                            type="number" length="20" @if($isEdit) value="{{ $pegawai->nik_pegawai }}" @endif  />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Nama Pegawai</label>
                        <input class="form-control  @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai"
                            type="text" @if($isEdit) value="{{ $pegawai->nama_pegawai }}" @endif  />
                        @error('nama_pegawai')
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
                                <input type="radio" id="customRadioInline1" value="MALE" name="gender" class="custom-control-input"
                                    @if($isEdit) 
                                        @if($pegawai->gender == "MALE")
                                            checked
                                        @endif
                                    @endif>
                                <label class="custom-control-label" for="customRadioInline1">Pria</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" value="FEMALE" name="gender" class="custom-control-input"
                                    @if($isEdit) 
                                        @if($pegawai->gender == "FEMALE")
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
                        <input class="form-control  @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir"
                            type="date" @if($isEdit) value="{{ $pegawai->tanggal_lahir }}" @endif  />
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control  @error('username') is-invalid @enderror" name="username"
                            type="text" @if($isEdit) value="{{ $pegawai->username }}" @endif  />
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control  @error('email') is-invalid @enderror" name="email"
                            type="email" @if($isEdit) value="{{ $pegawai->email }}" @endif  />
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control  @error('password') is-invalid @enderror" name="password"
                            type="password" @if($isEdit) placeholder="Isikan password baru" @endif  />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Shift Pegawai</label>
                        <select class="custom-select" name="shift_id">
                            <option value="">Pilih salah satu</option>
                            @foreach($shift as $row)
                                <option value="{{ $row->id }}" 
                                @if($isEdit) 
                                    @if($row->id == $pegawai->shift_id)
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
                        <label>Ruangan Pegawai</label>
                        <select class="custom-select" name="ruangan_id">
                            <option value="">Pilih salah satu</option>
                            @foreach($ruangan as $row)
                                <option value="{{ $row->id }}" 
                                @if($isEdit) 
                                    @if($row->id == $pegawai->ruangan_id)
                                        selected
                                    @endif
                                @endif>{{ $row->nama_ruangan }}</option>
                            @endforeach
                        </select>
                        @error('ruangan_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Telepon / No HP</label>
                        <input class="form-control  @error('telepon_pegawai') is-invalid @enderror" name="telepon_pegawai"
                            type="text" @if($isEdit) value="{{ $pegawai->telepon_pegawai }}" @endif  />
                        @error('telepon_pegawai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control  @error('alamat_pegawai') is-invalid @enderror" name="alamat_pegawai">
                            @if($isEdit) {{ $pegawai->alamat_pegawai }} @endif
                        </textarea>
                        @error('alamat_pegawai')
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
                            <input name="foto_pegawai" type="file" class="custom-file-input @error('foto_pegawai') is-invalid @enderror" 
                                id="customFile">
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