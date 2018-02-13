<?php
namespace Tests\Controllers\Admin;

use Tests\TestCase;

class FileControllerTest extends TestCase
{
    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var \App\Http\Controllers\Admin\FileController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\FileController::class);
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
        $response = $this->action('GET', 'Admin\FileController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\FileController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $file = factory(\App\Models\File::class)->make();
        $this->action('POST', 'Admin\FileController@store', [
                '_token' => csrf_token(),
            ] + $file->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $file = factory(\App\Models\File::class)->create();
        $this->action('GET', 'Admin\FileController@show', [$file->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $file = factory(\App\Models\File::class)->create();

        $testData = str_random(10);
        $id       = $file->id;

        $file->url = $testData;

        $this->action('PUT', 'Admin\FileController@update', [$id], [
                '_token' => csrf_token(),
            ] + $file->toArray());
        $this->assertResponseStatus(302);

        $newFile = \App\Models\File::find($id);
        $this->assertEquals($testData, $newFile->url);
    }

    public function testDeleteModel()
    {
        $file = factory(\App\Models\File::class)->create();

        $id = $file->id;

        $this->action('DELETE', 'Admin\FileController@destroy', [$id], [
            '_token' => csrf_token(),
        ]);
        $this->assertResponseStatus(302);

        $checkFile = \App\Models\File::find($id);
        $this->assertNull($checkFile);
    }
}
