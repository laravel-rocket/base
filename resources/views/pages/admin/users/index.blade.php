@extends('layouts.admin.application', ['menu' => '%%classes-snake%%'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('title')
    Users | Admin
@stop

@section('header')
    Users
@stop

@section('breadcrumb')
    <li class="c-admin__breadcrumb c-admin__breadcrumb--is-active">Users</li>
@stop

@section('content')
    <div class="c-admincrud__controll">
        <a href="{!! action('Admin\UserController@create') !!}"
           class="button">@lang('admin.pages.common.buttons.create')</a>
    </div>
    <div class="c-admincrud__pagination">
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, [], 5, 'shared.admin.pagination') !!}
    </div>
    <div class="c-admincrud__list">
        <table class="c-admincrud__table">
            <tr>
                <th>ID</th>
                <th>@lang('admin.pages.users.columns.name')</th>
                <th>@lang('admin.pages.users.columns.email')</th>
                <th style="width: 40px">&nbsp;</th>
            </tr>
            @foreach( $users as $user )
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{!! action('Admin\UserController@show', $user->id) !!}"
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
