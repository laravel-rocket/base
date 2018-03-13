<!doctype html>
<html lang="{{ \App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', config('site.name', '') . ' | Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ \URLHelper::asset('images/logo.png', 'admin') }}">
    @include('layouts.admin.metadata')
    @include('layouts.admin.styles')
    @yield('styles')
    <meta name="csrf-token" content="{!! csrf_token() !!}">
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
@yield('content')
@include('layouts.admin.scripts')
@section('scripts')
@show
</body>
</html>
