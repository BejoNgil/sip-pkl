@extends('layouts.app')
@section('title', 'Laporan PKL')
@section('page-header')
    Laporan PKL
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <form action="{{ route('laporan-pkl.pdf') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="nama">Pembimbing</label>
                                    {{ Form::select('pembimbing', $pembimbing, null, array('class'=>'form-control', 'placeholder'=>'Silahkan pilih Pembimbing...')) }}
                                </div>
                                <div class="form-group">
                                    <label for="nama">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="tgl_mulai">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="tgl_selesai">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Divisi</label>
                                    {{ Form::select('divisi', $divisi, null, array('class'=>'form-control', 'placeholder'=>'Silahkan pilih Divisi...')) }}
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="float-right btn btn-primary">
                                            Cetak PDF
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
