<?php

namespace Tests\Repositories;

use App\Models\User;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Repositories\UserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models = factory(User::class, 3)->create();
        $userIds = $models->pluck('id')->toArray();

        /** @var \App\Repositories\UserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(User::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($userIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models = factory(User::class, 3)->create();
        $userIds = $models->pluck('id')->toArray();

        /** @var \App\Repositories\UserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $userCheck = $repository->find($userIds[0]);
        $this->assertEquals($userIds[0], $userCheck->id);
    }

    public function testCreate()
    {
        $userData = factory(User::class)->make();

        /** @var \App\Repositories\UserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $userCheck = $repository->create($userData->toFillableArray());
        $this->assertNotNull($userCheck);
    }

    public function testUpdate()
    {
        $userData = factory(User::class)->create();

        /** @var \App\Repositories\UserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $userData = factory(User::class)->make();

        $userCheck = $repository->update($userData, $userData->toFillableArray());
        $this->assertNotNull($userCheck);
    }

    public function testDelete()
    {
        $userData = factory(User::class)->create();

        /** @var \App\Repositories\UserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\UserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($userData);

        $userCheck = $repository->find($userData->id);
        $this->assertNull($userCheck);
    }
}
