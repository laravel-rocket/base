<?php
namespace Tests\Models;

use App\Models\AdminUserRole;
use Tests\TestCase;

class AdminUserRoleTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Models\AdminUserRole $adminUserRole */
        $adminUserRole = new AdminUserRole();
        $this->assertNotNull($adminUserRole);
    }

    public function testStoreNew()
    {
        /** @var \App\Models\AdminUserRole $adminUserRole */
        $adminUserRoleModel = new AdminUserRole();

        $adminUserRoleData = factory(AdminUserRole::class)->make();
        foreach ($adminUserRoleData->toFillableArray() as $key => $value) {
            $adminUserRoleModel->$key = $value;
        }
        $adminUserRoleModel->save();

        $this->assertNotNull(AdminUserRole::find($adminUserRoleModel->id));
    }
}
