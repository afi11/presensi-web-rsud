@extends('layouts.main')
@section('title', $page)
@section('content')
<div class="page-heading">
    <h1 class="page-title">@if($isEdit) Edit @else Tambah @endif Pengguna</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->previous() }}"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">@if($isEdit) Edit @else Tambah @endif Pengguna</li>
    </ol>
</div>
<div class="ibox mt-3">
    <div class="ibox-body">
        @if($isEdit)
            @php $url = route('pengguna.update', $pengguna->id) @endphp
        @else
            @php $url = route('pengguna.store') @endphp
        @endif
        <form method="POST" action="{{ $url }}">
            @if($isEdit)
                {{ method_field('put') }}
            @endif
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control @error('username') is-invalid @enderror" 
                            name="username" type="text" 
                            @if($isEdit) value="{{ $pengguna->username }}" @endif />
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" 
                            name="password" type="password" 
                            @if($isEdit) value="{{ $pengguna->password }}" @endif />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Password Hint</label>
                        <input class="form-control @error('password_hint') is-invalid @enderror" 
                            name="password_hint" type="text" 
                            @if($isEdit) value="{{ $pengguna->password_hint }}" @endif />
                        @error('password_hint')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Role</label>
                        <div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" value="admin" name="role"
                                    class="custom-control-input" @if($isEdit) @if($pengguna->role == "admin")
                                checked
                                @endif
                                @endif>
                                <label class="custom-control-label" for="customRadioInline1">Admin</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" value="kepegawaian" name="role"
                                    class="custom-control-input" @if($isEdit) @if($pengguna->role == "kepegawaian")
                                checked
                                @endif
                                @endif>
                                <label class="custom-control-label" for="customRadioInline2">Kepegawaian</label>
                            </div>
                        </div>
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