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
                                            <h4>Изменение слайдера</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <form action="{{ route('slider.update', ['slider' => $slider->id])  }} " method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="col-lg-12 layout-top-spacing">
                                            <div class="mb-3">
                                                <input type="checkbox" value="1" name="isActive" id="isActive"
                                                    for="isActive" class="form-check-label" value="{{ $slider->isActive }}">
                                                <label for="isActive">Слайдер активен?</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Заголовок</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" value="{{ $slider->title }}">
                                            {{-- value="{{ old('title') }}"> --}}
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label for="content" class="form-label">Контент</label>
                                            <input type="content" class="form-control @error('title') is-invalid @enderror"
                                                id="cont" name="content" value="{{ $slider->title }}">
                                            {{-- value="{{ old('title') }}"> --}}
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label for="content" class="form-label">Контент</label>

                                            <input type="text" class="form-control @error('content') is-invalid @enderror"
                                                id="content" name="content" value="{{ $slider->content }}">
                                            @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> --}}


                                        <div class="mb-3">
                                            <label for="btn_text" class="form-label">Текст кнопки</label>
                                            <input type="text" class="form-control @error('btn_text') is-invalid @enderror"
                                                id="btn_text" name="btn_text" value="{{ $slider->btn_text }}">
                                            @error('btn_text')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Изображение</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                id="image" name="image" accept="image/*"
                                                value="{{ Storage::url($slider->image) }}">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">
                                                Допустимые форматы: JPEG, PNG, GIF, WebP. Максимальный размер: 5MB
                                            </small>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">Изменить слайдер</button>
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
