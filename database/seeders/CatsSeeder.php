<?php

namespace Database\Seeders;

use App\Models\Cats;
use App\Models\Shelters;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CatsSeeder extends Seeder
{
    /** @var Faker */
    protected Faker $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shelters = Shelters::all();

        if(!empty($shelters)) {
            foreach ($shelters as $shelter) {
                for($i = 0; $i < round(4, 20); $i++) {
                    $cats                               = new Cats();
                    $cats->{Cats::COLUMN_SHELTERS_ID}   = $shelter->{Shelters::COLUMN_ID};
                    $cats->{Cats::COLUMN_NAME}          = $this->faker->firstName();
                    $cats->save();
                }
            }
        }
    }
}
