@extends('admin.layout.app')
@section('title', 'Создать слайдер')

@section('content')
    <div id="content" class="main-content">
        <div class="container">
            <div class="container">
                <div class="row layout-top-spacing">
                    <div class="col-lg-12 layout-spacing">
                        <div class="col-md-8">
                            <div class="statbox widget box box-shadow">
                                <div class="col-lg-12 layout-spacing">
                                    <div class="widget-header">
                                        <div class="row">
                                            <h4>Создание нового слайдера</h4>
                                            <a href="{{ route('slider.index') }}"
                                                class="btn btn-sm btn-secondary float-end">
                                                Назад к списку
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-lg-12 layout-top-spacing">
                                            <div class="mb-3">
                                                <input type="checkbox" value="1" name="isActive" id="isActive"
                                                    for="isActive" class="form-check-label">
                                                <label for="isActive">Слайдер активен?</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Заголовок</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" value="{{ old('title') }}">
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="mb-4">
                                                <label for="content" class="form-label">Контент</label>
                                                <textarea class="form-control @error('content') is-invalid @enderror"
                                                    id="content" name="content" rows="4">{{ old('content') }}</textarea>
                                                @error('content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="btn_text" class="form-label">Текст кнопки</label>
                                            <input type="text" class="form-control @error('btn_text') is-invalid @enderror"
                                                id="btn_text" name="btn_text" value="{{ old('btn_text') }}">
                                            @error('btn_text')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Изображение</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                id="image" name="image" accept="image/*" value="{{ old('image') }}">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">
                                                Допустимые форматы: JPEG, PNG, GIF, WebP. Максимальный размер: 5MB
                                            </small>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">Создать слайдер</button>
                                            <a href="{{ route('slider.index') }}" class="btn btn-secondary">Отмена</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection