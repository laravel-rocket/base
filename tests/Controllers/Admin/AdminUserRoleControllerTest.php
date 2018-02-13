<?php
namespace Tests\Controllers\Admin;

use Tests\TestCase;

class AdminUserRoleControllerTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Http\Controllers\Admin\AdminUserRoleController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\AdminUserRoleController::class);
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

    public function testGetList()
    {
        $response = $this->action('GET', 'Admin\AdminUserRoleController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\AdminUserRoleController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $adminUserRole = factory(\App\Models\AdminUserRole::class)->make();
        $this->action('POST', 'Admin\AdminUserRoleController@store', [
                '_token' => csrf_token(),
            ] + $adminUserRole->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $adminUserRole = factory(\App\Models\AdminUserRole::class)->create();
        $this->action('GET', 'Admin\AdminUserRoleController@show', [$adminUserRole->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $adminUserRole = factory(\App\Models\AdminUserRole::class)->create();

        $testData = str_random(10);
        $id       = $adminUserRole->id;

        $adminUserRole->role = $testData;

        $this->action('PUT', 'Admin\AdminUserRoleController@update', [$id], [
                '_token' => csrf_token(),
            ] + $adminUserRole->toArray());
        $this->assertResponseStatus(302);

        $newAdminUserRole = \App\Models\AdminUserRole::find($id);
        $this->assertEquals($testData, $newAdminUserRole->role);
    }

    public function testDeleteModel()
    {
        $adminUserRole = factory(\App\Models\AdminUserRole::class)->create();

        $id = $adminUserRole->id;

        $this->action('DELETE', 'Admin\AdminUserRoleController@destroy', [$id], [
            '_token' => csrf_token(),
        ]);
        $this->assertResponseStatus(302);

        $checkAdminUserRole = \App\Models\AdminUserRole::find($id);
        $this->assertNull($checkAdminUserRole);
    }
}
