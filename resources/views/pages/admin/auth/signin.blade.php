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
                            <h1>Sign In</h1>
                            <p class="text-muted">@lang('admin.pages.auth.messages.please_sign_in')</p>
                            <form method="post" action="{{ action('Admin\AuthController@postSignIn') }}">
                                {{ csrf_field() }}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" name="email" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <button type="submit" class="btn btn-primary px-4">@lang('admin.pages.auth.buttons.sign_in')</button>
                                    </div>
                                    <div class="col-7 text-right">
                                        <a href="{{ action('Admin\PasswordController@getForgotPassword') }}"
                                           class="btn btn-link px-0">@lang('admin.pages.auth.messages.forgot_password')</a>
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
