<?php

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

        foreach (range(1, 30) as $index) {
            $adminUser = $adminUserRepository->create([
                'name'     => 'TestUser'.$index,
                'email'    => 'test'.$index.'@example.com',
                'password' => 'testtest',
            ]);

            $adminUserRoleRepository->create([
                'admin_user_id' => $adminUser->id,
                'role'          => AdminUserRole::ROLE_SUPER_USER,
            ]);
        }
    }
}
