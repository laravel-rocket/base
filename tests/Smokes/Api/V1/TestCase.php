<?php

namespace Tests\Smokes\Api\V1;

use Tests\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /** @var bool */
    protected $useDatabase = true;

    public function setUp(): void
    {

        //        exec('php artisan migrate --database testing');
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        //        exec('php artisan migrate:rollback --database testing');
    }
}
