@extends('admin.layout.app')
@section('title', 'Регистрации')

@section('content')
    <div id="content" class="main-content">
        <div class="content main-content">
            <div class="container"></div>
            <div class="container">
                <div class="row layout-top-spacing">
                    <div class="col-lg-12 layout-spacing">

                        <div class="col-lg-12">
                            <div class="statbox widget box box-shadow">
                                <h4 class="mb-4">Заявки на регистрацию</h4>

                                <div class="row layout-top-spacing">
                                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                        <div class="widget-content widget-content-area align-baseline">
                                            <div class="dataTables_wrapper container-fluid">
                                                @if($registerRequests->count() > 0)
                                                    <table id="zero-config" class="table dt-table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">ID</th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">Имя</th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">Email</th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">Сообщение</th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">Телефон</th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 100.100px">Департамент</th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 100.100px">Создан</th>
                                                                <th aria-controls="zero-config" rowspan="1" colspan="1"
                                                                    style="width: 300.300px">Действия</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($registerRequests as $rr)
                                                                <tr>
                                                                    <td>{{ $rr->id }}</td>

                                                                    <td>{{ $rr->name }}</td>
                                                                    <td>{{ $rr->email }}</td>
                                                                    <td>{{ $rr->message }}</td>
                                                                    <td>{{ $rr->tel }}</td>
                                                                    <td>{{ $rr->department }}</td>
                                                                    <td>{{ $rr->created_at }}</td>

                                                                    <td>
                                                                        <div class="list">
                                                                            <div class="row ">

                                                                                <form
                                                                                    action="{{ route('register-request.update', ['register_request' => $rr->id]) }}"
                                                                                    method="POST" class="d-inline">
                                                                                    @csrf
                                                                                    @method('PATCH')
                                                                                    <button type="submit" class="btn btn-success"
                                                                                        onclick="return confirm('Подтвердить?')">Подтвердить</button>
                                                                                </form>
                                                                                <form action="{{ route('home.index', $rr->id) }}"
                                                                                    method="POST" class="d-inline">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="delete" class="btn btn-danger"
                                                                                        onclick="return confirm('Удалить?')">Удалить</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </td>
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
@endsection
