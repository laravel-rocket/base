<div class="c-admin__wrapper">
    <div class="c-admin__wrapper-inner">
    @include('shared.admin.header')
    @include('layouts.admin.side_menu')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('header', 'Dashboard')
                    <small>@yield('subheader', 'Dashboard')</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{!! action('Admin\IndexController@index') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    @yield('breadcrumb')
                </ol>
            </section>

            <section class="content">
                @include('shared.admin.messagebox')
                @yield('content')
            </section>
        </div>

        @include('shared.admin.footer')
        @include('shared.admin.control_side_bar')
    </div>
</div>
