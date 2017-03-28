<?php

namespace Tests\Services;

use LaravelRocket\Foundation\Tests\TestCase;

class UserServiceTest extends TestCase
{

    public function testGetInstance()
    {
        /** @var  \App\Services\UserServiceInterface $service */
        $service = \App::make(\App\Services\UserServiceInterface::class);
        $this->assertNotNull($service);
    }

}
