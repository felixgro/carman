<?php

use Illuminate\Database\Seeder;

class DependencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Dependency', 10)->create();
    }
}
