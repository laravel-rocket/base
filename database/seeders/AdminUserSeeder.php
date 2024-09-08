<?php
namespace Database\Seeders;

use App\Models\AdminUserRole;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        /** @var \App\Repositories\AdminUserRepositoryInterface $adminUserRepository */
        $adminUserRepository = \App::make('App\Repositories\AdminUserRepositoryInterface');
        /** @var \App\Repositories\AdminUserRoleRepositoryInterface $adminUserRoleRepository */
        $adminUserRoleRepository = \App::make('App\Repositories\AdminUserRoleRepositoryInterface');

        $adminUser = $adminUserRepository->create([
            'name'     => 'TestUser',
            'email'    => 'test@example.com',
            'password' => 'testtest',
        ]);

        $adminUserRoleRepository->create([
            'admin_user_id' => $adminUser->id,
            'role'          => AdminUserRole::ROLE_SUPER_USER,
        ]);

        $adminUser = $adminUserRepository->create([
            'name'     => 'Test Site Admin',
            'email'    => 'test2@example.com',
            'password' => 'testtest',
        ]);

        $adminUserRoleRepository->create([
            'admin_user_id' => $adminUser->id,
            'role'          => AdminUserRole::ROLE_SITE_ADMIN,
        ]);

    }
}
