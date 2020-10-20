@extends('layouts.app')
@section('title', 'Daftar Peserta')
@section('page-header')
    Tambah Peserta
@endsection
@section('main')
    @php
        $schoolNotRegisteredText = "Sekolah belum terdaftar?";
        $schoolRegisteredText = "Sekolah sudah terdaftar?";
        $programNotRegisteredText = "Program keahlian belum terdaftar?";
        $programRegisteredText = "Program keahlian sudah terdaftar?";
    @endphp
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
                        <form action="{{ route('peserta.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" value="{{ old('nama') }}" name="nama"
                                           id="nama"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="{{ old('email') }}" name="email"
                                           id="email"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="nis">NIS (Nomer Induk Siswa)</label>
                                    <input type="number" class="form-control" value="{{ old('nis') }}" name="nis"
                                           id="nis"
                                           min="0" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div>
                                        <div class="radio3 radio-check radio-success radio-inline">
                                            <input type="radio" id="laki-laki" name="jenis_kelamin" value="L"
                                                   {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} required>
                                            <label for="laki-laki">
                                                Laki-Laki
                                            </label>
                                        </div>
                                        <div class="radio3 radio-check radio-success radio-inline">
                                            <input type="radio" id="perempuan" name="jenis_kelamin" value="P"
                                                   {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} required>
                                            <label for="perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                           value="{{ old('tanggal_lahir') }}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="5"
                                              class="form-control">{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="foto">Foto (Opsional)</label>
                                    <input type="file" name="foto" id="foto">
                                </div>
                                <div class="form-group">
                                    <label for="sekolah">Sekolah</label>
                                    <div id="school-select-ctr">
                                        <select name="sekolah_id" id="sekolah" class="form-control select2">
                                            <option disabled selected>-Pilih Sekolah-</option>
                                            @foreach($sekolah as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="display: none" id="schoolContainer">
                                        <div class="form-group">
                                            <label>Nama Sekolah</label>
                                            <input type="text" class="form-control" name="sekolah[nama]"
                                                   id="namaSekolah"
                                                   value="{{ old('sekolah.nama') }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon Sekolah</label>
                                            <input type="number" class="form-control" name="sekolah[telepon]"
                                                   value="{{ old('sekolah.telepon') }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Sekolah</label>
                                            <textarea name="sekolah[alamat]" rows="5"
                                                      class="form-control">{{ old('sekolah.alamat') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <a id="schoolNotRegistered"
                                           href="javascript:void(0);">{{ $schoolNotRegisteredText }}</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="program-keahlian">Program Keahlian</label>
                                    <div id="program-select-ctr">
                                        <select name="program_keahlian_id" id="program-keahlian"
                                                class="form-control select2">
                                            <option disabled selected>-Pilih Program Keahlian-</option>
                                            @foreach($programKeahlian as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['nama'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="display: none" id="programContainer">
                                        <div class="form-group">
                                            <label>Nama Program Keahlain</label>
                                            <input type="text" class="form-control" name="program[nama]"
                                                   id="namaProgram"
                                                   value="{{ old('program.nama') }}">
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <a href="javascript:void(0);"
                                           id="programNotRegistered">{{ $programNotRegisteredText }}</a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="number" class="form-control"
                                           value="{{ old('telepon') }}" name="telepon" id="telepon">
                                </div>
                                <div class="form-group">
                                    <label for="ayah">Nama Ayah (Opsional)</label>
                                    <input type="text" class="form-control"
                                           value="{{ old('ayah') }}" name="ayah" id="ayah">
                                </div>
                                <div class="form-group">
                                    <label for="ibu">Nama Ibu (Opsional)</label>
                                    <input type="text" class="form-control"
                                           value="{{ old('ibu') }}" name="ibu" id="ibu">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="alert alert-info alert-dismissable">
                                            Default Password Akun: password
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('peserta.index') }}" class="btn btn-default">
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
@endsection
@push('scripts')
    <script>
        $('#sekolah').select2();
        $('#program-keahlian').select2();

        $('#schoolNotRegistered').click(function () {
            $('#school-select-ctr').toggle();
            $('#schoolContainer').toggle();
            if ($(this).text() === '{{ $schoolNotRegisteredText }}') {
                $('#namaSekolah').attr('required', true);
                $(this).text('{{ $schoolRegisteredText }}');
            } else {
                $('#namaSekolah').attr('required', false);
                $(this).text('{{ $schoolNotRegisteredText }}');
            }
        });

        $('#programNotRegistered').click(function () {
            $('#program-select-ctr').toggle();
            $('#programContainer').toggle();
            if ($(this).text() === '{{ $programNotRegisteredText }}') {
                $('#namaProgram').attr('required', true);
                $(this).text('{{ $programRegisteredText }}');
            } else {
                $('#namaProgram').attr('required', false);
                $(this).text('{{ $programNotRegisteredText }}');
            }
        });

        @error('sekolah.nama')
        $('#schoolNotRegistered').trigger('click');
        @enderror
        @error('program.nama')
        $('#programNotRegistered').trigger('click');
        @enderror
    </script>
@endpush
