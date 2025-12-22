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
                    <form action="{{ route('register_request.store') }}" method="POST">
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
                                        <input type="email" name="email" for="email" placeholder="Ваш e-mail"
                                            class="@error('email') is-invalid @enderror">
                                        <i class="icon-mail-alt"></i></label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- /.form-field --}}
                            </div>
                            {{-- /column --}}
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label>
                                        <input type="tel" name="tel" for="tel" placeholder="Телефон: 8-xxx-xxx-xx-xx"
                                            class="@error('tel') is-invalid @enderror">
                                        <i class="icon-phone"></i>
                                        @error('tel')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </label>
                                </div>
                                <!--/.form-field -->
                            </div>
                            {{-- /column --}}
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label class="custom-select">
                                        <select name="department" name="department" for="department">
                                            <option value="">Выберите Департамент</option>
                                            <option value="Продажи">Продажи</option>
                                            <option value="Маркетинг">Маркетинг</option>
                                            <option value="Поддержка пользователя">Поддержка пользователя</option>
                                            <option value="Другой">Другой</option>
                                        </select>
                                        <i class="icon-ok"></i><span></span>
                                    </label>
                                </div>

                            </div>
                        </div>
                        <textarea name="message" for="message" placeholder="Type your message here..."></textarea>
                        <button type="submit" class="btn btn-primary">Создать слайдер</button>


                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection