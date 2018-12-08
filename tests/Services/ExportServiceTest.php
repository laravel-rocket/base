<?php

namespace Tests\Services;

use Tests\TestCase;

class ExportServiceTest extends TestCase
{

    /**
     * @return  \App\Services\ExportServiceInterface
     */
    protected function getInstance()
    {
        /** @var  \App\Services\ExportServiceInterface $service */
        $service = \App::make(\App\Services\ExportServiceInterface::class);

        return $service;
    }

    public function testGetInstance()
    {
        $service = $this->getInstance();
        $this->assertNotNull($service);
    }

}
