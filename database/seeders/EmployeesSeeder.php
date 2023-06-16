<?php

namespace Database\Seeders;

use App\Models\Employees;
use App\Models\Shelters;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class EmployeesSeeder extends Seeder
{

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
            foreach($shelters as $shelter) {
                for($i = 0; $i < round(4, 20); $i++) {
                    $employees                                      = new Employees();
                    $employees->{Employees::COLUMN_SHELTERS_ID}     = $shelter->{Shelters::COLUMN_ID};
                    $employees->{Employees::COLUMN_NAME}            = $this->faker->firstName();
                    $employees->{Employees::COLUMN_SURNAME}         = $this->faker->lastName();
                    $employees->save();
                }
            }
        }
    }
}
