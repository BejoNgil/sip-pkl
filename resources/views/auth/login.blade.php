@extends('layouts.base-app')
@section('body', 'white')
@section('content')
<div class="container bg-white mt-sm-5">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="text-center mb-sm-3">
                <img src="{{ asset('favicon.png') }}" alt="icon" class="mb-sm-3">
                <div><strong>{{ config('app.name') }}</strong></div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pt-sm-2 text-center">
                        Silahkan Masuk
                    </div>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email"
                                required autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukan Password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="checkbox">
                            <div class="checkbox3 checkbox-round">
                                <input type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
{{--                        @if (Route::has('password.request'))--}}
{{--                            <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                {{ __('Forgot Your Password?') }}--}}
{{--                            </a>--}}
{{--                        @endif--}}
                        <a class="btn btn-link" href="{{ route('pendaftaran.index') }}">
                            {{ __('Daftar Sebagai Peserta') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
