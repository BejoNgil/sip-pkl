@extends('layouts.app')
@section('title', 'Nilai')
@section('page-header')
    Nilai Saya
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mb-5">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-5">Nama Pembimbing</div>
                                        <div class="col-md-6">{{ $pkl['pembimbing']['nama'] }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">Durasi PKL</div>
                                        <div class="col-md-6">{{ $pkl['tanggal_mulai']->format('d M Y') }}
                                            - {{ $pkl['tanggal_selesai'] != null ? $pkl['tanggal_selesai']->format('d M Y') : 'Sekarang'}}</div>
                                    </div>
                                </div>
                                @if(count($nilai))
                                    <div class="col-md-8">
                                        <div class="float-right">
                                            <a class="btn btn-primary" href="{{ route('download.surat', $pkl) }}">
                                                <i class="fa fa-download"></i> Download Surat Keterangan Lulus</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    </thead>
                                    <tbod>
                                        @forelse($nilai as $item)
                                            <tr>
                                                <td>{{ $item['kategori']['nama'] }}</td>
                                                <td>{{ $item['nilai'] }}</td>
                                                <td>{{ $item['keterangan'] }}</td>
                                            </tr>
                                            @if($loop->last)
                                                <tr>
                                                    <td colspan="2">Nilai Akhir</td>
                                                    <td>{{ $total }}</td>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="3">Belum ada Nilai</td>
                                            </tr>
                                        @endforelse
                                    </tbod>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
