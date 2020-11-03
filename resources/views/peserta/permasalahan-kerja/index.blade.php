@extends('layouts.app')
@section('title', 'List Permasalahan Kerja')
@section('page-header')
    Daftar Permasalahan Kerja
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
                                <i class="fa fa-plus"></i> Tambah Permasalahan Kerja
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
                                <th>Topik</th>
                                <th>Pembimbing</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($permasalahanKerja as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['tanggal']->format('d M Y') }}</td>
                                    <td>{{ $item['topik'] }}</td>
                                    <td>{{ $pkl['pembimbing']['nama'] }}</td>
                                    <td>
                                        @if ($item['status'] == 0)
                                            {!! '<span class="text-success">Open</span>' !!}
                                        @else
                                            {!! '<span class="text-danger">Close</span>' !!}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item['status'] == 0)
                                        <a href="javascript:void(0);" data-toggle="modal"
                                               data-target="#updateResource-{{ $item['id'] }}"
                                               class="btn btn-success btn-sm"><i
                                                    class="fa fa-pencil"></i> Ubah</a>
                                                <a href="javascript:void(0);"
                                                onclick="destroy('{{ $item['id'] }}')"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Hapus</a>
                                        @endif
                                        <a href="javascript:void(0);"
                                           onclick="destroy('{{ $item['id'] }}')"
                                           class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Detail</a>
                                    </td>
                                </tr>
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
            Tambah Permasalahan Kerja
        @endslot
        @slot('content')
            <form action="{{ route('permasalahan-kerja.store') }}" method="POST">
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
                        <label>Topik</label>
                        <input type="text" class="form-control" name="topik">
                    </div>
                    <div class="form-group">
                        <label>Nama Pembimbing</label>
                        <input type="text" class="form-control" readonly
                               value="{{ $pkl['pembimbing']['nama']  }}">
                    </div>
                    <div class="form-group">
                        <label>Uraian Masalah</label>
                        <textarea name="description" rows="5" class="form-control">{{ old('uraian') }}</textarea>
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
                text: "Akan Menghapus Data ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('permasalahan-kerja.destroy', ':id') }}";
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
