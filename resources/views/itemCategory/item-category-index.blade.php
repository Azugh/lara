@extends('layout.index')
@section('title', 'Items')

@section('main')
    <div class="main-content" style="padding-top: 80px; margin-top: -80;">
        <div class="container">
            <h1>Категории</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('item-category.create') }}" class="btn btn-primary mb-3">Создать новый категорию</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>название</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <a href="{{ route('item-category.edit', $category) }}"
                                    class="btn btn-sm btn-warning">Изменить</a>
                                <form action="{{ route('item-category.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Да или Да?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
