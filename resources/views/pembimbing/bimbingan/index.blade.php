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
                                <th>Peserta</th>
                                <th>Tanggal</th>
                                <th>Uraian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pkl as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#pesertaInfo"
                                           data-id="{{ $item->peserta->id }}">{{ $item->peserta->nama }}</a>
                                    </td>
                                    <td>
                                        @if (!empty($item->bimbingan_one->tanggal))
                                        {{ $item->bimbingan_one->tanggal->format('d M Y')}}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($item->bimbingan_one->uraian))
                                            {{ $item->bimbingan_one->uraian }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->bimbingan_one->is_approve }}
                                        @if (!empty($item->bimbingan_one->is_approve))
                                        {{ ($item->bimbingan_one->is_approve == true) ? 'Sudah disetujui' : 'Belum disetuji' }}
                                        @endif
                                    </td>
                                    <td width="15%">
                                        @if (!empty($item->bimbingan['0']['id']))
                                        <a href="{{ route('kelola-bimbingan.show', $item->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Detail</a>
                                        @endif

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
