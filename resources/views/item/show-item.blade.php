@extends('layout.index')
@section('title', $item->name)

@section('main')
    <div class="main-content" style="padding-top: 80px; margin-top: auto;">
        <div class="container">
            {{--            <h1>итемы</h1>--}}

            <div class="row">
                <div class="col-md-6">
                    <div class="image-thing">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="img-fluid">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="me-4">
                        <h1>{{ $item->name }}</h1>

                        <h2>Категории</h2>
                        @if($item->categories)
                            @foreach($item->categories as $category)
                                <h4>{{$category->category_name}}</h4>
                            @endforeach
                        @endif
                    </div>

                    <div class="me-4">
                        <h2>Описание</h2>
                        <h4>{{$item->description}}</h4>
                    </div>

                    <div class="me-4">
                        <form action="{{ route('cart-item.add', $item) }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Добавить в корзину</button>
                            </div>
                            @if(Session::has('success'))
                                <div class="alert alert-success alert-dismissable">{{ Session::get('success') }}</div>
                            @elseif(Session::has('error'))
                                <div class="alert alert-danger">{{ Session::get('OutOfStock') }}</div>

                        @endif
                        </form>
                    </div>
                </div>

            </div>

            {{--            <form action="{{ route('cart-item.add', $item) }}" method="POST"--}}
            {{--                  enctype="multipart/form-data">--}}
            {{--                @csrf--}}
            {{--                <div class="d-grid gap-2">--}}
            {{--                    <button type="submit" class="btn btn-primary">Добавить в корзину</button>--}}
            {{--                </div>--}}
            {{--                @if(Session::has('success'))--}}
            {{--                    <div class="alert alert-success alert-dismissable">{{ Session::get('success') }}</div>--}}
            {{--                @elseif(Session::has('error'))--}}
            {{--                    <div class="alert alert-danger">{{ Session::get('OutOfStock') }}</div>--}}

            {{--                @endif--}}


            {{--            </form>--}}
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

