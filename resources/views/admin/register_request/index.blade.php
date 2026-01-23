@extends('admin.layout.app')
@section('title', 'Запросы на регистрацию')

@section('content')
    <div id="content" class="main-content">
        <div class="content main-content">
            <div class="container">

                <div class="container">
                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 layout-spacing">

                            <div class="statbox widget box box-shadow">

                                <h4 class="mb-4">Запросы на регистрацию </h4>

                                <div class="row layout-top-spacing">
                                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                        <div class="widget-content widget-content-area align-baseline">
                                            <div class="dataTables_wrapper container-fluid">
                                                @if($users->count() > 0)
                                                    <table id="zero-config" class="table dt-table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Имя</th>
                                                            <th>email</th>
                                                            <th>Отдел</th>
                                                            <th>Телефон</th>
                                                            <th>Роли</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($users as $user)
                                                            <tr>
                                                                <td>{{ $user->id }}</td>

                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>{{ $user->department }}</td>
                                                                <td>{{ $user->tel }}</td>


                                                                <td>
                                                                    <div class="list">
                                                                        <div class="row">

                                                                            <form
                                                                                action="{{route('admin.register_request.verify', $user->id)}}"
                                                                                method="POST" class="d-inline">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <button type="submit"
                                                                                        class="btn btn-success">
                                                                                    Подтвердить
                                                                                </button>
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
