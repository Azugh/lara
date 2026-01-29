@extends('admin.layout.app')
@section('title', 'Корзины')

@section('content')
    <div id="content" class="main-content">
        <div class="content main-content">
            <div class="container">

                <!-- BREADCRUMB -->
                {{-- <div class="page-meta">
                    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Form</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Slider</li>
                        </ol>
                    </nav>
                </div> --}}
                <!-- /BREADCRUMB -->
                <div class="container">
                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 layout-spacing">
                            <div class="col-lg-12">
                                <div class="statbox widget box box-shadow">
                                    <h4 class="mb-4">Слайдеры</h4>

                                    <div class="row layout-top-spacing">
                                        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                            <div class="widget-content widget-content-area align-baseline">
                                                <div class="dataTables_wrapper container-fluid">
                                                    @if($carts->count() > 0)
                                                        <table id="zero-config" class="table dt-table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">ID
                                                                </th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">Изображение
                                                                </th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">Заголовок
                                                                </th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">Текст слайдера
                                                                </th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">Текст кнопки
                                                                </th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 100.100px">Слайдер активен?
                                                                </th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">Действия
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($carts as $cart)
                                                                <tr>
                                                                    <td>{{ $cart->id }}</td>
{{--                                                                    <td>--}}
{{--                                                                        @if($cart->image)--}}
{{--                                                                            --}}{{--                                                                            @dd(Storage::url($slider->image))--}}
{{--                                                                            <img src="{{ $cart->image }}"--}}
{{--                                                                                 width="300" alt="{{$cart->title}}">--}}
{{--                                                                        @endif--}}
{{--                                                                    </td>--}}
                                                                    <td>{{ $cart->user->name }}</td>
                                                                    <td>{{ $cart['total_price'] }}</td>
                                                                    <td>{{ $cart['total_quantity'] }}</td>
{{--                                                                    <td>--}}
{{--                                                                        @if($cart->isActive)--}}
{{--                                                                            Да--}}
{{--                                                                        @else--}}
{{--                                                                            Нет--}}
{{--                                                                        @endif--}}
{{--                                                                    </td>--}}
{{--                                                                    <td>--}}
{{--                                                                        <div class="list">--}}
{{--                                                                            <div class="row">--}}
{{--                                                                                <div--}}
{{--                                                                                    class="col-xs-12 col-lg-12 col-sm-12">--}}
{{--                                                                                    <a--}}
{{--                                                                                        href="{{ route('home.index', $cart->id) }}"--}}
{{--                                                                                        class="btn btn-warning">Редактировать</a>--}}
{{--                                                                                </div>--}}
{{--                                                                                <a href="{{ route('admin.slider.show', $cart->id) }}"--}}
{{--                                                                                   class="btn btn-warning">Детали</a>--}}

{{--                                                                                <form--}}
{{--                                                                                    action="{{ route('admin.slider.destroy', $cart->id) }}"--}}
{{--                                                                                    method="POST" class="d-inline">--}}
{{--                                                                                    @csrf--}}
{{--                                                                                    @method('DELETE')--}}
{{--                                                                                    <button type="submit"--}}
{{--                                                                                            class="btn btn-primary"--}}
{{--                                                                                            onclick="return confirm('Удалить?')">--}}
{{--                                                                                        Удалить--}}
{{--                                                                                    </button>--}}
{{--                                                                            </div>--}}
{{--                                                                        </div>--}}
{{--                                                                        </form>--}}
{{--                                                                    </td>--}}
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                        <p>Нет слайдеров.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
