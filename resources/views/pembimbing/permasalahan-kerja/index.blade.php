@extends('layouts.app')
@section('title', 'Kelola Permasalahan Kerja')
@section('page-header')
    Kelola Permasalahan Kerja
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover data-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Peserta</th>
                                <th>Masalah</th>
                                <th>Solusi</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($permasalahanKerja as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['tanggal']->format('d M Y') }}</td>
                                    <td><a href="javascript:void(0);" data-toggle="modal" data-target="#pesertaInfo"
                                           data-id="{{ $item['pkl']['peserta']['id'] }}">{{ $item['pkl']['peserta']['nama'] }}</a>
                                    </td>
                                    <td>{{ $item['masalah'] }}</td>
                                    <td>{{ $item['solusi'] ?? '-' }}</td>
                                    <td width="15%">
                                        <a href="javascript:void(0);" data-toggle="modal"
                                           data-target="#updateResource-{{ $item['id'] }}"
                                           class="btn btn-success"><i
                                                class="fa fa-pencil"></i> {{ $item['solusi'] != null ? 'Ubah Solusi' : 'Beri Solusi' }}
                                        </a>
                                    </td>
                                </tr>
                                @component('components.modal', ['id'=> 'updateResource-' . $item['id']])
                                    @slot('title')
                                        {{ $item['solusi'] != null ? 'Ubah Solusi' : 'Beri Solusi' }}
                                    @endslot
                                    @slot('content')
                                        <form action="{{ route('kelola-masalah.update', $item) }}"
                                              method="POST">
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
                                                    <div>
                                                        {{ $item['tanggal']->format('d M Y') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Peserta</label>
                                                    <div>
                                                        <a href="javascript:void(0);" data-toggle="modal"
                                                           data-target="#pesertaInfo"
                                                           data-id="{{ $item['pkl']['peserta']['id'] }}">{{ $item['pkl']['peserta']['nama'] }}</a>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Uraian Masalah</label>
                                                    <div>
                                                        {{ $item['masalah'] }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Solusi</label>
                                                    <textarea name="solusi" rows="5" required
                                                              class="form-control">{{ old('solusi', $item['solusi']) }}</textarea>
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
    @include('components.peserta-info-modal')
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
@endpush
