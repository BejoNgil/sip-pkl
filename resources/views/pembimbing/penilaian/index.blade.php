@extends('layouts.app')
@section('title', ' Penilaian Peserta')
@section('page-header')
    Penilaian Peserta
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
                                <th>Nama Peserta</th>
                                <th>Posisi</th>
                                <th>Nilai Akhir</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($listPKL as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($item->nilai->count() > 0)
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#pesertaInfo"
                                            data-id="{{ $item->peserta->id }}">{{ $item->peserta->nama }}
                                            ({{ $item->peserta->sekolah->nama }})</a>
                                        @else
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#pesertaInfo"
                                            data-id="{{ $item->peserta->id }}" style="color: red !important;">{{ $item->peserta->nama }}
                                            ({{ $item->peserta->sekolah->nama }})</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item['posisi']['nama'] }}
                                    </td>
                                    <td>{{ $item->total_nilai > 0 ? $item->total_nilai : '-'}}</td>
                                    <td width="20%">
                                        <a href="javascript:void(0)" data-toggle="modal"
                                           data-target="#updateResource-{{ $item['id'] }}" class="btn btn-info"><i
                                                class="fa fa-eye"></i> {{ count($item['nilai']) ? 'Ubah Nilai' : 'Beri Nilai' }}
                                        </a>
                                    </td>
                                </tr>
                                @component('components.modal', ['id'=> 'updateResource-' . $item['id']])
                                    @slot('title')
                                        {{ count($item['nilai']) ? 'Ubah Nilai' : 'Beri Nilai' }}
                                    @endslot
                                    @slot('content')
                                        <form action="{{ route('kelola-nilai.assign-nilai', $item) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type"
                                                   value="{{ count($item['nilai']) ? 'update' : 'store' }}">
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
                                                    <label>Nama Peserta</label>
                                                    <div>
                                                        <a href="javascript:void(0);" data-toggle="modal"
                                                           data-target="#pesertaInfo"
                                                           data-id="{{ $item->peserta->id }}">{{ $item->peserta->nama }}</a>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h4>Komponen Penilaian</h4>
                                                    <hr>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Kategori
                                                        </div>
                                                        <div class="col-md-3">
                                                            Nilai (1-100)
                                                        </div>
                                                        <div class="col-md-4">
                                                            Keterangan
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                @foreach($kategoriPenilaian as $i => $katPenilaian)
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4 vcenter">
                                                                {{ $katPenilaian['nama'] }}
                                                            </div>
                                                            <div class="col-md-2 vcenter">
                                                                <input type="hidden" name="nilai[id][]"
                                                                       value="{{ $katPenilaian['id'] }}">
                                                                <input type="number" class="form-control" min="1" max="100"
                                                                       name="nilai[value][]"
                                                                       value="{{ old('nilai.value.' . $i, isset($item['nilai'][$i]['kategori_penilaian_id']) && $item['nilai'][$i]['kategori_penilaian_id'] == $katPenilaian['id'] ? $item['nilai'][$i]['nilai'] : '') }}"
                                                                       required>
                                                            </div>
                                                            <div class="col-md-5 vcenter">
                                                                <textarea class="form-control"
                                                                          name="nilai[keterangan][]"
                                                                          rows="3">{{ old('nilai.keterangan.' . $i, isset($item['nilai'][$i]['kategori_penilaian_id']) && $item['nilai'][$i]['kategori_penilaian_id'] == $katPenilaian['id'] ? $item['nilai'][$i]['keterangan'] : '') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
    </script>
@endpush
