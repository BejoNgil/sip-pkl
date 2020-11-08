@extends('layouts.app')
@section('page-header', 'Terimakasih Email Anda telah di Verifikasi !!')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                   <div class="mt-3">
                       <a href="{{ route('home') }}" class="btn btn-danger btn-lg">Pergi Ke Halaman Dashboard</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
