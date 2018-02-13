@extends('layouts.admin.application', ['menu' => 'files'] )

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
    File
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\FileController@index') !!}"><i class="fa fa-files-o"></i> File</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $file->id }}</li>
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
        <form action="{!! action('Admin\FileController@store') !!}" method="POST" enctype="multipart/form-data">
@else
        <form action="{!! action('Admin\FileController@update', [$file->id]) !!}" method="POST" enctype="multipart/form-data">
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
                <div class="form-group @if ($errors->has('url')) has-error @endif">
                    <label for="url">@lang('tables/files/columns.url')</label>
                    <input type="text" class="form-control" id="url" name="url" value="{{ old('url') ? old('url') : $file->url }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('title')) has-error @endif">
                    <label for="title">@lang('tables/files/columns.title')</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ? old('title') : $file->title }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('entity_type')) has-error @endif">
                    <label for="entity_type">@lang('tables/files/columns.entity_type')</label>
                <select name="entity_type" id="entity_type" class="select2 form-control">
                    </select>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('entity_id')) has-error @endif">
                    <label for="entity_id">@lang('tables/files/columns.entity_id')</label>
                    <input type="text" class="form-control" id="entity_id" name="entity_id" value="{{ old('entity_id') ? old('entity_id') : $file->entity_id }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('storage_type')) has-error @endif">
                    <label for="storage_type">@lang('tables/files/columns.storage_type')</label>
                <select name="storage_type" id="storage_type" class="select2 form-control">
                        <option value="s3">@lang('tables/files/columns.storage_type_options.s3')</option>
                        <option value="local">@lang('tables/files/columns.storage_type_options.local')</option>
                        <option value="url">@lang('tables/files/columns.storage_type_options.url')</option>
                    </select>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('file_category_type')) has-error @endif">
                    <label for="file_category_type">@lang('tables/files/columns.file_category_type')</label>
                <select name="file_category_type" id="file_category_type" class="select2 form-control">
                    </select>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('file_type')) has-error @endif">
                    <label for="file_type">@lang('tables/files/columns.file_type')</label>
                <select name="file_type" id="file_type" class="select2 form-control">
                        <option value="image">@lang('tables/files/columns.file_type_options.image')</option>
                        <option value="video">@lang('tables/files/columns.file_type_options.video')</option>
                    </select>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('s3_key')) has-error @endif">
                    <label for="s3_key">@lang('tables/files/columns.s3_key')</label>
                    <input type="text" class="form-control" id="s3_key" name="s3_key" value="{{ old('s3_key') ? old('s3_key') : $file->s3_key }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('s3_bucket')) has-error @endif">
                    <label for="s3_bucket">@lang('tables/files/columns.s3_bucket')</label>
                    <input type="text" class="form-control" id="s3_bucket" name="s3_bucket" value="{{ old('s3_bucket') ? old('s3_bucket') : $file->s3_bucket }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('s3_region')) has-error @endif">
                    <label for="s3_region">@lang('tables/files/columns.s3_region')</label>
                    <input type="text" class="form-control" id="s3_region" name="s3_region" value="{{ old('s3_region') ? old('s3_region') : $file->s3_region }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('s3_extension')) has-error @endif">
                    <label for="s3_extension">@lang('tables/files/columns.s3_extension')</label>
                    <input type="text" class="form-control" id="s3_extension" name="s3_extension" value="{{ old('s3_extension') ? old('s3_extension') : $file->s3_extension }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('media_type')) has-error @endif">
                    <label for="media_type">@lang('tables/files/columns.media_type')</label>
                <select name="media_type" id="media_type" class="select2 form-control">
                    </select>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('format')) has-error @endif">
                    <label for="format">@lang('tables/files/columns.format')</label>
                    <input type="text" class="form-control" id="format" name="format" value="{{ old('format') ? old('format') : $file->format }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('original_file_name')) has-error @endif">
                    <label for="original_file_name">@lang('tables/files/columns.original_file_name')</label>
                    <input type="text" class="form-control" id="original_file_name" name="original_file_name" value="{{ old('original_file_name') ? old('original_file_name') : $file->original_file_name }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('file_size')) has-error @endif">
                    <label for="file_size">@lang('tables/files/columns.file_size')</label>
                    <input type="text" class="form-control" id="file_size" name="file_size" value="{{ old('file_size') ? old('file_size') : $file->file_size }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('width')) has-error @endif">
                    <label for="width">@lang('tables/files/columns.width')</label>
                    <input type="text" class="form-control" id="width" name="width" value="{{ old('width') ? old('width') : $file->width }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('height')) has-error @endif">
                    <label for="height">@lang('tables/files/columns.height')</label>
                    <input type="text" class="form-control" id="height" name="height" value="{{ old('height') ? old('height') : $file->height }}">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="form-group @if ($errors->has('thumbnails')) has-error @endif">
                    <label for="thumbnails">@lang('tables/files/columns.thumbnails')</label>
                    <textarea name="thumbnails" class="form-control" rows="5" placeholder="@lang('tables/files/columns.thumbnails')">{!!  old('thumbnails') ? old('thumbnails') : $file->thumbnails !!}</textarea>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <td>
                    <div class="form-group @if ($errors->has('is_enabled')) has-error @endif">
                        <label for="is_enabled">@lang('tables/files/columns.is_enabled')</label><br/>
                        <input type="radio" name="is_enabled" value="0" @if( $file->is_enabled == 0 ) checked @endif> @lang('tables/files/columns.is_enabled_false')
                        <input type="radio" name="is_enabled" value="1" @if( $file->is_enabled == 1 ) checked @endif> @lang('tables/files/columns.is_enabled_true')
                    </div>
                </td>
            </div>
            </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">@lang('admin.pages.common.buttons.save')</button>
            </div>
        </div>
    </form>
@stop
