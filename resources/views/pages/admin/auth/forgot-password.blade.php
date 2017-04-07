@extends('layouts.admin.application', ['noFrame' => true, 'bodyClasses' => ''])

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('title')
    Forgot Password
@stop

@section('header')
    Forgot Password
@stop

@section('content')
    <form action="{!! action('Admin\PasswordController@postForgotPassword') !!}" method="post">
        {!! csrf_field() !!}
        <input type="email" name="email" placeholder="Email">
        <button type="submit">@lang('admin.pages.auth.buttons.forgot')</button>
    </form>
@stop
