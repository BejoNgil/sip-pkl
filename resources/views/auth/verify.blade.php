@extends('layouts.app')
@section('page-header', 'Anda belum verifikasi email')
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('Mohon Verifikasi, Email Address') }}</div>
                <div class="panel-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Mohon cek email untuk melihat link verifikasi') }}
                    {{ __('atau Kirim ulang jika kamu belum mendapat email verifikasi') }},
                   <div class="mt-3">
                       <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                           @csrf
                           <button type="submit" class="btn btn-info">{{ __('Kirim Ulang Verifikasi Email') }}</button>
                       </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
