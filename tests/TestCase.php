<?php
namespace Tests;

use LaravelRocket\Foundation\Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @var bool */
    protected $useDatabase = false;

    /** @var string */
    public $baseUrl = 'http://localhost:8000';

    /** @var \Faker\Generator */
    protected $faker;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
