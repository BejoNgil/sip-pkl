@extends('layouts.app')
@section('title', 'Kelola PKL')
@section('page-header')
    Kelola PKL
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
                                <i class="fa fa-plus"></i> Tugaskan Peserta
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
                                <th>Nama Peserta</th>
                                <th>Nama Pembimbing</th>
                                <th>Tgl Mulai</th>
                                <th>Tgl Selesai</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($listPKL as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#pesertaInfo"
                                           data-id="{{ $item->peserta->id }}">{{ $item->peserta->nama }}</a>
                                    </td>
                                    <td>{{ $item->pembimbing->nama}}</td>
                                    <td>{{ $item->tanggal_mulai->format('d M Y') }}</td>
                                    <td>{{ $item->tanggal_selesai != null ? $item->tanggal_selesai->format('d M Y') : '-' }}</td>
                                    <td width="20%">
                                        <a href="#" class="btn btn-info"><i
                                                class="fa fa-eye"></i> Lihat Detail</a>
                                                                               {{-- <a href="javascript:void(0);" data-toggle="modal"--}}
                                        {{--                                           data-target="#updateResource-{{ $item['id'] }}" class="btn btn-success"><i--}}
                                        {{--                                                class="fa fa-pencil"></i> Ubah</a> --}}
                                        <a href="javascript:void(0);"
                                           onclick="destroy('{{ $item['id'] }}', '{{ $item['nama'] }}')"
                                           class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                                    </td>
                                </tr>
                                @component('components.modal', ['id'=> 'updateResource-' . $item['id']])
                                    @slot('title')
                                        Ubah Posisi
                                    @endslot
                                    @slot('content')
                                        <form action="{{ route('posisi.update', $item) }}" method="POST">
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
            Tugaskan Peserta
        @endslot
        @slot('content')
            <form action="{{ route('pkl.store') }}" method="POST">
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
                        <label for="peserta">Nama / Email Peserta</label>
                        <select name="peserta_id" id="peserta" class="form-control"></select>
                    </div>
                    @can('admin')
                        <div class="form-group">
                            <label for="pembimbing">Nama / Email Pembimbing</label>
                            <select name="pembimbing_id" id="pembimbing" class="form-control"></select>
                        </div>
                    @else
                        @php
                            $user = auth()->user();
                            $pembimbing = $user->authenticable;
                        @endphp
                        <div class="form-group">
                            <label for="pembimbing">Nama Pembimbing</label>
                            <input type="hidden" name="pembimbing_id" value="{{ $pembimbing['id'] }}">
                            <div>
                                {{ $pembimbing['nama'] }}
                            </div>
                        </div>
                    @endcan
                    <div class="form-group">
                        <label for="posisi">Posisi / Divisi</label>
                        <select name="posisi_id" id="posisi" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        @endslot
    @endcomponent
    @include('components.peserta-info-modal')
@endsection
@push('scripts')
    <script>
        @if(session()->has('showCreateModal'))
        $(() => {
            $('#createNew').modal('show');
        });
        @endif
    </script>
    <script>
        $('#createNew').on('shown.bs.modal', function () {
            setupSelect.init('#peserta', '{{ route('resource.peserta') }}', 'Pilih Peserta', '{{ old('peserta_id') }}');
            setupSelect.init('#posisi', '{{ route('resource.posisi') }}', 'Pilih Posisi / Divsi', '{{ old('posisi_id') }}');
            @can('admin')
            setupSelect.init('#pembimbing', '{{ route('resource.pembimbing') }}', 'Pilih Pembimbing', '{{ old('pembimbing_id') }}');
            @endcan
        });

        function destroy(id, name) {
            swal({
                title: "Apa anda yakin?",
                text: "Akan Menghapus Peserta " + name,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('posisi.destroy', ':id') }}";
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
