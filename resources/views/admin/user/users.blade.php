@extends('admin.layout.app')
@section('title', 'Слайдеры')

@section('content')
    <div id="content" class="main-content">
        <div class="content main-content">
            <div class="container">

                <div class="container">
                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 layout-spacing">

                            <div class="col-lg-12">
                                <div class="statbox widget box box-shadow">
                                    @if(\Illuminate\Support\Facades\Auth::user())
                                        {{\Illuminate\Support\Facades\Auth::user()->id}}
                                    @else
                                        не логин
                                    @endif
                                    <h4 class="mb-4">Пользователи </h4>

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
                                                                <th>email подтвержден</th>
                                                                <th>Сообщение</th>
                                                                <th>Действия</th>
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
                                                                        @if($user->email_verified_at)
                                                                            Да
                                                                        @else
                                                                            Нет
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $user->message }}</td>

                                                                    <td>
                                                                        <div class="list">
                                                                            <div class="row">

                                                                                <form
                                                                                    action="{{route('verifyUser', $user->id)}}"
                                                                                    method="POST" class="d-inline">
                                                                                    @csrf
                                                                                    <button type="submit"
                                                                                            class="btn btn-success">
                                                                                        Подтвердить
                                                                                    </button>
                                                                                </form>
                                                                                <form
                                                                                    action="{{ route('slider.destroy', $user->id) }}"
                                                                                    method="POST" class="d-inline">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit"
                                                                                            class="btn btn-secondary"
                                                                                            onclick="return confirm('Удалить?')">
                                                                                        Удалить
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


    </div>

@endsection
