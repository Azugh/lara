@extends('layout.index')
@section('title', 'Главная')

@section('main')
    @include('layout.carousel')

    <div class="section-title text-center">
        <h3>The Product Gallery</h3>
        <p class="lead">awesome products prepared with creative ideas and great design</p>
    </div>

    @include('item.item-index')
@endsection
