@extends('admin.layout.index')
@section('title', 'Админка')

@section('loader')
    @include('admin.layout.loader')
@endsection

@section('navbar')
    @include('admin.layout.navbar')
@endsection

@section('main')
    @include('admin.layout.app')
@endsection
