@extends('layouts.admin.application', ['noFrame' => true, 'bodyClasses' => ''])

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('title')
    Password Reset
@stop

@section('header')
    Password Reset
@stop

@section('content')
    <form action="{!! action('Admin\PasswordController@postResetPassword') !!}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" class="form-control" name="password_confirmation">
        <button type="submit">@lang('admin.pages.auth.buttons.reset')</button>
    </form>
@stop
