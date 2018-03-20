<?php
namespace Tests\Controllers\Admin;

use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Http\Controllers\Api\Admin\IndexController $controller */
        $controller = \App::make(\App\Http\Controllers\Api\Admin\IndexController::class);
        $this->assertNotNull($controller);
    }

    public function setUp()
    {
        parent::setUp();
        $authUser     = factory(\App\Models\AdminUser::class)->create();
        $authUserRole = factory(\App\Models\AdminUserRole::class)->create([
            'admin_user_id' => $authUser->id,
            'role'          => \App\Models\AdminUserRole::ROLE_SUPER_USER,
        ]);
        $this->be($authUser, 'admins');
    }
}
