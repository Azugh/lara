@php use App\Enums\ShippingStatus; @endphp
@extends('admin.layout.app')
@section('title', 'Заказы')

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
                        <div class="col-lg-6">
                            <div class="widget box box-shadow">
                                <h4 class="mb-4">Заказ №{{ $order->id }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column col-xl-4 col-lg-4 col-md-12 layout-top-spacing">
                            <div class=" align-baseline">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mt-4">Заказ</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="dataTables_wrapper container-fluid">

                                            <table class="table dt-table-hover">
                                                <tbody class="">
                                                <tr>
                                                    <th>Пользователь</th>
                                                    <td>{{ $order->user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Общая цена</th>
                                                    <td>{{ $order->total_price }} Руб.</td>
                                                </tr>
                                                <tr>
                                                    <th>Количество товара</th>
                                                    <td>{{ $order->total_quantity }} шт.</td>
                                                </tr>
                                                <tr>
                                                    <th>Адрес доставки</th>
                                                    <td>{{ $order->shipping_address }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Статус заказа</th>
                                                    <td>{{ $order->shipping_status->getLabel() }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Статус оплаты</th>
                                                    <td>{{ $order->payment_status->getLabel() }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Дата оплаты</th>
                                                    <td>{{ $order->payment_date }}</td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="card-footer">
                                            <h5>Статус заказа</h5>
                                            <div class="container">
                                                <form
                                                    action="{{ route('order.update-shipping-status',  $order->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row align-content-center mt-2">
                                                        <div class="col-md-6">
                                                            <select name="shipping_status"
                                                                    class="form-control col-md-12">
                                                                @foreach(ShippingStatus::cases() as $status)
                                                                    <option value="{{$status->value}}"
                                                                        @selected(old('status', $status) == $status->value)>
                                                                        {{ $status->getLabel() }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mt-1">
                                                            <button type="submit"
                                                                    class="btn btn-primary">
                                                                Сохранить
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column col-xl-8 col-lg-8 col-md-12 layout-top-spacing">
                            <div class="align-baseline">
                                <div class="card">
                                    <div class="mt-4 card-header">
                                        <h5>Подробнее о заказе</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="dataTables_wrapper container-fluid">

                                            <table class="table dt-table-hover">
                                                <thead>
                                                <tr>
                                                    <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                        style="width: 300px">ID товара
                                                    </th>
                                                    <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                        style="width: 300px">Изображение
                                                    </th>
                                                    <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                        style="width: 300px">Название товара
                                                    </th>
                                                    <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                        style="width: 300px">Количество товара
                                                    </th>
                                                    <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                        style="width: 300px">Цена за штуку
                                                    </th>
                                                    <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                        style="width: 300px">Всего за позицию
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($order->orderItems as $orderItem)
                                                    <tr style="text-align: center; vertical-align: middle;">
                                                        <td>
                                                            {{ $orderItem->item->id }}
                                                        </td>
                                                        <td>
                                                            @if($orderItem->item->image)
                                                                <img src="{{ $orderItem->item->image }}"
                                                                     alt="{{ $orderItem->item_name }}"
                                                                     style="width: 80px; height: 80px; object-fit: contain;">
                                                            @endif
                                                        </td>
                                                        <td>{{ $orderItem->item_name }}</td>
                                                        <td>{{ $orderItem->quantity }}</td>
                                                        <td>{{ $orderItem->item->price }} ₽</td>
                                                        <td>{{ $orderItem->item->price * $orderItem->quantity }}₽
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                            <div class="card-footer">

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
