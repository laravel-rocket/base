<?php
namespace Tests\Services;

use Tests\TestCase;

class APIUserInterfaceServiceTest extends TestCase
{
    public function testGetInstance()
    {
        /** @var \App\Services\APIUserServiceInterface $service */
        $service = \App::make(\App\Services\APIUserServiceInterface::class);
        $this->assertNotNull($service);
    }
}
