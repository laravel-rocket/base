@extends('layouts.admin.application_guest')

@section('metadata')
@stop

@section('styles')
    @parent
@stop

@section('scripts')
    @parent
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
@include('shared.admin.message-box')
                <div class="card-group">
                    <div class="card p-8">
                        <div class="card-body">
                            <h1>Forgot Password</h1>
                            <p class="text-muted">@lang('admin.pages.auth.messages.forgot_password')</p>
                            <form method="post" action="{{ action('Admin\PasswordController@postForgotPassword') }}">
                                {{ csrf_field() }}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" name="email" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit"
                                                class="btn btn-primary px-4">@lang('admin.pages.auth.buttons.forgot')</button>
                                    </div>
                                    <div class="col-6 text-right">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
