@extends('admin.layout.index')
@section('title', 'Админка')

@section('loader')
    @include('admin.layout.loader')
@endsection

@section('navbar')
    @include('admin.layout.navbar')
@endsection

@section('main')
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>
        @include('admin.layout.sidebar')

        @yield('content')

        @include('admin.layout.footer')
    </div>
@endsection