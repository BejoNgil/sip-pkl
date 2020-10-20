@extends('layouts.app')
@php
    $user = auth()->user();
@endphp
@section('page-header')
    Oops, Kamu belum terdaftar
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning">
                Hai, {{ $user['authenticable']['nama'] }}. Anda belum ditugaskan menjadi peserta PKL, hubungi admin / pembimbing untuk mendaftarkan akun anda.
            </div>
        </div>
    </div>
@endsection
