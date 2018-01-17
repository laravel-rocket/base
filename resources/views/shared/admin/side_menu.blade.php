<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! $authUser->present()->profileImage->url !!}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! $authUser->name !!}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li @if( $menu=='dashboard') class="active" @endif >
                <a href="{{ action('Admin\IndexController@index') }}">
                    <i class="fa fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li @if( $menu=='admin_user') class="active" @endif >
                <a href="{!! URL::action('Admin\AdminUserController@index') !!}">
                    <i class="fa fa-user-secret"></i>
                    <span>Admin Users</span>
                </a>
            </li>
            <li @if( $menu=='user') class="active" @endif >
                <a href="{!! action('Admin\UserController@index') !!}">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
