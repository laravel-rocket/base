@extends('layouts.admin.application', ['menu' => 'users'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
    <script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>
    <script>
        $('.datetime-field').datetimepicker({'format': 'YYYY-MM-DD HH:mm:ss'});
    </script>
    <script>
    $("#profile_image_id").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-profile_image_id',
        msgErrorClass: 'alert alert-block alert-danger',
        @if( !empty($user->profileImage) )
        defaultPreviewContent: '<img src="{!! $user->profileImage->getThumbnailUrl(200, 200) !!}" alt="Your Avatar" style="width:100px">',
        @else
        defaultPreviewContent: '<img src="{!! \URLHelper::asset('images/user.png', 'common') !!}" alt="Your Avatar" style="width:100px">',
        @endif
        layoutTemplates: {main2: '{preview} {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
    });
    </script>
@stop

@section('title')
@stop

@section('header')
    User
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\UserController@index') !!}"><i class="fa fa-files-o"></i> User</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $user->id }}</li>
    @endif
@stop

@section('content')
@if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <ul>
@foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
@endforeach
            </ul>
        </div>
@endif

@if( $isNew )
        <form action="{!! action('Admin\UserController@store') !!}" method="POST" enctype="multipart/form-data">
@else
        <form action="{!! action('Admin\UserController@update', [$user->id]) !!}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
@endif
        {!! csrf_field() !!}
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
            </div>
            <div class="box-body">
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    <label for="name">@lang('tables/users/columns.name')</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ? old('name') : $user->name }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('email')) has-error @endif">
                    <label for="email">@lang('tables/users/columns.email')</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ? old('email') : $user->email }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('password')) has-error @endif">
                    <label for="password">@lang('tables/users/columns.password')</label>
                    <input type="password" class="form-control" id="password" name="password" value="">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="row">
                    <div class="col-md-12">

                        <div id="kv-avatar-errors-profile_image_id" class="center-block" style="display:none;"></div>
                        <div class="kv-avatar center-block" style="width:160px">
                            <input id="profile_image_id" name="profile_image_id" type="file" class="file-loading">
                        </div>

                    </div>
                </div>
            </div>
            </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">@lang('admin.pages.common.buttons.save')</button>
            </div>
        </div>
    </form>
@stop
