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
        $this->call(ItemCategorySeeder::class);
        // $this->call(BuildingSeeder::class);
        // $this->call(ItemSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
    }
}
