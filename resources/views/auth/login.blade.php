@extends('layout.index')
@section('title', 'Вход')



@section('main')

    <div class="divide30"></div>
    <div class="light-wrapper">
        <div class="container inner">
            <div class="section-title text-center">
                <h2 class="post-title">Вход</h2>
                <div class="divide20"></div>
                <div class="form-container">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="container">
                                <div class="form-field">
                                    <label>
                                        <input type="email" name="email" placeholder="Ваш e-mail"
                                               class="@error('email') is-invalid @enderror">
                                        <i class="icon-mail-alt"></i></label>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Вход</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
