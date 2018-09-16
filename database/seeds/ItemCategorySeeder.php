<?php

use Illuminate\Database\Seeder;
use App\ItemCategory;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ItemCategory::create([
            'name' => 'IT Equipment'
        ]);
        ItemCategory::create([
            'name' => 'Music Equipment'
        ]);
        ItemCategory::create([
            'name' => 'AV Equipment'
        ]);
        ItemCategory::create([
            'name' => 'Sports Equipment'
        ]);
        ItemCategory::create([
            'name' => 'Furniture'
        ]);
        ItemCategory::create([
            'name' => 'Other'
        ]);
    }
}
