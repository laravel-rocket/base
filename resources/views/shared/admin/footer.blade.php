<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{ \DateTimeHelper::now()->format('Y') }} <a href="{!! \URL::action('User\IndexController@index') !!}">{{ config('site.name') }}</a>.</strong> All rights reserved.
</footer>
