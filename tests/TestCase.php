<?php

namespace Tests;

use LaravelRocket\Foundation\Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @var bool */
    protected $useDatabase = false;

    /** @var string  */
    protected $baseUrl = 'http://localhost:8000';

    /** @var \Faker\Generator */
    protected $faker;

    public function setUp()
    {
        parent::setUp();
        if ($this->useDatabase) {
            \DB::disableQueryLog();
            exec('cp ' .database_path('testing/stubdb.sqlite') .' ' . database_path('testing/testdb.sqlite'));
        }
    }

    public function tearDown()
    {
        if ($this->useDatabase) {
            \DB::disconnect();
            exec('rm ' . database_path('testing/testdb.sqlite'));
        }
        parent::tearDown();
    }
}
