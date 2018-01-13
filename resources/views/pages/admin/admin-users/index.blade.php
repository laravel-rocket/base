@extends('layouts.admin.application', ['menu' => 'admin-user'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
    AdminUsers
@stop

@section('breadcrumb')
    <li class="active">AdminUsers</li>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                <p class="text-right">
                    <a href="{!! action('Admin\AdminUserController@create') !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.create')</a>
                </p>
            </h3>
            {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>@lang('admin.pages.admin-users.columns.name')</th>
                    <th>@lang('admin.pages.admin-users.columns.email')</th>
                    <th style="width: 40px">&nbsp;</th>
                </tr>
                @foreach( $adminUsers as $adminUser )
                    <tr>
                        <td>{{ $adminUser->id }}</td>
                        <td>{{ $adminUser->name }}</td>
                        <td>{{ $adminUser->email }}</td>
                        <td>
                            <a href="{!! action('Admin\AdminUserController@show', $adminUser->id) !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.edit')</a>
                            <a href="#" class="btn btn-block btn-danger btn-sm delete-button" data-delete-url="{!! action('Admin\AdminUserController@destroy', $adminUser->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-footer">
            {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
        </div>
    </div>
@stop
