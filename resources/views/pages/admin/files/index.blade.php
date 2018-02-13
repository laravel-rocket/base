@extends('layouts.admin.application', ['menu' => 'files'] )

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
File
@stop

@section('breadcrumb')
    <li class="active">File</li>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                <p class="text-right">
                    <a href="{!! action('Admin\FileController@create') !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.create')</a>
                </p>
            </h3>
            {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>@lang('tables/files/columns.url')</th>
                    <th>@lang('tables/files/columns.title')</th>
                    <th>@lang('tables/files/columns.entity_type')</th>
                    <th>@lang('tables/files/columns.entity_id')</th>
                    <th>@lang('tables/files/columns.storage_type')</th>
                    <th>@lang('tables/files/columns.file_category_type')</th>
                    <th>@lang('tables/files/columns.file_type')</th>
                    <th>@lang('tables/files/columns.s3_key')</th>
                    <th>@lang('tables/files/columns.s3_bucket')</th>
                    <th>@lang('tables/files/columns.s3_region')</th>
                    <th>@lang('tables/files/columns.s3_extension')</th>
                    <th>@lang('tables/files/columns.media_type')</th>
                    <th>@lang('tables/files/columns.format')</th>
                    <th>@lang('tables/files/columns.original_file_name')</th>
                    <th>@lang('tables/files/columns.file_size')</th>
                    <th>@lang('tables/files/columns.width')</th>
                    <th>@lang('tables/files/columns.height')</th>
                    <th>@lang('tables/files/columns.is_enabled')</th>
                    <th style="width: 40px">&nbsp;</th>
                </tr>
                @foreach( $models as $model )
                    <tr>
                        <td>{{ $model->id }}</td>
                                <td>{{ $model->present()->url }}</td>
                                <td>{{ $model->present()->title }}</td>
                                <td>{{ $model->present()->entity_type }}</td>
                                <td>{{ $model->present()->entity_id }}</td>
                                <td>{{ $model->present()->storage_type }}</td>
                                <td>{{ $model->present()->file_category_type }}</td>
                                <td>{{ $model->present()->file_type }}</td>
                                <td>{{ $model->present()->s3_key }}</td>
                                <td>{{ $model->present()->s3_bucket }}</td>
                                <td>{{ $model->present()->s3_region }}</td>
                                <td>{{ $model->present()->s3_extension }}</td>
                                <td>{{ $model->present()->media_type }}</td>
                                <td>{{ $model->present()->format }}</td>
                                <td>{{ $model->present()->original_file_name }}</td>
                                <td>{{ $model->present()->file_size }}</td>
                                <td>{{ $model->present()->width }}</td>
                                <td>{{ $model->present()->height }}</td>
                                <td>
                                    @if( $model->is_enabled )
                                    <span class="badge bg-green">@lang('tables/files/columns.is_enabled_true')</span>
                                    @else
                                    <span class="badge bg-red">@lang('tables/files/columns.is_enabled_false')</span>
                                    @endif
                                </td>
                        <td>
                            <a href="{!! action('Admin\FileController@show', $model->id) !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.edit')</a>
                            <a href="#" class="btn btn-block btn-danger btn-sm delete-button" data-delete-url="{!! action('Admin\FileController@destroy', $model->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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
