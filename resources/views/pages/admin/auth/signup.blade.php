@extends('layouts.admin.application', ['noFrame' => true, 'bodyClasses' => ''])

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
    <form action="{!! action('Admin\AuthController@postSignUp') !!}" method="post">
        {!! csrf_field() !!}
        <input type="email" name="email" placeholder="@lang('admin.pages.auth.messages.email')">
        <input type="password" name="password" placeholder="@lang('admin.pages.auth.messages.password')">
        <input type="checkbox" name="remember_me" value="1"> @lang('admin.pages.auth.messages.remember_me')
        <button type="submit">@lang('admin.pages.auth.buttons.sign_up')</button>
    </form>
    <br>
@stop
