@extends('layouts.base-app')
@push('style')
<link href="{{  asset('assets/js/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet" />
<link href="{{  asset('assets/css/summernote.min.css') }}" rel="stylesheet" />
@endpush
@section('body', 'default')
@section('content')
    @include('partials.navbar')
    @include('partials.sidebar')
    <div id="page-wrapper">
        <div class="header">
            <h1 class="page-header">
                @yield('page-header')
            </h1>
            {{-- <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Empty</a></li>
                <li class="active">Data</li>
            </ol> --}}
        </div>
        <div id="page-inner">
            @yield('main')
            <footer>
                <p>{{ config('app.name') }} {{ today()->year }} - All right reserved</p>
            </footer>
        </div>
        <!-- /. PAGE INNER  -->
    </div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/js/dataTables/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/summernote.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.data-table').dataTable();
    });
</script>
@endpush
