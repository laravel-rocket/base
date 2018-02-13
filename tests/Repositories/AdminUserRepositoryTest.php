<?php
namespace Tests\Repositories;

use App\Models\AdminUser;
use Tests\TestCase;

class AdminUserRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Repositories\AdminUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models       = factory(AdminUser::class, 3)->create();
        $adminUserIds = $models->pluck('id')->toArray();

        /** @var \App\Repositories\AdminUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(AdminUser::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($adminUserIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models       = factory(AdminUser::class, 3)->create();
        $adminUserIds = $models->pluck('id')->toArray();

        /** @var \App\Repositories\AdminUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $adminUserCheck = $repository->find($adminUserIds[0]);
        $this->assertEquals($adminUserIds[0], $adminUserCheck->id);
    }

    public function testCreate()
    {
        $adminUserData = factory(AdminUser::class)->make();

        /** @var \App\Repositories\AdminUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $adminUserCheck = $repository->create($adminUserData->toFillableArray());
        $this->assertNotNull($adminUserCheck);
    }

    public function testUpdate()
    {
        $adminUserData = factory(AdminUser::class)->create();

        /** @var \App\Repositories\AdminUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $adminUserData = factory(AdminUser::class)->make();

        $adminUserCheck = $repository->update($adminUserData, $adminUserData->toFillableArray());
        $this->assertNotNull($adminUserCheck);
    }

    public function testDelete()
    {
        $adminUserData = factory(AdminUser::class)->create();

        /** @var \App\Repositories\AdminUserRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($adminUserData);

        $adminUserCheck = $repository->find($adminUserData->id);
        $this->assertNull($adminUserCheck);
    }
}
