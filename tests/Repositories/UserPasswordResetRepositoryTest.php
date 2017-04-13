<?php
namespace Tests\Repositories;

use Tests\TestCase;

class UserPasswordResetRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Repositories\UserPasswordResetRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserPasswordResetRepositoryInterface::class);
        $this->assertNotNull($repository);
    }
}
