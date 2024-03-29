<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VehicleTableSeeder::class);
        $this->call(ExpenseTableSeeder::class);
        $this->call(DependencyTableSeeder::class);
    }
}
