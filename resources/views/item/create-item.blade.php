@extends('layout.index')
@section('title', 'Создать итем')

@section('main')
    <div class="main-content" style="padding-top: 80px; margin-top: -80;">
        <div class="container">
            <div class="light-wrapper">
                <div class="headline text-center">
                    <h1>Создать новый итем</h1>
                </div>
                <div class="widget-header">

                    <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Название итема</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Изображение</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*" value="{{ old('image') }}">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Допустимые форматы: JPEG, PNG, GIF, WebP. Максимальный размер: 5MB
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Категории</label>
                            <div class="row">
                                @foreach ($categories as $category)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" name="category[]" id="category_{{ $category->id }}"
                                                value="{{ $category->id }}" class="form-check-input">
                                            <label class="form-check-label" for="category_{{ $category->id }}">
                                                {{ $category->category_name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Создать Item</button>
                            <a href="{{ route('home.index') }}" class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
