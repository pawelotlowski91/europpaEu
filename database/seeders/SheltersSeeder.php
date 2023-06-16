<?php

namespace Database\Seeders;

use App\Models\Shelters;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class SheltersSeeder extends Seeder
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
        for($i=0; $i < 50; $i++) {
            $shelters                                   = new Shelters();
            $shelters->{Shelters::COLUMN_NAME}          = $this->faker->userName();
            $shelters->{Shelters::COLUMN_STREET}        = $this->faker->streetAddress();
            $shelters->{Shelters::COLUMN_POST_CODE}     = $this->faker->postcode();
            $shelters->{Shelters::COLUMN_CITY}          = $this->faker->city();
            $shelters->{Shelters::COLUMN_COUNTRY}       = $this->faker->country();
            $shelters->save();
        }
    }
}
