@extends('layouts.admin.application', ['menu' => 'admin_user'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('title')
    {{ $adminUser->id }} | AdminUsers | Admin
@stop

@section('header')
    AdminUsers
@stop

@section('breadcrumb')
    <li class="c-admin__breadcrumb"><a href="{!! action('Admin\AdminUserController@index') !!}"><i
                class="fa fa-files-o"></i> AdminUsers</a></li>
    @if( $isNew )
        <li class="c-admin__breadcrumb c-admin__breadcrumb--is-active">New</li>
    @else
        <li class="c-admin__breadcrumb c-admin__breadcrumb--is-active">{{ $adminUser->id }}</li>
    @endif
@stop

@section('content')
    <form
        @if( $isNew )
        action="{!! action('Admin\AdminUserController@store') !!}" method="POST" enctype="multipart/form-data">
        @else
            action="{!! action('Admin\AdminUserController@update', [$adminUser->id]) !!}" method="POST"
            enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
        @endif
        {!! csrf_field() !!}
        <div class="c-admincrud__form @if ($errors->has('name')) c-admincrud__form--is-error @endif">
            <label for="name">@lang('admin.pages.admin-users.columns.name')</label>
            <input type="text" id="name" name="name" value="{{ old('name') ? old('name') : $adminUser->name }}">
        </div>

        <div class="c-admincrud__form @if ($errors->has('email')) c-admincrud__form--is-error @endif">
            <label for="email">@lang('admin.pages.admin-users.columns.email')</label>
            <input type="email" id="email" name="email" value="{{ old('email') ? old('email') : $adminUser->email }}">
        </div>

        <div class="c-admincrud__form @if ($errors->has('password')) c-admincrud__form--is-error @endif">
            <label for="password">@lang('admin.pages.admin-users.columns.password')</label>
            <input type="password" id="password" name="password" value="">
        </div>

        <div class="c-admincrud__form @if ($errors->has('profile_image')) c-admincrud__form--is-error @endif">
            @if( !empty($adminUser->profileImage) )
                <img id="profile-image-id-preview" src="{!! $adminUser->profileImage->getThumbnailUrl(300, 300) !!}"
                     alt=""
                     class="c-admincrud__preview-image"/>'
            @else
                <img id="profile-image-id-preview" src="{!! \URLHelper::asset('img/user.png', 'common') !!}" alt=""
                     class="c-admincrud__preview-image"/>'
            @endif
            <label for="profile_image">@lang('admin.pages.admin-users.columns.profile_image')</label>
            <input type="file" class="c-admincrud__image-field" id="profile_image" name="profile_image">
        </div>
        <button type="submit" class="button">@lang('admin.pages.common.buttons.save')</button>
    </form>
@stop
