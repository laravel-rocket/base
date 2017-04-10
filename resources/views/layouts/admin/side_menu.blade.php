<aside class="main-sidebar">

    <section class="c-admin__sidebar">

        <div class="c-user-panel">
            <div class="c-user-panel__profile-image">
                <img src="{!! $authUser->present()->profileImage->url !!}" alt="User Image">
            </div>
            <div class="c-user-panel__info">
                <p>{!! $authUser->name !!}</p>
            </div>
        </div>

        <ul class="c-admin__sidemenu">
            <li class="c-admin__sidemenuitem @if( $menu=='dashboard') c-admin__sidemenu-item--is-active @endif "><a
                    href="{!! action('Admin\IndexController@index') !!}"><i class="fa fa-dashboard"></i>
                    <span>Dashboard</span></a></li>
            <li class="c-admin__sidemenuitem @if( $menu=='user') c-admin__sidemenu-item--is-active @endif "><a
                    href="{!! action('Admin\UserController@index') !!}"><i class="fa fa-users"></i>
                    <span>Users</span></a></li>
            <li class="c-admin__sidemenuitem @if( $menu=='admin_user') c-admin__sidemenu-item--is-active @endif "><a
                    href="{!! action('Admin\AdminUserController@index') !!}"><i class="fa fa-users"></i> <span>AdminUsers</span></a>
            </li>
            <!-- %%SIDEMENU%% -->
        </ul>
    </section>
</aside>
