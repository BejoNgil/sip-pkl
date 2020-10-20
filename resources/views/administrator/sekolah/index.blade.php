@extends('layouts.app')
@section('title', 'Daftar Sekolah')
@section('page-header')
    List Sekolah
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row mb-2 clearfix">
                        <div class="col-md-12">
                            <button type="button" data-toggle="modal" data-target="#createNew"
                                    class="float-right btn btn-primary">
                                <i class="fa fa-plus"></i> Tambah Sekolah Baru
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
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sekolah as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>{{ $item['telepon'] }}</td>
                                    <td>{{ $item['alamat'] }}</td>
                                    <td width="15%">
                                        <a href="javascript:void(0);" data-toggle="modal"
                                           data-target="#updateResource-{{ $item['id'] }}" class="btn btn-success"><i
                                                class="fa fa-pencil"></i> Ubah</a>
                                        <a href="javascript:void(0);"
                                           onclick="destroy('{{ $item['id'] }}', '{{ $item['nama'] }}')"
                                           class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                                    </td>
                                </tr>
                                @component('components.modal', ['id'=> 'updateResource-' . $item['id']])
                                    @slot('title')
                                        Ubah Sekolah
                                    @endslot
                                    @slot('content')
                                        <form action="{{ route('sekolah.update', $item) }}" method="POST">
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
                                                    <label>Telepon</label>
                                                    <input type="text" class="form-control" name="telepon" required
                                                           value="{{ old('telepon', $item['telepon']) }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea name="alamat" rows="5"
                                                              class="form-control">{{ old('alamat', $item['alamat']) }}</textarea>
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
    @component('components.modal', ['id'=> 'createNew'])
        @slot('title')
            Tambah Sekolah Baru
        @endslot
        @slot('content')
            <form action="{{ route('sekolah.store') }}" method="POST">
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
                            <input type="text" class="form-control" name="nama" required
                                   value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" class="form-control" name="telepon" required
                                   value="{{ old('telepon') }}">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" rows="5"
                                      class="form-control">{{ old('alamat') }}</textarea>
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
            $('#createNew').modal('show');
        });
        @endif
        @if(session()->has('showModal'))
        $(() => {
            $('#updateResource-{{ session('showModal') }}').modal('show');
        });
        @endif
    </script>
    <script>
        function destroy(id, name) {
            swal({
                title: "Apa anda yakin?",
                text: "Akan Menghapus Sekolah " + name,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('sekolah.destroy', ':id') }}";
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
