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
                            <h1>Reset Password</h1>
                            <p class="text-muted">@lang('admin.pages.auth.messages.reset_password')</p>
                            <form method="post" action="{{ action('Admin\PasswordController@postResetPassword') }}">
                                {{ csrf_field() }}
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <input type="text" name="email" class="form-control" placeholder="Email Address">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="New Password">
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="New Password Type Again">
                                </div>
                                <input type="hidden" name="token" value="{{ $token }}"/>
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit"
                                                class="btn btn-primary px-4">@lang('admin.pages.auth.buttons.reset')</button>
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

