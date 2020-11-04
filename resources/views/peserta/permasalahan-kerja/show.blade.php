@extends('layouts.app')
@section('title', 'Detail Permasalahan Kerja')
@section('page-header')
    Detail Permasalahan Kerja
@endsection
@section('main')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Detail Permasalahan Kerja
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>{{ $permasalahanKerja->tanggal->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td>Topik</td>
                            <td>:</td>
                            <td>{{ $permasalahanKerja->topik }}</td>
                        </tr>
                        <tr>
                            <td>Status Permasalahan Kerja</td>
                            <td>:</td>
                            <td>
                                @if ($permasalahanKerja->status == 0)
                                    <span class="text-success">Open</span>
                                @else
                                    <span class="text-danger">Close</span>
                                @endif
                            </td>
                        </tr>
                        @if ($permasalahanKerja->status == 0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <form action="{{ route('detail-masalah-kerja.close', $permasalahanKerja->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Close</button>
                                </form>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @if ($permasalahanKerja->status == 0)
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="collapse-icon pull-right">
                            Silahkan Tulis Respon Disini
                        </div>
                        <h3 class="panel-title">
                            <i class="fa fa-edit"></i> &nbsp; Reply
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('detail-masalah-kerja.post', $permasalahanKerja->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="description" id="" cols="90" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @foreach ($detailPermasalahan as $item)
        <div class="row">
            <div class="col-md-8">
                @if ($item->user_id == auth()->user()->id)
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Respon PKL
                    </div>
                    <div class="panel-body">
                        {!! $item->description !!}
                    </div>
                </div>
                @else
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        Respon Pembimbing
                    </div>
                    <div class="panel-body">
                        {!! $item->description !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    @endforeach
@endsection
