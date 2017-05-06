<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        //Departments
        for ($i = 0; $i < 5; $i++) {
            DB::table('departments')->insert([ //,
                'name' => $faker->company
            ]);
        }

        //Printers


        //Users


        //Requests


        //Comments
    }
}
