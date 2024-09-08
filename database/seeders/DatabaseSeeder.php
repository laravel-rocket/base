<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected array $seeders = [
    ];

    protected array $environments = [
        'testing' => [],
        'local' => [AdminUserSeeder::class],
        'development' => [AdminUserSeeder::class],
        'production' => [],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->seeders as $seeder) {
            $this->call($seeder);
        }
        if (array_key_exists(app()->environment(), $this->environments)) {
            foreach ($this->environments[app()->environment()] as $seeder) {
                $this->call($seeder);
            }
        }
    }
}
