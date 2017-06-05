@extends('layouts.admin.application', ['menu' => 'admin_user'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
    <script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>
    <script>
        $("#profile_image").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            @if( !empty($adminUser->profileImage) )
            defaultPreviewContent: '<img src="{!! $adminUser->profileImage->getThumbnailUrl(200, 200) !!}" alt="Your Avatar" style="width:100px">',
            @else
            defaultPreviewContent: '<img src="{!! \URLHelper::asset('img/user.png', 'common') !!}" alt="Your Avatar" style="width:100px">',
            @endif
            layoutTemplates: {main2: '{preview} {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif", "jpeg"]
        });
    </script>
@stop

@section('title')
@stop

@section('header')
    AdminUsers
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\AdminUserController@index') !!}"><i class="fa fa-files-o"></i> AdminUsers</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $adminUser->id }}</li>
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
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">

                </h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('name')) has-error @endif">
                            <label for="name">@lang('admin.pages.admin-users.columns.name')</label>
                            <input type="text" id="name" class="form-control" name="name"
                                   value="{{ old('name') ? old('name') : $adminUser->name }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('email')) has-error @endif">
                            <label for="email">@lang('admin.pages.admin-users.columns.email')</label>
                            <input type="email" id="email" class="form-control" name="email"
                                   value="{{ old('email') ? old('email') : $adminUser->email }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            <label for="password">@lang('admin.pages.admin-users.columns.password')</label>
                            <input type="password" id="password" class="form-control" name="password" value="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                        <div class="kv-avatar center-block" style="width:160px">
                            <input id="profile_image" name="profile_image" type="file" class="file-loading">
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
