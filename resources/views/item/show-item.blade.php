@extends('layout.index')
@section('title', $item->name)

@section('main')
    <div class="main-content" style="padding-top: 80px; margin-top: auto;">
        <div class="container">
            {{--            <h1>итемы</h1>--}}

            <div class="flex-row">
                <div class="w-auto flex-grow-1 col-md-6">
                    <div class="w-auto flex-grow-1">
                        <img src="{{ $item->image }}" alt="{{ $item->name }}"
                             class="img-fluid w-100 h-100 object-fit-cover" style="height: 350px; width: 350px">
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
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="number" id="quantity" value="1" name="quantity" min="0"
                                               max="{{ $item->quantity }}">
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary"
                                                @empty($item->quantity) disabled @endempty>Добавить в корзину</button>
                                    </div>
                                </div>
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
        </div>
    </div>
@endsection

