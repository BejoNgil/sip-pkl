@extends('layouts.app')
@section('title', 'Log Kegiatan')
@section('page-header')
    Log Kegiatan
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
                                <i class="fa fa-plus"></i> Tambah Log Kegiatan
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
                                <th>Tanggal</th>
                                <th>Waktu</th>
                                <th>Uraian Kegiatan</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($logKegiatan as $item)
                                <tr>
                                    <td width="9%">{{ $loop->iteration }}</td>
                                    <td width="13%">{{ $item['tanggal']->format('d M Y') }}</td>
                                    <td width="13%">{{ $item['jam_mulai'] . ' - ' . $item['jam_selesai'] }}</td>
                                    <td>{{ $item['uraian'] }}</td>
                                    <td width="15%">
                                        <a href="javascript:void(0);" data-toggle="modal"
                                           data-target="#updateResource-{{ $item['id'] }}" class="btn btn-success"><i
                                                class="fa fa-pencil"></i> Ubah</a>
                                        <a href="javascript:void(0);"
                                           onclick="destroy('{{ $item['id'] }}')"
                                           class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                                    </td>
                                </tr>
                                @component('components.modal', ['id'=> 'updateResource-' . $item['id']])
                                    @slot('title')
                                        Ubah Log Kegiatan
                                    @endslot
                                    @slot('content')
                                        <form action="{{ route('kegiatan.update', $item) }}" method="POST">
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
                                                        <label>Tanggal</label>
                                                        <input type="date" class="form-control" name="tanggal" required
                                                               value="{{ old('tanggal', $item['tanggal']->format('Y-m-d')) }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jam Mulai</label>
                                                        <input type="time" class="form-control" name="jam_mulai" required
                                                               value="{{ old('jam_mulai', $item['jam_mulai']) }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jam Selesai</label>
                                                        <input type="time" class="form-control" name="jam_selesai" required
                                                               value="{{ old('jam_selesai', $item['jam_selesai']) }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Uraian Kegiaan</label>
                                                        <textarea name="uraian" rows="5" class="form-control">{{ old('uraian', $item['uraian']) }}</textarea>
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
            Tambah Log Kegiatan Baru
        @endslot
        @slot('content')
            <form action="{{ route('kegiatan.store') }}" method="POST">
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
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" required
                               value="{{ old('tanggal') }}">
                    </div>
                    <div class="form-group">
                        <label>Jam Mulai</label>
                        <input type="time" class="form-control" name="jam_mulai" required
                               value="{{ old('jam_mulai') }}">
                    </div>
                    <div class="form-group">
                        <label>Jam Selesai</label>
                        <input type="time" class="form-control" name="jam_selesai" required
                               value="{{ old('jam_selesai') }}">
                    </div>
                    <div class="form-group">
                        <label>Uraian Kegiaan</label>
                        <textarea name="uraian" rows="5" class="form-control">{{ old('uraian') }}</textarea>
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
        function destroy(id) {
            swal({
                title: "Apa anda yakin?",
                text: "Akan Menghapus Log Kegiatan Ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('kegiatan.destroy', ':id') }}";
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
