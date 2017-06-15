@extends('layouts.user.application', ['noFrame' => true, 'bodyClasses' => ''])

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('title')
    Sign In
@stop

@section('header')
    Sign In
@stop

@section('content')
    <div class="p-auth-box">
        <form action="{!! action('User\AuthController@postSignIn') !!}" method="post">
            {!! csrf_field() !!}
            <div class="p-auth-box__inner">
                <h4 class="p-auth-box__header">Sign In</h4>
                <div class="input-group">
                <span class="p-auth-box__label">
                    <i class="p-auth-box__icon fa fa-envelope"></i>
                </span>
                    <input type="email" name="email" class="p-auth-box__field"
                           placeholder="@lang('user.pages.auth.messages.email')">
                </div>
                <div class="input-group">
                <span class="p-auth-box__label">
                    <i class="p-auth-box__icon fa fa-key"></i>
                </span>
                    <input type="password" name="password" class="p-auth-box__field"
                           placeholder="@lang('user.pages.auth.messages.password')">
                </div>

                <div class="input-group">
                    <input id="remember-me" type="checkbox" name="remember_me" class="p-auth-box__field" value="1"> <label
                        for="remember-me">@lang('user.pages.auth.messages.remember_me')</label>
                </div>

            </div>

            <button class="p-auth-box__button">@lang('user.pages.auth.buttons.sign_in')</button>
            <p class="p-auth-box__link"><a href="{!! action('User\PasswordController@getForgotPassword') !!}">@lang('user.pages.auth.messages.forgot_password')</a></p>
        </form>
    </div>

@stop
