@extends('layouts.app')
@section('title', 'Daftar Pembimbing')
@section('page-header')
    List Pembimbing
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row mb-2 clearfix">
                        <div class="col-md-12">
                            <button type="button" data-toggle="modal" data-target="#createNewPembimbing"
                                    class="float-right btn btn-primary">
                                <i class="fa fa-plus"></i> Tambah Pembimbing Baru
                            </button>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover data-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Divisi</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pembimbing as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>{{ $item['jenis_kelamin'] }}</td>
                                    <td>{{ $item['divisi'] }}</td>
                                    <td>{{ $item['authenticable']['email'] }}</td>
                                    <td width="15%">
                                        <a href="javascript:void(0);" data-toggle="modal"
                                           data-target="#updatePembimbing-{{ $item['id'] }}" class="btn btn-success"><i
                                                class="fa fa-pencil"></i> Ubah</a>
                                        <a href="javascript:void(0);"
                                           onclick="destroy('{{ $item['id'] }}', '{{ $item['nama'] }}')"
                                           class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                                    </td>
                                </tr>
                                @component('components.modal', ['id'=> 'updatePembimbing-' . $item['id']])
                                    @slot('title')
                                        Ubah Pembimbing
                                    @endslot
                                    @slot('content')
                                        <form action="{{ route('pembimbing.update', $item) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                @if($errors->any())
                                                    <div class="alert alert-danger alert-dismissable">
                                                        <a href="#" class="close" data-dismiss="alert"
                                                           aria-label="close">×</a>
                                                        <ul>
                                                            @foreach($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" class="form-control" name="nama" required
                                                           value="{{ old('nama', $item['nama']) }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="email" required
                                                           value="{{ old('email', $item['authenticable']['email']) }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Divisi</label>
                                                    <input type="text" class="form-control" name="divisi"
                                                           value="{{ old('divisi', $item['divisi']) }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <div>
                                                        <div class="radio3 radio-check radio-success radio-inline">
                                                            <input type="radio" id="laki-laki-{{ $item['id'] }}"
                                                                   name="jenis_kelamin" value="L"
                                                                {{ old('jenis_kelamin', $item['jenis_kelamin']) == 'L' ? 'checked' : '' }}>
                                                            <label for="laki-laki-{{ $item['id'] }}">
                                                                Laki-Laki
                                                            </label>
                                                        </div>
                                                        <div class="radio3 radio-check radio-success radio-inline">
                                                            <input type="radio" id="perempuan-{{ $item['id'] }}"
                                                                   name="jenis_kelamin" value="P"
                                                                {{ old('jenis_kelamin', $item['jenis_kelamin']) == 'P' ? 'checked' : '' }}>
                                                            <label for="perempuan-{{ $item['id'] }}">
                                                                Perempuan
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" name="password"
                                                           id="password" autocomplete="false">
                                                    <small>Password minimal 6 karakter</small>
                                                    <div>
                                                        <small>Kosongkan password jika tidak ingin diubah</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    @endslot
                                @endcomponent
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @component('components.modal', ['id'=> 'createNewPembimbing'])
        @slot('title')
            Tambah Pembimbing Baru
        @endslot
        @slot('content')
            <form action="{{ route('pembimbing.store') }}" method="POST">
                @csrf
                <div class="modal-body">
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
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" required
                               value="{{ old('nama') }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email" required
                               value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                        <label>Divisi</label>
                        <input type="text" class="form-control" name="divisi" id="divisi" required
                               value="{{ old('divisi') }}">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div>
                            <div class="radio3 radio-check radio-success radio-inline">
                                <input type="radio" id="laki-laki" name="jenis_kelamin" value="L"
                                    {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>
                                <label for="laki-laki">
                                    Laki-Laki
                                </label>
                            </div>
                            <div class="radio3 radio-check radio-success radio-inline">
                                <input type="radio" id="perempuan" name="jenis_kelamin" value="P"
                                    {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                                <label for="perempuan">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                        <small>Password minimal 6 karakter</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection
@push('scripts')
    <script>
        @if(session()->has('showCreateModal'))
        $(() => {
            $('#createNewPembimbing').modal('show');
        });
        @endif
        @if(session()->has('showModal'))
        $(() => {
            $('#updatePembimbing-{{ session('showModal') }}').modal('show');
        });
        @endif
    </script>
    <script>
        function destroy(id, name) {
            swal({
                title: "Apa anda yakin?",
                text: "Akan Menghapus Pembimbing " + name,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('pembimbing.destroy', ':id') }}";
                    theUrl = theUrl.replace(":id", id);
                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "delete"},
                        success: function (data) {
                            window.location.href = data;
                        },
                        error: function (data) {
                            swal("Oops", "We couldn't connect to the server!", "error");
                        }
                    });
                }
            }));
        }
    </script>
@endpush
