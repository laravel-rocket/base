<?php
namespace Tests\Listeners;

use LaravelRocket\Foundation\Tests\Listeners\DatabaseSetupListener as BaseDatabaseSetupListener;

class DatabaseSetupListener extends BaseDatabaseSetupListener
{
    protected $suites = ['Application Test Suite'];
}
