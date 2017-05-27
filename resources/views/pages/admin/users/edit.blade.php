@extends('layouts.admin.application', ['menu' => 'user'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('title')
    {{ $user->id }} | Users | Admin
@stop

@section('header')
    Users
@stop

@section('breadcrumb')
    <li class="c-admin__breadcrumb"><a href="{!! action('Admin\UserController@index') !!}"><i class="fa fa-files-o"></i>
            Users</a></li>
    @if( $isNew )
        <li class="c-admin__breadcrumb c-admin__breadcrumb--is-active">New</li>
    @else
        <li class="c-admin__breadcrumb c-admin__breadcrumb--is-active">{{ $user->id }}</li>
    @endif
@stop

@section('content')
    <form
        @if( $isNew )
        action="{!! action('Admin\UserController@store') !!}" method="POST" enctype="multipart/form-data">
        @else
            action="{!! action('Admin\UserController@update', [$user->id]) !!}" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
        @endif
        {!! csrf_field() !!}
        <div class="c-admincrud__form @if ($errors->has('name')) c-admincrud__form--is-error @endif">
            <label for="name">@lang('admin.pages.users.columns.name')</label>
            <input type="text" id="name" name="name" value="{{ old('name') ? old('name') : $user->name }}">
        </div>

        <div class="c-admincrud__form @if ($errors->has('email')) c-admincrud__form--is-error @endif">
            <label for="email">@lang('admin.pages.users.columns.email')</label>
            <input type="email" id="email" name="email" value="{{ old('email') ? old('email') : $user->email }}">
        </div>

        <div class="c-admincrud__form @if ($errors->has('password')) c-admincrud__form--is-error @endif">
            <label for="password">@lang('admin.pages.users.columns.password')</label>
            <input type="password" id="password" name="password" value="">
        </div>

        <div class="c-admincrud__form @if ($errors->has('profile_image')) c-admincrud__form--is-error @endif">
            @if( !empty($user->profileImage) )
                <img id="profile-image-id-preview" src="{!! $user->profileImage->getThumbnailUrl(300, 300) !!}" alt=""
                     class="c-admincrud__preview-image"/>'
            @else
                <img id="profile-image-id-preview" src="{!! \URLHelper::asset('img/user.png', 'common') !!}" alt=""
                     class="c-admincrud__preview-image"/>'
            @endif
            <label for="profile_image">@lang('admin.pages.users.columns.profile_image')</label>
            <input type="file" class="c-admincrud__image-field" id="profile_image" name="profile_image">
        </div>
        <button type="submit" class="button">@lang('admin.pages.common.buttons.save')</button>
    </form>
@stop
