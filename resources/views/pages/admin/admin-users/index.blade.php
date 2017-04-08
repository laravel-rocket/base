@extends('layouts.admin.application', ['menu' => '%%classes-snake%%'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('title')
    AdminUsers | Admin
@stop

@section('header')
    AdminUsers
@stop

@section('breadcrumb')
    <li class="c-admin__breadcrumb c-admin__breadcrumb--is-active">AdminUsers</li>
@stop

@section('content')
    <div class="c-admincrud__controll">
        <a href="{!! action('Admin\AdminUserController@create') !!}"
           class="button">@lang('admin.pages.common.buttons.create')</a>
    </div>
    <div class="c-admincrud__pagination">
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, [], 5, 'shared.admin.pagination') !!}
    </div>
    <div class="c-admincrud__list">
        <table class="c-admincrud__table">
            <tr>
                <th>ID</th>
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
                        <a href="{!! action('Admin\AdminUserController@show', $adminUser->id) !!}"
                           class="button">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="button">@lang('admin.pages.common.buttons.delete')</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="c-admincrud__pagination">
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, [], 5, 'shared.admin.pagination') !!}
    </div>
    </div>
@stop
