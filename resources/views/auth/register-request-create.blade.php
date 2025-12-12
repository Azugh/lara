@extends('layout.index')
@section('title', 'Регистрация')

@section('main')

    <div class="divide30"></div>
    <div class="light-wrapper">
        <div class="container inner">
            <div class="section-title text-center">
                <h2 class="post-title">Регистрация</h2>
                <div class="divide20"></div>
                <div class="form-container">
                    {{-- TODO --}}
                    <form action="{{ route('register-request.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label>
                                        <input type="text" name="name" for="name" placeholder="Ваше имя">
                                        <i class="icon-user"></i>
                                    </label>
                                </div>
                                {{-- /.form-field --}}
                            </div>
                            {{-- /column --}}
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label>
                                        <input type="email" name="email" for="email" placeholder="Ваш e-mail">
                                        <i class="icon-mail-alt"></i></label>
                                </div>
                                {{-- /.form-field --}}
                            </div>
                            {{-- /column --}}
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label>
                                        <input type="tel" name="tel" for="tel" placeholder="Телефон">
                                        <i class="icon-phone"></i></label>
                                </div>
                                <!--/.form-field -->
                            </div>
                            {{-- /column --}}
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label class="custom-select">
                                        <select name="department" name="department" for="department">
                                            <option value="">Выберите Департамент</option>
                                            <option value="Sales">Продажи</option>
                                            <option value="Marketing">Маркетинг</option>
                                            <option value="Support">Поддержка пользователя</option>
                                            <option value="Other">Другой</option>
                                        </select>
                                        <i class="icon-ok"></i><span></span>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <textarea name="message" for="message" placeholder="Type your message here..."></textarea>
                        <input type="submit" class="btn" value="Отправить" data-error="Fix errors"
                            data-processing="Sending..." data-success="Thank you!">
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection