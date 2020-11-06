@extends('layouts.app')
@section('title', 'Kelola Bimbingan')
@section('page-header')
    Kelola Bimbingan
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
                                <th>Uraian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($bimbingan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['tanggal']->format('d M Y') }}</td>
                                    <td>{{ $item['uraian'] }}</td>
                                    <td>{{ $item['is_approve'] ? 'Sudah disetujui' : 'Belum disetujui' }}</td>
                                    <td width="15%">
                                        @if(!$item['is_approve'])
                                            <a href="javascript:void(0);" data-toggle="modal"
                                               data-target="#updateResource-{{ $item['id'] }}"
                                               class="btn btn-success"><i
                                                    class="fa fa-pencil"></i> Konfirmasi</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                @if(!$item['is_approve'])
                                    @component('components.modal', ['id'=> 'updateResource-' . $item['id']])
                                        @slot('title')
                                            Konfirmasi Bimbingan
                                        @endslot
                                        @slot('content')
                                            <form action="{{ route('kelola-bimbingan.approve', $item) }}" method="POST">
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
                                                        <label>Uraian</label>
                                                        <div>
                                                            {{ $item['uraian'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Setujui</button>
                                                </div>
                                            </form>
                                        @endslot
                                    @endcomponent
                                @endif
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
