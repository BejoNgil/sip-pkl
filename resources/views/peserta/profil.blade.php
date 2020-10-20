@extends('layouts.app')
@section('title', 'Profil Saya')
@section('page-header')
    Profil Saya
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
                        <form action="{{ route('peserta.profile') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" value="{{ old('nama', $peserta['nama']) }}"
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
                                    <label for="nis">NIS (Nomer Induk Siswa)</label>
                                    <input type="number" class="form-control" value="{{ old('nis', $peserta['nis']) }}"
                                           name="nis"
                                           id="nis"
                                           min="0" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <div>
                                        <div class="radio3 radio-check radio-success radio-inline">
                                            <input type="radio" id="laki-laki" name="jenis_kelamin" value="L"
                                                   {{ old('jenis_kelamin', $peserta['jenis_kelamin']) == 'L' ? 'checked' : '' }} required>
                                            <label for="laki-laki">
                                                Laki-Laki
                                            </label>
                                        </div>
                                        <div class="radio3 radio-check radio-success radio-inline">
                                            <input type="radio" id="perempuan" name="jenis_kelamin" value="P"
                                                   {{ old('jenis_kelamin', $peserta['jenis_kelamin']) == 'P' ? 'checked' : '' }} required>
                                            <label for="perempuan">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="birthday">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                           value="{{ old('tanggal_lahir',  $peserta['tanggal_lahir'] != null ? $peserta['tanggal_lahir']->format('d M Y') : '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="5"
                                              class="form-control">{{ old('alamat', $peserta['alamat']) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <img
                                    src="{{ asset($peserta['foto'] != null ? 'storage/' . $peserta['foto'] : 'assets/img/avatar-placeholder.png') }}"
                                    alt="{{ $peserta['nama'] }}" class="user-image mt-1" height="60"/>
                                <div class="form-group">
                                    <label for="foto">Foto (Opsional)</label>
                                    <input type="file" name="foto" id="foto">
                                </div>
                                <div class="form-group">
                                    <label for="sekolah">Sekolah</label>
                                    <div id="school-select-ctr">
                                        <select name="sekolah_id" id="sekolah" class="form-control select2">
                                            @foreach($sekolah as $item)
                                                <option
                                                    value="{{ $item['id'] }}" {{ $item['id'] == $peserta['sekolah_id'] ? 'selected' : '' }}>{{ $item['nama'] }}</option>
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
                                            @foreach($programKeahlian as $item)
                                                <option
                                                    value="{{ $item['id'] }}" {{ $item['id'] == $peserta['program_keahlian_id'] ? 'selected' : '' }}>{{ $item['nama'] }}</option>
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
                                           value="{{ old('telepon', $peserta['telepon']) }}" name="telepon"
                                           id="telepon">
                                </div>
                                <div class="form-group">
                                    <label for="ayah">Nama Ayah (Opsional)</label>
                                    <input type="text" class="form-control"
                                           value="{{ old('ayah', $peserta['ayah']) }}" name="ayah" id="ayah">
                                </div>
                                <div class="form-group">
                                    <label for="ibu">Nama Ibu (Opsional)</label>
                                    <input type="text" class="form-control"
                                           value="{{ old('ibu', $peserta['ibu']) }}" name="ibu" id="ibu">
                                </div>
                                <div class="form-group">
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
    <script>
        function resetPassword(id, name) {
            swal({
                title: "Apa anda yakin?",
                text: "Akan Mereset Password Peserta " + name,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('peserta.reset-password', ':id') }}";
                    theUrl = theUrl.replace(":id", id);
                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "patch"},
                        success: function (data) {
                            window.location.href = data;
                        },
                        error: function (data) {
                            console.log(data);
                            swal("Oops", "Terdapat kesalahan pada sistem", "error");
                        }
                    });
                }
            }));
        }
    </script>
@endpush
