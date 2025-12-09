@extends('admin.layout.index')

@section('title', 'Создание слайдера')


@section('loader')
    @include('admin.layout.loader')
@endsection

@section('navbar')
    @include('admin.layout.navbar')
@endsection

@section('main')
    @include('admin.layout.sidebar')
    <br>
    <br><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Создание нового слайдера</h4>
                        <a href="{{ route('admin.index') }}" class="btn btn-sm btn-secondary float-end">
                            Назад к списку
                        </a>
                    </div>

                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Заголовок</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Контент</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                                name="content" rows="4">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="btn_txt" class="form-label">Текст кнопки</label>
                            <input type="text" class="form-control @error('btn_txt') is-invalid @enderror" id="btn_txt"
                                name="btn_txt" value="{{ old('btn_txt') }}">
                            @error('btn_txt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Изображение</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Допустимые форматы: JPEG, PNG, GIF, WebP. Максимальный размер: 5MB
                            </small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Создать слайдер</button>
                            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
