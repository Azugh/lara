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
                        <div class="col-lg-12 layout-spacing">
                            <div class="col-lg-12">
                                <div class="statbox widget box box-shadow">
                                    <h4 class="mb-4">Слайдеры</h4>

                                    <div class="row layout-top-spacing">
                                        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                            <div class="widget-content widget-content-area align-baseline">
                                                <div class="dataTables_wrapper container-fluid">
                                                    <table id="zero-config" class="table dt-table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                style="width: 300.300px">ID
                                                            </th>
                                                            <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                style="width: 300.300px">Пользователь
                                                            </th>
                                                            <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                style="width: 300.300px">Общая цена
                                                            </th>
                                                            <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                style="width: 300.300px">Всего товара
                                                            </th>
                                                            <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                style="width: 300.300px">Адрес
                                                            </th>
                                                            <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                style="width: 100.100px">Статус доставки
                                                            </th>
                                                            <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                style="width: 300.300px">Статус оплаты
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>{{ $order->id }}</td>
                                                            <td>{{ $order->user->name }}</td>
                                                            <td>{{ $order['total_price'] }} Руб</td>
                                                            <td>{{ $order['total_quantity'] }}</td>
                                                            <td>{{ $order['shipping_address'] }}</td>
                                                            <td>{{ $order['shipping_status'] }}</td>

                                                            <td>{{ $order['payment_status'] }} </td>

                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                    <table>
                                                        <thead>

                                                        </thead>
                                                        <tbody>
                                                        @foreach($order->orderItems as $orderItem)
                                                            <tr>
                                                                <td>{{ $orderItem->item->name }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <table>

                                                        </table>
                                                        <form
                                                            action="{{ route('order.update',  $order->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="shipping_status" class="form-control">
                                                                <option value="">Опции</option>
                                                                @foreach(ShippingStatus::cases() as $status)
                                                                    <option value="{{$status->value}}"
                                                                        @selected(old('status', $status) == $status->value)>
                                                                        {{ $status->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <button type="submit"
                                                                    class="btn btn-primary">
                                                                Сохранить
                                                            </button>
                                                        </form>
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
