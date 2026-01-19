@extends('layout.index')
@section('title', $item->name)

@section('main')
    <div class="main-content" style="padding-top: 80px; margin-top: auto;">
        <div class="container">
            <h1>итемы</h1>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('cart-item.add', $item) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Создать слайдер</button>
                </div>
            </form>
            {{--            <table class="table">--}}
            {{--                <thead>--}}
            {{--                <tr>--}}
            {{--                    <th>ID</th>--}}
            {{--                    <th>Имя</th>--}}
            {{--                    <th>Категории</th>--}}
            {{--                    <th>Действия</th>--}}
            {{--                </tr>--}}
            {{--                </thead>--}}
            {{--                <tbody>--}}
            {{--                    <tr>--}}
            {{--                        <td>{{ $item->id }}</td>--}}
            {{--                        <td>{{ $item->name }}</td>--}}
            {{--                        <td>{{ $item->description }}</td>--}}
            {{--                        <td>{{ $item->price }}</td>--}}
            {{--                        <td>{{ $item->quantity }}</td>--}}


            {{--                    </tr>--}}
            {{--                </tbody>--}}
            {{--            </table>--}}

        </div>
    </div>
@endsection

