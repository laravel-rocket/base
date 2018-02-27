<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** @var array $seeders */
    protected $seeders = [
        'AdminUserSeeder',
    ];

    protected $environments = [
        'testing'     => [],
        'local'       => [],
        'development' => [],
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
        foreach ($this->environments as $environment => $seeders) {
            if (app()->environment() === $environment) {
                foreach ($seeders as $seeder) {
                    $this->call($seeder);
                }
            }
        }
    }
}
