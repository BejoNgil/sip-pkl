@extends('layouts.app')
@section('page-header')
    Dashboard
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            @if($user->role === 'peserta')
                @include('peserta.dashboard', ['user' => $user])
            @elseif($user->role == 'pembimbing')
                @include('pembimbing.dashboard', ['stats' => $stats])
            @else
                @include('administrator.dashboard', ['stats' => $stats])
            @endif
        </div>
    </div>
@endsection
