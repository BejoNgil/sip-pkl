@extends('layouts.app')
@section('title', 'Profil Saya')
@section('page-header')
    Profil Saya
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <form action="{{ route('pembimbing.profile') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" value="{{ old('nama', $pembimbing['nama']) }}"
                                           name="nama"
                                           id="nama"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control"
                                           value="{{ old('email', $user['email']) }}" name="email"
                                           id="email"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div>
                                        <div class="radio3 radio-check radio-success radio-inline">
                                            <input type="radio" id="laki-laki" name="jenis_kelamin" value="L"
                                                   {{ old('jenis_kelamin', $pembimbing['jenis_kelamin']) == 'L' ? 'checked' : '' }} required>
                                            <label for="laki-laki">
                                                Laki-Laki
                                            </label>
                                        </div>
                                        <div class="radio3 radio-check radio-success radio-inline">
                                            <input type="radio" id="perempuan" name="jenis_kelamin" value="P"
                                                   {{ old('jenis_kelamin', $pembimbing['jenis_kelamin']) == 'P' ? 'checked' : '' }} required>
                                            <label for="perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Telepon</label>
                                    <input type="number" class="form-control" name="telepon"
                                           value="{{ old('telepon', $pembimbing['telepon']) }}">
                                </div>
                                <div class="form-group">
                                    <label>Divisi</label>
                                    <input type="text" class="form-control" name="divisi"
                                           value="{{ old('divisi', $pembimbing['divisi']) }}">
                                </div>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="5"
                                              class="form-control">{{ old('alamat', $pembimbing['alamat']) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Ubah Password:</label>
                                    <br>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#changePassword"><i
                                            class="fa fa-key"></i> Ubah Password
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('home') }}" class="btn btn-default">
                                    <i class="fa fa-arrow-circle-left"></i> Kembali
                                </a>
                                <button type="submit" class="float-right btn btn-primary">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.change-password')
@endsection
