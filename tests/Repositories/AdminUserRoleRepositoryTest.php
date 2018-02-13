<?php
namespace Tests\Repositories;

use App\Models\AdminUserRole;
use Tests\TestCase;

class AdminUserRoleRepositoryTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Repositories\AdminUserRoleRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRoleRepositoryInterface::class);
        $this->assertNotNull($repository);
    }

    public function testGetList()
    {
        $models           = factory(AdminUserRole::class, 3)->create();
        $adminUserRoleIds = $models->pluck('id')->toArray();

        /** @var \App\Repositories\AdminUserRoleRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRoleRepositoryInterface::class);
        $this->assertNotNull($repository);

        $modelsCheck = $repository->get('id', 'asc', 0, 1);
        $this->assertInstanceOf(AdminUserRole::class, $modelsCheck[0]);

        $modelsCheck = $repository->getByIds($adminUserRoleIds);
        $this->assertEquals(3, count($modelsCheck));
    }

    public function testFind()
    {
        $models           = factory(AdminUserRole::class, 3)->create();
        $adminUserRoleIds = $models->pluck('id')->toArray();

        /** @var \App\Repositories\AdminUserRoleRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRoleRepositoryInterface::class);
        $this->assertNotNull($repository);

        $adminUserRoleCheck = $repository->find($adminUserRoleIds[0]);
        $this->assertEquals($adminUserRoleIds[0], $adminUserRoleCheck->id);
    }

    public function testCreate()
    {
        $adminUserRoleData = factory(AdminUserRole::class)->make();

        /** @var \App\Repositories\AdminUserRoleRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRoleRepositoryInterface::class);
        $this->assertNotNull($repository);

        $adminUserRoleCheck = $repository->create($adminUserRoleData->toFillableArray());
        $this->assertNotNull($adminUserRoleCheck);
    }

    public function testUpdate()
    {
        $adminUserRoleData = factory(AdminUserRole::class)->create();

        /** @var \App\Repositories\AdminUserRoleRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRoleRepositoryInterface::class);
        $this->assertNotNull($repository);

        $adminUserRoleData = factory(AdminUserRole::class)->make();

        $adminUserRoleCheck = $repository->update($adminUserRoleData, $adminUserRoleData->toFillableArray());
        $this->assertNotNull($adminUserRoleCheck);
    }

    public function testDelete()
    {
        $adminUserRoleData = factory(AdminUserRole::class)->create();

        /** @var \App\Repositories\AdminUserRoleRepositoryInterface $repository */
        $repository = \App::make(\App\Repositories\AdminUserRoleRepositoryInterface::class);
        $this->assertNotNull($repository);

        $repository->delete($adminUserRoleData);

        $adminUserRoleCheck = $repository->find($adminUserRoleData->id);
        $this->assertNull($adminUserRoleCheck);
    }
}
