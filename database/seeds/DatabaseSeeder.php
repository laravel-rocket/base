<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** @var array $seeders */
    protected $seeders = [
    ];

    protected $environments = [
        'testing'     => [],
        'local'       => ['AdminUserSeeder'],
        'development' => ['AdminUserSeeder'],
        'production'  => [],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
