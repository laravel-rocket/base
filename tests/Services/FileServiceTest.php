<?php
namespace Tests\Services;

use Tests\TestCase;

class FileServiceTest extends TestCase
{
    public function testGetInstance()
    {
        /** @var \App\Services\FileServiceInterface $service */
        $service = \App::make(\App\Services\FileServiceInterface::class);
        $this->assertNotNull($service);
    }
}
