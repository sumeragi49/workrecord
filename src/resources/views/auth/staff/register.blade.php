@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register_form-content">
    <div class="register_form-heading">
        <h1>会員登録</h1>
    </div>
    <form class="form" action="/register" method="post">
        @csrf
        <div class="form_group">
            <div class="form_group-title">
                <span>名前</span>
            </div>
            <div class="form_group-content">
                <div class="form_input">
                    <input type="text" name="name" value="{{ old('name') }}">
                </div>
                <div class="form_error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form_group-title">
                <span>メールアドレス</span>
            </div>
            <div class="form_group-content">
                <div class="form_input">
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="form_error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form_group-title">
                <span>パスワード</span>
            </div>
            <div class="form_group-content">
                <div class="form_input">
                    <input type="password" name="password">
                </div>
                <div class="form_error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form_group">
            <div class="form_group-title">
                <span>パスワード確認</span>
            </div>
            <div class="form_group-content">
                <div class="form_input">
                    <input type="password" name="password_confirmation">
                </div>
            </div>
        </div>
        <div class="form_button">
            <button class="form_button-submit" type="submit">登録する</button>
        </div>
    </form>
    <div class="login_link">
        <a class="login_button-submit" href="/login">ログインはこちら</a>
    </div>
</div>
@endsection