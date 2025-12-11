@extends('layout.index')
@section('title', 'Создать итем')

@section('main')
    <div class="main-content" style="padding-top: 80px; margin-top: -80;">
        <div class="container">
            <div class="light-wrapper">
                <div class="headline text-center">
                    <h1>Создать категорию</h1>
                </div>
                <div class="container">

                    <form action="{{ route('item-category.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Название категории</label>
                            <input type="text" class="form-control" id="category_name" name="category_name">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Создать Категорию</button>
                            <a href="{{ route('home.index') }}" class="btn btn-secondary">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
