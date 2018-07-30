<?php

use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(0, 10) as $key => $value) {
            factory(App\Building::class, 3)
                   ->create([
                      "school_id" => $faker->uuid
                   ])
                   ->each(function ($b) {
                        foreach (range(0, 10) as $key => $value) {
                            $b->rooms()->save(factory(App\Room::class)->make());
                        }
                    });
        }
    }
}
