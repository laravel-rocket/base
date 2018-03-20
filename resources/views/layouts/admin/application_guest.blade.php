<!doctype html>
<html lang="{{ \App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', config('site.name', '') . ' | Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ \URLHelper::asset('images/logo.png', 'admin') }}">
    @include('layouts.admin.metadata')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ \UrlHelper::asset('css/style.min.css', 'admin-guest') }}">
    @yield('styles')
    <meta name="csrf-token" content="{!! csrf_token() !!}">
</head>
<body class="app flex-row align-items-center">
@yield('content')
@section('scripts')
@show
</body>
</html>
