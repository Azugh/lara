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
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label>
                                        <input type="text" name="name" placeholder="Ваше имя">
                                        <i class="icon-user"></i>
                                    </label>
                                </div>
                                {{-- /.form-field --}}
                            </div>
                            {{-- /column --}}
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label>
                                        <input type="email" name="email" placeholder="Ваш e-mail"
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
                                        <input type="tel" name="tel" placeholder="Телефон: 8-xxx-xxx-xx-xx"
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
                                        <select name="department">
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
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label>
                                        <input type="password" name="password" placeholder="Пароль"
                                               class="@error('password') is-invalid @enderror">
                                        <i class="icon-key"></i>
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </label>
                                </div>
                                <!--/.form-field -->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-field">
                                    <label>
                                        <input type="password" name="password-confirmation" placeholder="Повторите пароль"
                                               class="@error('password-confirmation') is-invalid @enderror">
                                        <i class="icon-key"></i>
                                        @error('password-confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </label>
                                </div>
                                <!--/.form-field -->
                            </div>

                        </div>
                        <textarea name="message" placeholder="Type your message here..."></textarea>
                        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>


                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
