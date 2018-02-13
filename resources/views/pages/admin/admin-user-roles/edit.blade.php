@extends('layouts.admin.application', ['menu' => 'admin-user-roles'] )

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
@stop

@section('title')
@stop

@section('header')
    AdminUserRole
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\AdminUserRoleController@index') !!}"><i class="fa fa-files-o"></i> AdminUserRole</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $adminUserRole->id }}</li>
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
        <form action="{!! action('Admin\AdminUserRoleController@store') !!}" method="POST" enctype="multipart/form-data">
@else
        <form action="{!! action('Admin\AdminUserRoleController@update', [$adminUserRole->id]) !!}" method="POST" enctype="multipart/form-data">
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
                <div class="form-group @if ($errors->has('admin_user_id')) has-error @endif">
                    <label for="admin_user_id">@lang('tables/admin-user-roles/columns.admin_user_id')</label>
                    <input type="text" class="form-control" id="admin_user_id" name="admin_user_id" value="{{ old('admin_user_id') ? old('admin_user_id') : $adminUserRole->admin_user_id }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('role')) has-error @endif">
                    <label for="role">@lang('tables/admin-user-roles/columns.role')</label>
                <select name="role" id="role" class="select2 form-control">
                        <option value="super_user">@lang('tables/admin-user-roles/columns.role_options.super_user')</option>
                        <option value="site_admin">@lang('tables/admin-user-roles/columns.role_options.site_admin')</option>
                    </select>
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
