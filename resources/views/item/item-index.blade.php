@extends('layout.index')
@section('title', 'Items')

@section('main')
    <div class="main-content" style="padding-top: 80px; margin-top: -80;">
        <div class="container">
            <h1>итемы</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('item.create') }}" class="btn btn-primary mb-3">Создать новый итем в категории</a>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Категории</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @foreach($item->categories as $category)
                                    <span class="bg-secondary">{{ $category->category_name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('item.edit', $item) }}" class="btn btn-sm btn-warning">Изменить</a>
                                <form action="{{ route('item.destroy', $item) }}" method="POST">
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
