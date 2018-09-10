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
        $this->call(ItemTypeSeeder::class);
        $this->call(BuildingSeeder::class);
        $this->call(ItemSeeder::class);
        // $this->call(RolesAndPermissionsSeeder::class);
    }
}
