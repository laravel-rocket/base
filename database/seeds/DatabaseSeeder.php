<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('AdminUserSeeder');
        if (app()->environment() === 'testing') {
            // Add More Seed For Testing
        }
    }
}
