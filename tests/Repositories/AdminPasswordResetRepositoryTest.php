<?php
namespace Tests\Repositories;

use LaravelRocket\Foundation\Tests\TestCase;

class AdminPasswordResetRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Repositories\AdminPasswordResetRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminPasswordResetRepositoryInterface::class);
        $this->assertNotNull($repository);
    }
}
