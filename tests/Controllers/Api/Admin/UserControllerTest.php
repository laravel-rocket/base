<?php
namespace Tests\Controllers\Api\Admin;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Http\Controllers\Api\Admin\UserController $controller */
        $controller = \App::make(\App\Http\Controllers\Api\Admin\UserController::class);
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
        $response = $this->action('GET', 'Api\Admin\UserController@index');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $user = factory(\App\Models\User::class)->make();
        $this->action('POST', 'Api\Admin\UserController@store', $user->toArray());
        $this->assertResponseStatus(201);
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $user = factory(\App\Models\User::class)->create();

        $testData = str_random(10);
        $id       = $user->id;

        $user->name = $testData;

        $this->action('PUT', 'Api\Admin\UserController@update', [$id], $user->toArray());
        $this->assertResponseStatus(200);

        $newUser = \App\Models\User::find($id);
        $this->assertEquals($testData, $newUser->name);
    }

    public function testDeleteModel()
    {
        $user = factory(\App\Models\User::class)->create();

        $id = $user->id;

        $this->action('DELETE', 'Api\Admin\UserController@destroy', [$id]);
        $this->assertResponseStatus(200);

        $checkUser = \App\Models\User::find($id);
        $this->assertNull($checkUser);
    }
}
